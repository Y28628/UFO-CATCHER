<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UFO CATCHER - 探す</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .outer-container {
            background-color: #6c757d; /* 灰色 */
            border-radius: 150px;
            width: 70%;
            height: 60%;
            position: relative;
            display: flex;
            justify-content: flex-end;
        }

        .inner-container {
            background-color: #007bff; /* 青色 */
            border-radius: 150px;
            width: 85%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            text-align: left;
            position: absolute;
            left: 0;
            top: 0;
            padding-left: 20px; /* 余白を小さく */
            padding-right: 20px; /* 余白を小さく */
            padding-top: 0px;  /* 上部の余白を減らす */
            padding-bottom: 80px; /* 下部の余白を増やす */
            
        }

        h2 {
            font-size: 1.2rem; /* フォントサイズを小さく */
            color: black;
            margin-top: 15px;
        }

        .category-group, .series-group {
            display: flex;
            gap: 5px; /* ボタンの余白を小さく */
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .category-group button, .series-group button {
            font-size: 0.9rem; /* ボタンのテキストサイズを小さく */
            background-color: white;
            color: black;
            font-weight: bold;
            padding: 6px 14px; /* 余白を小さく */
            border-radius: 10px;
            border: 2px solid #007bff;
            cursor: pointer;
        }

        .category-group button:hover, .series-group button:hover {
            background-color: #e9ecef;
        }
        
        .footer {
            position: fixed; /* ビューポートに固定 */
            bottom: 20px; /* ビューポートの下から20pxの位置に配置 */
            left: 20px; /* ビューポートの左から20pxの位置に配置 */
            text-align: left;
            background-color: #FFFFFF;
            padding: 10px;
            border-radius: 5px;
            color: black;
            z-index: 1000; /* 他の要素の前面に表示 */
            
        }

        .footer a {
             color: black; /* リンクの文字色を黒に設定 */
             text-decoration: none; /* 下線を削除 */
        }

       

        .search-bar {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column; /* 一旦縦に並べる */
            gap: 10px;
        }

        .search-bar-row {
            display: flex;  /* 検索欄とボタンを横並びにする */
            align-items: center; /* 垂直方向に中央揃え */
            gap: 10px; /* 検索欄とボタンの間に余白を追加 */
        }

        .search-bar input[type="text"] {
            padding: 8px 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            flex-grow: 1; /* 残りのスペースを埋める */
        }

        .search-bar button {
            background-color: white; /* 検索ボタンの背景色を白に変更 */
            color: black;
            font-weight: bold;
            padding: 8px 16px; /* 余白を小さく */
            border-radius: 10px;
            border: 2px solid #007bff;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #e9ecef;
        }

        img {
            max-width: 100%;
            height: auto;
            max-height: 300px; /* 画像の最大高さを設定 */
            width: auto;
        }
    </style>
</head>
<body>
    <div class="outer-container">
        <div class="inner-container">
            <h1>UFO CATCHER - 探す</h1>

            <!-- キーワード検索機能 -->
            <div class="search-bar">
                <h2>キーワードで探す</h2>
                <div class="search-bar-row">
                    <form action="/search" method="GET" style="display: flex; width: 100%;">
                        <input type="text" name="query" placeholder="キーワードで検索" value="{{ request('query') }}">
                        <button type="submit">検索</button>
                    </form>
                </div>
            </div>

            <h2>カテゴリで探す</h2>
            <div class="category-group">
                @foreach($categories as $category)
                    <form action="/search" method="GET">
                        <input type="hidden" name="category" value="{{ $category->id }}">
                        <button type="submit">{{ $category->name }}</button>
                    </form>
                @endforeach
            </div>

            <h2>シリーズで探す</h2>
            <div class="series-group">
                @foreach($series as $serie)
                    <form action="/search" method="GET">
                        <input type="hidden" name="series" value="{{ $serie }}">
                        <button type="submit">{{ $serie }}</button>
                    </form>
                @endforeach
            </div>
            
            <!-- 既存の検索結果表示 -->
            @if($posts->isNotEmpty())
            <section id="results-section">
                <h2>検索結果</h2>
                <div class="posts">
                    @foreach($posts as $post)
                    <div class="post">
                        <a href="/posts/{{ $post->id }}"><h2 class="title">{{ $post->title }}</h2></a>
                        <span>{{ $post->category->name }}</span>
                        <p class="body">{{ $post->body }}</p>
                        <p class="store_name">店舗名: {{ $post->store_name }}</p>
                        <p class="fee">料金: {{ $post->fee }}円</p>
                        @if($post->image_url)
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                        @endif
                    </div>
                    @endforeach
                </div>
                <!--<div class='paginate'>{{ $posts->links() }}</div>　表示が必要ないため一度コメントアウト-->
            </section>
            @else
            <section id="no-results-section">
                <h2>検索結果</h2>
                <p>該当する投稿がありません。</p>
            </section>
            @endif
            <script>
                function deletePost(id) {
                    "use strict";
                    if (confirm('削除すると復元できません、\n本当に削除しますか？')) {
                        document.getElementById(form_${id}).submit();
                    }
                }
            </script>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </div>
</body>
</html>