<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // カラムの操作を可能にする
    // リレーション追加時に、category_idも編集可能に追記
    protected $fillable = [
        'category_id',
        'content'
    ];

    // リレーションを設定する。belongsTo使用
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Todo検索：もし引数の$category_idが空でない場合,categpry_idで検索を行う処理
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    // Todo検索：引数$keywordが空でなかった場合にcontent（Todoの内容）で検索を行う処理
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            // whereメソッド内でlikeを使用すると部分一致の検索を行うことができる
            $query->where('content', 'like', '%'. $keyword . '%');
        }
    }

}
