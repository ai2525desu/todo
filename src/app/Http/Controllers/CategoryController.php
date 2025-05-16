<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Categoryモデルから情報を取得してカテゴリ一覧を表示するためにモデル反映
use App\Models\Category;
// この後の追加機能の実装などで使用するためのバリデーション用リクエストのuseがすでに記入済みだった(View作成段階)
use App\Http\Request\CategoryRequest;

class CategoryController extends Controller
{
    // category.blade.phpというカテゴリ一覧ページを呼び出すindexアクション
    public function index()
    {
        // カテゴリモデルからすべての情報を取得して$categories変数に格納
        $categories = Category::all();
        // viewのcategoryを呼び出し、さらにcompact関数で$categoriesの内容を配列に変換し、情報を送信
        return view('category', compact('categories'));
    }
}
