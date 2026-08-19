<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $languages = Language::where('active', 1)->get();

            $sizeAttr = Attribute::firstOrCreate(['name' => 'Size']);
            $colorAttr = Attribute::firstOrCreate(['name' => 'Color']);
            $voltageAttr = Attribute::firstOrCreate(['name' => 'Voltage']);
            $conductorAttr = Attribute::firstOrCreate(['name' => 'Conductor']);

            $sizes = ['Small', 'Medium', 'Large'];
            $colors = ['Red', 'Blue', 'Black'];
            $voltages = ['0.6/1kV', '1.8/3kV', '6/10kV', '8.7/15kV', '12/20kV', '18/30kV', '26/35kV'];
            $conductors = ['Copper', 'Aluminum'];

            foreach ($sizes as $size) {
                $attrValue = AttributeValue::firstOrCreate([
                    'attribute_id' => $sizeAttr->id,
                    'value' => $size,
                ]);

                foreach ($languages as $lang) {
                    $attrValue->translations()->firstOrCreate([
                        'language_code' => $lang->code,
                    ], [
                        'translated_value' => match ($lang->code) {
                            'es' => match ($size) {
                                'Small' => 'Pequeño',
                                'Medium' => 'Mediano',
                                'Large' => 'Grande',
                                default => $size,
                            },
                            'de' => match ($size) {
                                'Small' => 'Klein',
                                'Medium' => 'Mittel',
                                'Large' => 'Groß',
                                default => $size,
                            },
                            default => $size,
                        },
                    ]);
                }
            }

            foreach ($colors as $color) {
                $attrValue = AttributeValue::firstOrCreate([
                    'attribute_id' => $colorAttr->id,
                    'value' => $color,
                ]);

                foreach ($languages as $lang) {
                    $attrValue->translations()->firstOrCreate([
                        'language_code' => $lang->code,
                    ], [
                        'translated_value' => match ($lang->code) {
                            'es' => match ($color) {
                                'Red' => 'Rojo',
                                'Blue' => 'Azul',
                                'Black' => 'Negro',
                                default => $color,
                            },
                            'de' => match ($color) {
                                'Red' => 'Rot',
                                'Blue' => 'Blau',
                                'Black' => 'Schwarz',
                                default => $color,
                            },
                            default => $color,
                        },
                    ]);
                }
            }

            foreach ($voltages as $voltage) {
                $attrValue = AttributeValue::firstOrCreate([
                    'attribute_id' => $voltageAttr->id,
                    'value' => $voltage,
                ]);

                foreach ($languages as $lang) {
                    $attrValue->translations()->firstOrCreate([
                        'language_code' => $lang->code,
                    ], [
                        'translated_value' => $voltage,
                    ]);
                }
            }

            foreach ($conductors as $conductor) {
                $attrValue = AttributeValue::firstOrCreate([
                    'attribute_id' => $conductorAttr->id,
                    'value' => $conductor,
                ]);

                foreach ($languages as $lang) {
                    $attrValue->translations()->firstOrCreate([
                        'language_code' => $lang->code,
                    ], [
                        'translated_value' => match ($lang->code) {
                            'es' => match ($conductor) {
                                'Copper' => 'Cobre',
                                'Aluminum' => 'Aluminio',
                                default => $conductor,
                            },
                            'de' => match ($conductor) {
                                'Copper' => 'Kupfer',
                                'Aluminum' => 'Aluminium',
                                default => $conductor,
                            },
                            default => $conductor,
                        },
                    ]);
                }
            }

            $vendor = Vendor::first() ?? Vendor::factory()->create();
            $category = Category::first() ?? Category::factory()->create();
            $brand = Brand::first() ?? Brand::factory()->create();

            $products = [
                [
                    'name' => 'XLPE Power Cables 0.6/1kV–35kV',
                    'slug' => 'xlpe-power-cables',
                    'image' => 'https://i.postimg.cc/zBCkRRvb/cable-xlp-1.jpg',
                    'description' => 'Factory-direct XLPE Power Cables with Copper/Aluminum conductors, IEC/BS certified. Voltage from 0.6/1kV to 35kV.',
                    'short_description' => 'Voltage: from 0.6/1kV to 35kV<br>Conductor: Cu or Al<br>Insulation: XLPE (Crosslinked Polyethylene)',
                ],
                [
                    'name' => 'PVC Insulated Power Cables',
                    'slug' => 'pvc-power-cables',
                    'image' => 'https://i.postimg.cc/YS1FXBHT/cable-pvc-1.jpg',
                    'description' => 'PVC insulated power cables for indoor and outdoor applications. Available in various voltage ratings.',
                    'short_description' => 'Voltage: 450/750V to 0.6/1kV<br>Conductor: Copper<br>Insulation: PVC',
                ],
                [
                    'name' => 'Control Cables',
                    'slug' => 'control-cables',
                    'image' => 'https://i.postimg.cc/2Sn3YdKZ/cable-control-1.jpg',
                    'description' => 'Flexible control cables for industrial automation and control systems. Shielded and unshielded options available.',
                    'short_description' => 'Voltage: 300/500V<br>Conductor: Copper<br>Insulation: PVC/XLPE',
                ],
                [
                    'name' => 'Bare Conductors',
                    'slug' => 'bare-conductors',
                    'image' => 'https://i.postimg.cc/WpDkKZTM/cable-bare-1.jpg',
                    'description' => 'AAC, AAAC, ACSR bare conductors for overhead transmission lines. High conductivity and durability.',
                    'short_description' => 'Type: AAC, AAAC, ACSR<br>Conductor: Aluminum<br>Application: Overhead transmission',
                ],
                [
                    'name' => 'Armoured Power Cables',
                    'slug' => 'armoured-power-cables',
                    'image' => 'https://i.postimg.cc/WpDkKZTM/cable-armoured-1.jpg',
                    'description' => 'Steel wire armoured cables for underground installation. Mechanical protection and moisture resistance.',
                    'short_description' => 'Voltage: 0.6/1kV to 35kV<br>Armour: Steel Wire<br>Application: Underground burial',
                ],
                [
                    'name' => 'Earth/Ground Cables',
                    'slug' => 'earth-ground-cables',
                    'image' => 'https://i.postimg.cc/WpDkKZTM/cable-earth-1.jpg',
                    'description' => 'Earth and ground cables for electrical safety and grounding systems. Green/Yellow color coded.',
                    'short_description' => 'Voltage: 450/750V 0.6/1kV<br>Conductor: Copper<br>Sheath: PVC, XLPE, LSZH',
                ],
            ];

            foreach ($products as $item) {
                $product = Product::create([
                    'shop_id' => 1,
                    'vendor_id' => $vendor->id,
                    'slug' => $item['slug'],
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'product_type' => 'variable',
                    'status' => 1,
                ]);

                foreach ($languages as $lang) {
                    $translatedName = match ($lang->code) {
                        'es' => match ($item['name']) {
                            'XLPE Power Cables 0.6/1kV–35kV' => 'Cables de Potencia XLPE 0.6/1kV–35kV',
                            'PVC Insulated Power Cables' => 'Cables de Potencia Aislados con PVC',
                            'Control Cables' => 'Cables de Control',
                            'Bare Conductors' => 'Conductores Desnudos',
                            'Armoured Power Cables' => 'Cables de Potencia Blindados',
                            'Earth/Ground Cables' => 'Cables de Tierra/Puesta a Tierra',
                            default => $item['name'],
                        },
                        'de' => match ($item['name']) {
                            'XLPE Power Cables 0.6/1kV–35kV' => 'XLPE-Stromkabel 0.6/1kV–35kV',
                            'PVC Insulated Power Cables' => 'PVC-isolierte Stromkabel',
                            'Control Cables' => 'Steuerkabel',
                            'Bare Conductors' => 'Unisolierte Leiter',
                            'Armoured Power Cables' => 'Panzerstromkabel',
                            'Earth/Ground Cables' => 'Erdungs-/Erderkabel',
                            default => $item['name'],
                        },
                        default => $item['name'],
                    };

                    $translatedDescription = match ($lang->code) {
                        'es' => match ($item['name']) {
                            'XLPE Power Cables 0.6/1kV–35kV' => 'Cables de potencia XLPE directos de fábrica con conductores de cobre/aluminio, certificados IEC/BS. Voltaje de 0.6/1kV a 35kV.',
                            'PVC Insulated Power Cables' => 'Cables de potencia aislados con PVC para aplicaciones interiores y exteriores. Disponibles en varios niveles de voltaje.',
                            'Control Cables' => 'Cables de control flexibles para automatización industrial y sistemas de control. Opciones blindadas y no blindadas disponibles.',
                            'Bare Conductors' => 'Conductores desnudos AAC, AAAC, ACSR para líneas de transmisión aéreas. Alta conductividad y durabilidad.',
                            'Armoured Power Cables' => 'Cables blindados con alambre de acero para instalación subterránea. Protección mecánica y resistencia a la humedad.',
                            'Earth/Ground Cables' => 'Cables de tierra y puesta a tierra para seguridad eléctrica y sistemas de puesta a tierra. Codificados en color verde/amarillo.',
                            default => $item['description'],
                        },
                        'de' => match ($item['name']) {
                            'XLPE Power Cables 0.6/1kV–35kV' => 'Direkt vom Hersteller XLPE-Stromkabel mit Kupfer/Aluminium-Leitern, IEC/BS-zertifiziert. Spannung von 0.6/1kV bis 35kV.',
                            'PVC Insulated Power Cables' => 'PVC-isolierte Stromkabel für Innen- und Außenanwendungen. Verfügbar in verschiedenen Spannungsklassen.',
                            'Control Cables' => 'Flexible Steuerkabel für industrielle Automatisierung und Steuerungssysteme. Geschirmte und ungeschirmte Optionen verfügbar.',
                            'Bare Conductors' => 'AAC, AAAC, ACSR unisolierte Leiter für Freileitungen. Hohe Leitfähigkeit und Haltbarkeit.',
                            'Armoured Power Cables' => 'Stahldraht-panzerstromkabel für unterirdische Installation. Mechanischer Schutz und Feuchtigkeitsbeständigkeit.',
                            'Earth/Ground Cables' => 'Erdungs- und Erderkabel für elektrische Sicherheit und Erdungssysteme. Grün/Gelb farbcodiert.',
                            default => $item['description'],
                        },
                        default => $item['description'],
                    };

                    $product->translations()->create([
                        'language_code' => $lang->code,
                        'name' => $translatedName,
                        'description' => $translatedDescription,
                        'short_description' => $item['short_description'] ?? '',
                    ]);
                }

                $imageUrl = $item['image'];
                $imageName = basename($imageUrl);
                try {
                    $imageContents = file_get_contents($imageUrl);
                    $localPath = 'products/'.$imageName;
                    Storage::disk('public')->put($localPath, $imageContents);
                } catch (\Exception $e) {
                    $localPath = $imageUrl;
                }

                $product->images()->create([
                    'name' => $imageName,
                    'image_url' => $localPath,
                    'type' => 'thumb',
                ]);

                $voltageAttrValues = AttributeValue::where('attribute_id', $voltageAttr->id)->get();
                $conductorAttrValues = AttributeValue::where('attribute_id', $conductorAttr->id)->get();

                foreach ($voltageAttrValues as $voltage) {
                    foreach ($conductorAttrValues as $conductor) {
                        $price = rand(50, 500);
                        $discountPrice = rand(30, $price);

                        $variant = $product->variants()->create([
                            'variant_slug' => Str::slug("{$item['name']} {$voltage->value}-{$conductor->value}").'-'.uniqid(),
                            'price' => $price,
                            'discount_price' => $discountPrice,
                            'stock' => rand(100, 500),
                            'SKU' => strtoupper(substr($conductor->value, 0, 2)).str_replace(['/', 'kV'], '', $voltage->value).rand(100, 999),
                            'barcode' => null,
                            'weight' => '2.5',
                            'dimensions' => '500x500x500 mm',
                            'is_primary' => 1,
                        ]);

                        foreach ($languages as $lang) {
                            $variant->translations()->create([
                                'language_code' => $lang->code,
                                'name' => "{$voltage->value} - {$conductor->value}",
                            ]);
                        }

                        foreach ([$voltage->id, $conductor->id] as $attrValueId) {
                            DB::table('product_variant_attribute_values')->insert([
                                'product_id' => $product->id,
                                'product_variant_id' => $variant->id,
                                'attribute_value_id' => $attrValueId,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);

                            ProductAttributeValue::firstOrCreate([
                                'product_id' => $product->id,
                                'attribute_value_id' => $attrValueId,
                            ]);
                        }
                    }
                }
            }
        });
    }
}
