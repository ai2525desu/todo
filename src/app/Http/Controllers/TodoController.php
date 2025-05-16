<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Todoモデルの反映
use App\Models\Todo;
// Categoryモデルの反映
use App\Models\Category;
// フォームリクエストの反映
use App\Http\Requests\TodoRequest;

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
    public function store(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::create($todo);
        // return redirect('/')からwithメソッドを使用してメッセージを表示する。
        return redirect('/')->with('succesMessage', 'Todoを作成しました');
    }

    // 更新機能/todos/updateにおけるupdateアクション
    public function update(TodoRequest $request)
    {
        // $todoに更新する内容を格納['content']
        $todo = $request->only(['content']);
        // unset($todo['_token']);
        // 更新したいTodoの内容をフォームから送信されたIDで検索し、updateメソッドでcontentを更新するために、モデルでidが検索できるようにする
        Todo::find($request->id)->update($todo);
        // 更新した際にメッセージが表示されるようにwithメソッドを使用
        return redirect('/')->with('updateMessage', 'Todoを更新しました');
    }

    // 削除機能の追加
    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('destroyMessage', 'Todoを削除しました');
    }
}
