# SEO deployment checklist

The application generates localized metadata, canonical URLs, `hreflang`, Open Graph/Twitter tags, Schema.org JSON-LD, `robots.txt`, and `sitemap.xml` automatically.

## Production settings

Set the canonical public origin in the production environment:

```dotenv
APP_URL=https://gicovn.com.vn
APP_LOCALE=vi
```

Run after changing environment variables:

```sh
php artisan optimize:clear
php artisan config:cache
```

If a different domain is used, set `APP_URL` to that final HTTPS domain. Redirect every other hostname and HTTP URL to it at the proxy or IIS level.

## Search engine registration

1. Add the final domain to Google Search Console and Bing Webmaster Tools.
2. Set `GOOGLE_SITE_VERIFICATION` to Google's verification token if using the HTML-tag method.
3. Submit `https://your-domain.example/sitemap.xml`.
4. Inspect the Vietnamese homepage and `?lang=en` English homepage after deployment.
5. Request indexing only after canonical URLs and language alternates show the production domain.

## Content maintenance

- Use a unique product name and useful short description in both Vietnamese and English admin translations.
- Keep product images descriptive, compressed, and under the banner upload limit where applicable.
- Do not duplicate products under new slugs. Preserve existing slugs or add permanent redirects.
- Hide discontinued products only when no replacement exists; otherwise redirect to the closest replacement or category.
- Update the site-setting title and description for the homepage without keyword stuffing.

Filtered searches are intentionally `noindex,follow`. Product and category pages remain indexable and are included in the sitemap.
