<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'memo',
        'price',
        'is_selling',
    ];

    public function purchases()
    {
        // belongsToManyは、多対多のリレーションを定義
        // withPivotは、中間テーブルのカラムを取得するためのメソッド
        return $this->belongsToMany(Purchase::class)->withPivot('quantity');
    }
}
