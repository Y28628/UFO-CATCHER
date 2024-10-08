<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PostController extends Controller
{
    public function index()
    {
        // メインページとして何も表示しない
        return view('posts.index');
    }

    public function create()
    {
        // カテゴリデータを取得してビューに渡す
        $categories = Category::all();
        return view('posts.create')->with('categories', $categories);
    }

    
  public function store(Request $request)
    {
        $input = $request->all(); // 全ての入力データを取得

        try {
            // 画像ファイルがアップロードされたかを確認
            if ($request->hasFile('image')) {
                // 画像をCloudinaryにアップロード
                $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
                // 画像のURLを$inputに追加
                $input['image_url'] = $uploadedFileUrl;
            }

            // データベースに保存
            Post::create($input);

            return redirect('/posts/create')->with('success', '投稿しました');
        } catch (\Exception $e) {
            return redirect('/posts/create')->with('error', '投稿に失敗しました: ' . $e->getMessage());
        }
    }




    public function searchPage(Request $request)
    {
        $query = $request->input('query', '');
        $categoryId = $request->input('category', null);
        $series = $request->input('series', null);

        $posts = Post::query();

        if ($query) {
            $posts->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('store_name', 'like', "%{$query}%")
                  ->orWhere('body', 'like', "%{$query}%");
            });
        }

        if ($categoryId) {
            $posts->where('category_id', $categoryId);
        }

        if ($series) {
            $posts->where('series', 'like', "%{$series}%");
        }

        // 検索条件がない場合は投稿を表示しない
        if (!$query && !$categoryId && !$series) {
            $posts = collect(); // 空のコレクションを設定
        } else {
            $posts = $posts->paginate(5);
        }

        $categories = Category::all(); 

        return view('posts.search', [
            'posts' => $posts,
            'query' => $query,
            'categories' => $categories, 
            'series' => ['ワンピース', '鬼滅の刃', 'リゼロ', '転スラ', 'おぱんちゅうさぎ', 'にしむらゆうじ作品', '怪獣8号', '炎炎の消防隊']
        ]);
    }
}
