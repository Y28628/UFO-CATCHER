<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>UFO CATCHER</title>
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
    width: 50%; /* 外側の青い部分の幅を維持 */
    height: 50%;
    position: relative;
    display: flex;
    justify-content: center; /* 青色部分の幅を中央に揃える */
}

.inner-container {
    background-color: #6c757d;
    border-radius: 150px;
    width: 75%; /* 灰色の幅を短くして、青色の部分を増やす */
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    text-align: left;
    position: absolute;
    right: 0;
    top: 0;
    transform: translateX(10%);
    padding-left: 0px;
}



        .inner-container h1 {
            color: #000;
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 20px;
        }

        .btn-custom {
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="outer-container">
        <div class="inner-container">
            <h1>UFO CATCHER</h1>
            <div class="btn-group">
                <a href="/posts/create" class="btn-custom">投稿する</a>
                <a href="/search" class="btn-custom">探す</a>
            </div>
        </div>
    </div>
</body>
</html>
