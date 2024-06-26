<!-- resources/views/posts/create.blade.php -->
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>UFO CATCHER</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="antialiased">
    <h1>UFO CATCHER</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="/posts" method="POST">
        @csrf
        <div class="title"> 
            <h2>商品名 入力</h2>
            <input type="text" name="post[title]" placeholder="商品名" value="{{ old('post.title') }}">
            <p class='title__error' style="color:red">{{ $errors->first('post.title') }}</p>
        </div>
        <div class="category">
            <h2>カテゴリー</h2>
            <select name="post[category_id]">
                <option value="">カテゴリーを選択</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="store_name"> 
            <h2>店舗名</h2>
            <input type="text" name="post[store_name]" placeholder="店舗名" value="{{ old('post.store_name') }}">
            <p class='store_name__error' style="color:red">{{ $errors->first('post.store_name') }}</p>
        </div>
        <div class="fee"> 
            <h2>料金</h2>
            <select name="post[fee]">
                <option value="100">100円</option>
                <option value="200">200円</option>
                <option value="300">300円</option>
                <option value="400">400円</option>
                <option value="500">500円</option>
            </select>
            <p class='fee__error' style="color:red">{{ $errors->first('post.fee') }}</p>
        </div>
        <input type="submit" value="投稿"/>
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>
</html>