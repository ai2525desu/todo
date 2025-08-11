@extends('layouts.app')

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
    <div class="todo__alert--destroy">
        {{ session('destroyMessage') }}
    </div>
    @endif
    <!-- エラーメッセージの表示 -->
    <!-- 自身で考えたコードはNotion -->
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
    <!-- 新規作成の部分 -->
    <div class="section__title">
        <h2>新規作成</h2>
    </div>
    <!-- Todoを作成するためのform部分 -->
    <form class="create-form" action="/todos" method="post">
        @csrf
        <div class="create-form__item">
            <!-- Todo内容入力部分 -->
            <input class="create-form__item-input" type="text" name="content" value="{{ old('content') }}">
            <!-- カテゴリの選択部分 -->
            <select class="create-form__item-select" name="category_id">
                <option value="" disabled selected style="display:none">カテゴリ</option>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>
    <!-- Todo検索の部分 -->
    <div class="section__title">
        <h2>Todo検索</h2>
    </div>
    <form class="search-form" action="/todos/search" method="get">
        @csrf
        <div class="search-form__item">
            <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
            <select class="search-form__item-select" name="category_id">
                <!--  もともと<option value="" disabled selected style="display:none">カテゴリ</option> -->
                <option value="" selected>カテゴリを選択</option>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
        </div>
    </form>
    <!-- 作成したものが表示されるテーブルの表示部分 -->
    <div class="todo-table">
        <table class="todo-table__inner">
            <!-- テーブルの見出し：タイトル部分 -->
            <tr class="todo-table__row">
                <!-- タイトルが増えたのでspanタグと新たな共通クラス設定 -->
                <th class="todo-table__header">
                    <span class="todo-table__header-span">Todo</span>
                    <span class="todo-table__header-span">カテゴリ</span>
                </th>
            </tr>
            <!-- 内容記述 -->
            @foreach($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                <!-- actionとmethodの追加：PATCHメソッドのため、＠の記述もあり -->
                    <form class="update-form" action="/todos/update" method="post">
                        @method('patch')
                        @csrf
                        <!-- Todoの内容表示 -->
                        <div class="update-form__item">
                            <!-- $todo['content']-->
                            <input class="update-form__item-input" type="text" name="content" value="{{ $todo['content']}}">
                            <!-- $todo['id']はブラウザ上に表示されないためhydden設定 -->
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        <!-- カテゴリの内容表示：多分後でカテゴリの内容が表示される -->
                        <div class="update-form__item">
                            <!--
                            下記の状態では、categoriesテーブルのnameで登録された内容が表示されない
                            <p class="update-form__item-p">Category1</p>
                            これを変更し、下記にすることで実際に自分がカテゴリ一覧で登録したnameに該当する部分が表示されるようになる
                             -->
                            <p class="update-form__item-p">{{ $todo['category']['name'] }}</p>
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