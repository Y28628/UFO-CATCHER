<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UFO CATCHER</title>
</head>
<body>
    <header>
        <h1>UFO CATCHER</h1>
    </header>

    <section id="search-section">
        <h2>キーワードで探す</h2>
        <form action="/search" method="GET">
            <input type="text" name="query" placeholder="キーワードで検索" value="{{ request('query') }}">
            <button type="submit">検索</button>
        </form>

        <h2>カテゴリで探す</h2>
        @foreach($categories as $category)
            <form action="/search" method="GET" style="display:inline;">
                <input type="hidden" name="category" value="{{ $category->id }}">
                <button type="submit">{{ $category->name }}</button>
            </form>
        @endforeach

        <h2>シリーズで探す</h2>
        <div>
            @foreach($series as $serie)
                <form action="/search" method="GET" style="display:inline;">
                    <input type="hidden" name="series" value="{{ $serie }}">
                    <button type="submit">{{ $serie }}</button>
                </form>
            @endforeach
        </div>
    </section>

    @if($posts->isNotEmpty())
    <section id="results-section">
        <h2>検索結果</h2>
        <div class="posts">
            @foreach($posts as $post)
            <div class="post">
                <a href="/posts/{{ $post->id }}"><h2 class="title">{{ $post->title }}</h2></a>
                <a href="/category/{{ $post->category->id }}">{{ $post->category->name }}</a>
                <p class="body">{{ $post->body }}</p>
                <p class="store_name">店舗名: {{ $post->store_name }}</p>
                <p class="fee">料金: {{ $post->fee }}円</p>
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">削除</button>
                </form>
            </div>
            @endforeach
        </div>
        <div class='paginate'>{{ $posts->links() }}</div>
    </section>
    @endif

    <script>
        function deletePost(id) {
            "use strict";
            if (confirm('削除すると復元できません、\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</body>
</html>
