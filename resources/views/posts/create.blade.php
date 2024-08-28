<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>UFO CATCHER - 投稿ページ</title>
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
            background-color: #007bff;
            border-radius: 150px;
            width: 70%;
            height: 60%;
            position: relative;
            display: flex;
            justify-content: flex-end;
        }

        .inner-container {
            background-color: #6c757d;
            border-radius: 150px;
            width: 85%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            text-align: left;
            position: absolute;
            right: 0;
            top: 0;
            padding-left: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input, .form-group select {
            font-size: 0.8rem;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            display: block;
            margin-top: 20px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 20px;
            width: 100%;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="outer-container">
        <div class="inner-container">
            <h1>UFO CATCHER</h1>

            <!-- 投稿完了またはエラーメッセージの表示 -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/posts" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="category">
                    <h2>カテゴリー</h2>
                    <select name="category_id">
                        <option value="">カテゴリーを選択</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="store_name">店舗名</label>
                    <input type="text" id="store_name" name="store_name" value="{{ old('store_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="fee">料金</label>
                    <select name="fee" id="fee">
                        <option value="100">100円</option>
                        <option value="200">200円</option>
                        <option value="300">300円</option>
                        <option value="400">400円</option>
                        <option value="500">500円</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="series">シリーズ</label>
                    <input type="text" id="series" name="series" value="{{ old('series') }}">
                </div>
                <div class="form-group">
                    <label for="image">画像</label>
                    <input type="file" id="image" name="image">
                    <p class="image__error" style="color:red">{{ $errors->first('image') }}</p>
                </div>
                <button type="submit" class="btn-custom">投稿する</button>
            </form>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        </div>
    </div>
</body>
</html>
