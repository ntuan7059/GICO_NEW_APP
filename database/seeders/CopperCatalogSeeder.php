<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class CopperCatalogSeeder extends Seeder
{
    private const SAMPLE_COUNT = 50;

    private const PRODUCT_IMAGES = [
        'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=82',
        'https://images.unsplash.com/photo-1555664424-778a1e5e1b48?auto=format&fit=crop&w=900&q=82',
        'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&w=900&q=82',
        'https://i.postimg.cc/zBCkRRvb/cable-xlp-1.jpg',
        'https://i.postimg.cc/YS1FXBHT/cable-pvc-1.jpg',
        'https://i.postimg.cc/2Sn3YdKZ/cable-control-1.jpg',
    ];

    public function run(): void
    {
        DB::transaction(function (): void {
            [$vendor, $shop] = $this->merchant();
            $brand = Brand::query()->first();
            $categories = $this->categories();
            $rows = $this->readCsv(database_path('data/copper_wire_spool_sample_data.csv'));

            if (count($rows) !== self::SAMPLE_COUNT) {
                throw new RuntimeException('The copper catalog CSV must contain exactly '.self::SAMPLE_COUNT.' sample products.');
            }

            foreach ($rows as $index => $row) {
                $categoryKey = $this->categoryKey($row['Insulation_Type']);
                $product = Product::query()->updateOrCreate(
                    ['slug' => Str::lower($row['Product_ID'])],
                    [
                        'shop_id' => $shop->id,
                        'vendor_id' => $vendor->id,
                        'category_id' => $categories[$categoryKey]->id,
                        'brand_id' => $brand?->id,
                        'product_type' => 'simple',
                        'status' => 1,
                    ]
                );

                $name = sprintf('Cuộn dây đồng %s AWG %s – %s m', $row['Wire_Gauge_AWG'], $row['Insulation_Type'], $row['Length_m']);
                $shortDescription = sprintf(
                    'Dây đồng đường kính %s mm, cuộn %s m, chịu nhiệt đến %s°C. Phù hợp cho %s.',
                    $row['Diameter_mm'],
                    $row['Length_m'],
                    $row['Max_Temperature_C'],
                    $row['Application']
                );
                $description = sprintf(
                    '<p>Cuộn dây đồng <strong>%s</strong> dành cho thợ điện, xưởng sản xuất và dự án cần quy cách rõ ràng.</p><ul><li>Cỡ dây: %s AWG</li><li>Đường kính: %s mm</li><li>Chiều dài: %s m</li><li>Khối lượng: %s kg</li><li>Cách điện: %s</li><li>Nhiệt độ tối đa: %s°C</li><li>Ứng dụng: %s</li></ul>',
                    $row['Product_ID'],
                    $row['Wire_Gauge_AWG'],
                    $row['Diameter_mm'],
                    $row['Length_m'],
                    $row['Weight_kg'],
                    $row['Insulation_Type'],
                    $row['Max_Temperature_C'],
                    $row['Application']
                );

                $product->translations()->updateOrCreate(
                    ['language_code' => 'vi'],
                    ['name' => $name, 'short_description' => $shortDescription, 'description' => $description, 'tags' => 'cuộn dây đồng, copper wire spool, '.$row['Wire_Gauge_AWG'].' AWG']
                );
                $product->translations()->updateOrCreate(
                    ['language_code' => 'en'],
                    [
                        'name' => sprintf('%s AWG Copper Wire Spool – %s m', $row['Wire_Gauge_AWG'], $row['Length_m']),
                        'short_description' => sprintf('%s mm copper wire with %s insulation for %s.', $row['Diameter_mm'], $row['Insulation_Type'], $row['Application']),
                        'description' => $description,
                        'tags' => 'copper wire spool, '.$row['Wire_Gauge_AWG'].' AWG',
                    ]
                );

                $variant = $product->variants()->updateOrCreate(
                    ['SKU' => $row['Product_ID']],
                    [
                        'variant_slug' => Str::lower($row['Product_ID']).'-standard',
                        'price' => $row['Price_USD'],
                        'discount_price' => null,
                        'stock' => $row['Stock_Quantity'],
                        'barcode' => null,
                        'weight' => $row['Weight_kg'],
                        'dimensions' => $row['Diameter_mm'].' mm × '.$row['Length_m'].' m',
                        'is_primary' => true,
                    ]
                );
                $variant->translations()->updateOrCreate(['language_code' => 'vi'], ['name' => $row['Wire_Gauge_AWG'].' AWG · '.$row['Length_m'].' m']);
                $variant->translations()->updateOrCreate(['language_code' => 'en'], ['name' => $row['Wire_Gauge_AWG'].' AWG · '.$row['Length_m'].' m']);

                $product->images()->updateOrCreate(
                    ['type' => 'thumb'],
                    ['name' => $row['Product_ID'].' copper wire spool', 'image_url' => self::PRODUCT_IMAGES[$index % count(self::PRODUCT_IMAGES)]]
                );
            }
        });
    }

    private function merchant(): array
    {
        $vendor = Vendor::query()->firstOrCreate(
            ['email' => 'sales@giahungjsc.example'],
            ['name' => 'Gia Hưng JSC', 'password' => Hash::make(Str::random(32)), 'phone' => '0906236863', 'status' => 'active']
        );
        $shop = Shop::query()->firstOrCreate(
            ['slug' => 'gia-hung-jsc'],
            ['vendor_id' => $vendor->id, 'name' => 'Gia Hưng JSC', 'description' => 'Dây đồng và cáp điện cho công trình Việt', 'status' => 'active']
        );

        return [$vendor, $shop];
    }

    private function categories(): array
    {
        $definitions = [
            'pvc' => ['day-dong-boc-pvc', 'Dây đồng bọc PVC', 'Copper Wire – PVC Insulated'],
            'silicone' => ['day-dong-boc-silicone', 'Dây đồng bọc silicone', 'Copper Wire – Silicone Rubber'],
            'bare' => ['day-dong-tran', 'Dây đồng trần', 'Bare Copper Wire'],
            'thhn' => ['day-dong-thhn', 'Dây đồng THHN', 'THHN Copper Wire'],
            'magnet' => ['day-dong-enamel', 'Dây đồng enamel', 'Enamelled Magnet Wire'],
        ];

        $categories = [];
        foreach ($definitions as $key => $definition) {
            [$slug, $viName, $enName] = $definition;
            $imageIndex = array_search($key, array_keys($definitions), true);
            $category = Category::query()->updateOrCreate(['slug' => $slug], ['parent_category_id' => null, 'status' => 1]);
            $category->translations()->updateOrCreate(['language_code' => 'vi'], ['name' => $viName, 'description' => 'Cuộn dây đồng theo cỡ AWG, chiều dài và ứng dụng.', 'image_url' => self::PRODUCT_IMAGES[$imageIndex]]);
            $category->translations()->updateOrCreate(['language_code' => 'en'], ['name' => $enName, 'description' => 'Copper wire spools by AWG, length and application.', 'image_url' => self::PRODUCT_IMAGES[$imageIndex]]);
            $categories[$key] = $category;
        }

        return $categories;
    }

    private function categoryKey(string $insulation): string
    {
        return match ($insulation) {
            'PVC Insulated' => 'pvc',
            'Silicone Rubber' => 'silicone',
            'Bare (Uninsulated)' => 'bare',
            'THHN' => 'thhn',
            default => 'magnet',
        };
    }

    private function readCsv(string $path): array
    {
        $handle = fopen($path, 'rb');
        if ($handle === false) {
            throw new RuntimeException('Unable to open copper catalog CSV at '.$path);
        }

        $headers = fgetcsv($handle, null, ',', '"', '\\');
        $rows = [];
        while (($values = fgetcsv($handle, null, ',', '"', '\\')) !== false) {
            if (count($values) === count($headers)) {
                $rows[] = array_combine($headers, $values);
            }
        }
        fclose($handle);

        return $rows;
    }
}
