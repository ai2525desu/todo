@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<!-- エラーメッセージの記述 -->
<div class="todo__alert">
    <div class="todo__alert--succes">
        Todoを作成しました
    </div>
</div>

<!-- 表示するコンテンツの内容 -->
<div class="todo__content">
    <!-- 送信するためのform部分 -->
    <form class="create-form">
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
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form class="update-form">
                        <div class="update-form__item">
                            <input class="update-form__item-input" type="text" value="test">
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form class="delete-form">
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            <!-- 内容記述2 -->
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form class="update-form">
                        <div class="update-form__item">
                            <input class="update-form__item-input" type="text" value="test2">
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form class="delete-form">
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</div>

@endsection