<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// モデルの使用
use App\Models\Todo;

class TodoController extends Controller
{
    // index.blade.phpのブラウザ表示設定
    public function index()
    {
        // $todosはstoreアクションでモデルに格納された複数のデータのこと
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    // 追加機能/todosにおけるstoreアクションの反映
    public function store(Request $request)
    {
        $todo = $request->only(['content']);
        Todo::create($todo);
        // return redirect('/')からwithメソッドを使用してメッセージを表示する。
        return redirect('/')->with('succesMessage', 'Todoを作成しました');
    }
}
