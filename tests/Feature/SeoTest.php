<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use DatabaseTransactions;

    public function test_homepage_outputs_vietnamese_seo_metadata_and_structured_data(): void
    {
        $this->withSession(['locale' => 'vi'])->get(route('xylo.home'))
            ->assertOk()
            ->assertSee('<html lang="vi">', false)
            ->assertSee('<link rel="canonical" href="'.route('xylo.home').'">', false)
            ->assertSee('hreflang="en"', false)
            ->assertSee('Dây đồng, dây điện từ &amp; vật liệu cách điện', false)
            ->assertSee('application/ld+json', false)
            ->assertSee('https://schema.org', false)
            ->assertSee('Organization', false)
            ->assertSee('SearchAction', false);
    }

    public function test_english_url_outputs_english_metadata_and_canonical(): void
    {
        $this->withSession(['locale' => 'vi'])->get(route('xylo.home', ['lang' => 'en']))
            ->assertOk()
            ->assertSee('<html lang="en">', false)
            ->assertSee('Copper Wire &amp; Magnet Wire Supplier in Vietnam', false)
            ->assertSee('<link rel="canonical" href="'.route('xylo.home').'?lang=en">', false)
            ->assertSee('hreflang="vi"', false);
    }

    public function test_product_page_outputs_product_structured_data(): void
    {
        $product = Product::query()->where('status', true)->firstOrFail();

        $this->get(route('product.show', $product->slug))
            ->assertOk()
            ->assertSee('"@type":"Product"', false)
            ->assertSee('"sku":', false)
            ->assertSee('"offers":', false);
    }

    public function test_sitemap_and_robots_are_crawlable(): void
    {
        $this->get(route('seo.sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee('<urlset', false)
            ->assertSee('hreflang="en"', false)
            ->assertSee(route('product.index'), false);

        $this->get(route('seo.robots'))
            ->assertOk()
            ->assertSee('User-agent: *')
            ->assertSee('Sitemap: '.route('seo.sitemap'));
    }

    public function test_filtered_catalog_is_noindex_and_canonicalized(): void
    {
        $this->withSession(['locale' => 'vi'])
            ->get(route('product.index', ['q' => 'AWG']))
            ->assertOk()
            ->assertSee('content="noindex,follow,max-image-preview:large', false)
            ->assertSee('<link rel="canonical" href="'.route('product.index').'">', false);
    }
}
