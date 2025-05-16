<!-- 
 ＜?php
＠foreachになる部分を先に定義してviewが動くか確認。のちにこの部分削除=>追加機能実装時にコメントアウトして残しておいた
$categories = ['category1', 'category2'];

foreach($categories as $category) {
    echo $category;
}
?＞ -->

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<!-- エラーメッセージの表示 -->
<div class="category__alert">
    <!-- 作成成功時 -->
    @if (session('successMessage'))
    <div class="category__alert--success">
        <!-- 後々追加のアクション時にメッセージ設定予定 -->
        {{ session('successMessage') }}
    </div>
    @endif
    <!-- もしエラーがあった場合時 -->
    @if ($errors->any())
        <div class="category__alert--danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
</div>

<!-- 表示するカテゴリ一覧の内容 -->
<div class="category__content">
    <!-- フォームの内容:actionとmethod後ほど追記 -->
    <form class="create-form" action="/categories" method="post">
        @csrf
        <!-- 入力するためのinputを含むitem -->
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="name" value="{{ old('name') }}">
        </div>
        <!-- 送信するためのボタン -->
        <div class="create-form__button">
            <button  class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>
    <!-- カテゴリ一覧のテーブル全体を囲む塊 -->
    <div class="category-table">
        <!-- テーブル本体 -->
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">category</th>
            </tr>
            <!-- ＜?php foreach($categories as $category) { ?＞を＠foreach($categories as $category)に変更 -->
            @foreach($categories as $category)
            <tr class="category-table__row">
                <td class="category-table__item">
                    <!-- action,method後で記述：updateアクションのためボタンまでひとくくり -->
                    <form class="update-form">
                        @csrf
                        <div class="update-form__content">
                            <!-- input内容をforeachの変数を使用して表示中 -->
                            <input class="update-form__content-input" type="text" name="content" value="{{ $category['name'] }}">
                        </div>
                        <div class="category-table-form__button">
                            <button class="category-table-form__button-submit category-table-form__button--update">更新</button>
                        </div>
                    </form>
                </td>
                <td class="category-table__item">
                    <!-- action,method後で記述：deleteアクションのためボタンだけ別の括り -->
                    <form class="delete-form">
                        @csrf
                        <div class="category-table-form__button">
                            <button class="category-table-form__button-submit category-table-form__button--delete">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
            <!-- ＜?php } ?＞を＠endforeachに変更 -->
        </table>
    </div>
</div>
@endsection