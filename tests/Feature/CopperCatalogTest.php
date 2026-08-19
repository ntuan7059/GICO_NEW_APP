<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\CopperCatalogSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CopperCatalogTest extends TestCase
{
    use DatabaseTransactions;

    public function test_csv_catalog_contains_fifty_buyable_copper_wire_products(): void
    {
        $this->seed(CopperCatalogSeeder::class);

        $samples = Product::query()->where('slug', 'like', 'cu-spool-%');

        $this->assertSame(50, $samples->count());
        $this->assertSame(50, (clone $samples)->whereHas('primaryVariant')->count());
        $this->assertSame(50, (clone $samples)->whereHas('images', fn ($query) => $query->where('image_url', 'like', 'http%'))->count());

        $this->get(route('product.index', ['q' => 'CU-SPOOL-1001']))
            ->assertOk()
            ->assertSee('CU-SPOOL-1001')
            ->assertSee('Chat mua hàng')
            ->assertSee('tuannm180220@gmail.com');
    }
}
