{!! '<' . '?' . 'xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/about') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/admissions') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/contact') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/news') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/gallery') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/staff') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/academics') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    @foreach ($campuses as $campus)
    <url>
        <loc>{{ route('campus.detail', $campus->slug) }}</loc>
        <lastmod>{{ $campus->updated_at->toDateString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('gallery.show', $campus->slug) }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($news as $article)
    <url>
        <loc>{{ route('news.show', $article->slug) }}</loc>
        <lastmod>{{ $article->published_at->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>
