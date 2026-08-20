<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $staticPages = [
            ['url' => route('xylo.home'), 'priority' => '1.0', 'frequency' => 'weekly'],
            ['url' => route('product.index'), 'priority' => '0.9', 'frequency' => 'daily'],
            ['url' => route('about'), 'priority' => '0.6', 'frequency' => 'monthly'],
            ['url' => route('document.index'), 'priority' => '0.6', 'frequency' => 'weekly'],
            ['url' => route('contact'), 'priority' => '0.5', 'frequency' => 'monthly'],
        ];

        $products = Product::query()
            ->where('status', true)
            ->select(['slug', 'updated_at'])
            ->orderBy('id')
            ->get();

        $categories = Category::query()
            ->where('status', true)
            ->whereHas('products', fn ($query) => $query->where('status', true))
            ->select(['slug', 'updated_at'])
            ->orderBy('id')
            ->get();

        return response()
            ->view('seo.sitemap', compact('staticPages', 'products', 'categories'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(): Response
    {
        $content = implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin/',
            'Disallow: /customer/',
            'Disallow: /cart',
            'Disallow: /checkout',
            'Disallow: /search',
            'Disallow: /*?q=',
            'Disallow: /*?*q=',
            'Sitemap: '.route('seo.sitemap'),
            '',
        ]);

        return response($content, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
