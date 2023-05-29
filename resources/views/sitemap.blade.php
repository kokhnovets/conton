<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
    <!--	created with www.mysitemapgenerator.com	-->
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/about</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/news</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/login</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/register</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/terms</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/policy</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/feedback</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/password/reset</loc>
        <lastmod>2023-05-28T17:11:53+01:00</lastmod>
        <priority>0.8</priority>
    </url>
    @foreach ($users as $user)
        <url>
            <loc>{{ url('/') }}/users/{{ $user->id }}</loc>
            <lastmod>{{ $user->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
    <url>
        <loc>{{ url('/') }}/news</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    @foreach ($news as $new)
        <url>
            <loc>{{ url('/') }}/news/{{ $new->id }}</loc>
            <lastmod>{{ $new->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
    <url>
        <loc>{{ url('/') }}/travel</loc>
        <lastmod>2023-05-28T17:11:52+01:00</lastmod>
        <priority>1.0</priority>
    </url>
    @foreach ($orders as $order)
        <url>
            <loc>{{ url('/') }}/travel/{{ $order->id }}</loc>
            <lastmod>{{ $order->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
