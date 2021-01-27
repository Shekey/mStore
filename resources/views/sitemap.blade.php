<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://m-store.ba//</loc>
    </url>
    <url>
        <loc>https://m-store.ba/kontakt</loc>
    </url>
    @foreach($markets as $market)
        <url>
            <loc>https://m-store.ba/prodavnica/{{ $market->id }}</loc>
        </url>
    @endforeach
</urlset>
