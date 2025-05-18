<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Categoryモデルから情報を取得してカテゴリ一覧を表示するためにモデル反映
use App\Models\Category;
// バリデーションのためフォームリクエストの反映
use App\Http\Requests\CategoryRequest;

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

    // storeアクションによる追加機能
    public function store(CategoryRequest $request)
    {
        // $categoryにformから送信されたnameのみデータを取得するように記述
        $category = $request->only(['name']);
        // モデルに対してcreat機能で$categoryを作成、保存処理
        Category::create($category);
        // 作成保存後にメッセージを伴って、categoryの一覧画面にリダイレクトするように/categoriesに設定
        return redirect('/categories')->with('successMessage', 'カテゴリを作成しました');
    }

    // updateアクション追加
    public function update(CategoryRequest $request)
    {
        // update-formを通して送られてくる情報からnameのデータのみ取得するよう設定
        $category = $request->only(['name']);
        // モデルを通して$requestで送信されてくるid情報を取得し、updateメソッドで再び$categoryに格納し、更新する
        Category::find($request->id)->update($category);
        // redirect時に/categoriesに戻し、メッセージを表示するようにする
        return redirect('/categories')->with('updateMessage', 'カテゴリを更新しました');
    }

    // destroyメソッドの追加
    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();
        return redirect('/categories')->with('destroyMessage', 'カテゴリを削除しました');
    }
}
