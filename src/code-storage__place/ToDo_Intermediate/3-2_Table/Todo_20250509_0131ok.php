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
}
