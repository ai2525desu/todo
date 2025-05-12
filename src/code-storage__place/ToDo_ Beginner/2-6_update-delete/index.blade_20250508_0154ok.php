@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<!-- メッセージの記述 -->
<div class="todo__alert">
    <!-- Todoの作成が成功した場合のメッセージ表示 -->
    @if (session('succesMessage'))
    <div class="todo__alert--succes">
        <!-- 変更前：Todoを作成しました -->
        {{ session('succesMessage') }}
    </div>
    @endif
    <!-- Todoが更新されたときに表示するメッセージ -->
    @if (session('updateMessage'))
    <div class="todo__alert--update">
        {{ session('updateMessage') }}
    </div>
    @endif
    <!-- Todoが削除されたときに表示するメッセージ -->
    @if (session('destroyMessage'))
    <div class="todo__alert--destro">
        {{ session('destroyMessage') }}
    </div>
    @endif
    <!-- エラーメッセージの表示 -->
    <!-- ①最初に自身で考えたコード
    @if ($errors->has('content'))
    <div class="todo__alert--danger">
        @error('content')
            {{ $message }}
        @enderror
    </div>
    @endif -->
    <!-- ②解答を受けて考えた自身の作成したコードの改良版 -->
    <!-- @if ($errors->has('content'))
    <div class="todo__alert--danger">
        @foreach ($errors->get('content') as $message)
        <ul>
            <li>{{ $message }}</li>
        </ul>
        @endforeach
    </div>
    @endif -->
    <!-- 解答 -->
    @if ($errors->any())
    <div class="todo__alert--danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<!-- 表示するコンテンツの内容 -->
<div class="todo__content">
    <!-- 送信するためのform部分 -->
    <form class="create-form" action="/todos" method="post">
        @csrf
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="content">
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>
    <!-- 作成したものが表示されるテーブルの表示部分 -->
    <div class="todo-table">
        <table class="todo-table__inner">
            <!-- テーブルの見出し：タイトル部分 -->
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
            </tr>
            <!-- 内容記述 -->
            @foreach($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                <!-- actionとmethodの追加：PATCHメソッドのため、＠の記述もあり -->
                <form class="update-form" action="/todos/update" method="post">
                    @method('patch')
                    @csrf
                        <div class="update-form__item">
                            <!-- $todo['content']-->
                            <input class="update-form__item-input" type="text" name="content" value="{{ $todo['content']}}">
                            <!-- $todo['id']はブラウザ上に表示されないためhydden設定 -->
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form class="delete-form" action="/todos/delete" method="post">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection