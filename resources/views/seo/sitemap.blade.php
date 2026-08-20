{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach ($staticPages as $page)
    <url>
        <loc>{{ $page['url'] }}</loc>
        <xhtml:link rel="alternate" hreflang="vi" href="{{ $page['url'] }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ $page['url'] }}?lang=en" />
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $page['url'] }}" />
        <changefreq>{{ $page['frequency'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
@endforeach
@foreach ($categories as $category)
    @php($url = route('category.show', $category->slug))
    <url>
        <loc>{{ $url }}</loc>
        <xhtml:link rel="alternate" hreflang="vi" href="{{ $url }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ $url }}?lang=en" />
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $url }}" />
        <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
@endforeach
@foreach ($products as $product)
    @php($url = route('product.show', $product->slug))
    <url>
        <loc>{{ $url }}</loc>
        <xhtml:link rel="alternate" hreflang="vi" href="{{ $url }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ $url }}?lang=en" />
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $url }}" />
        <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
</urlset>
