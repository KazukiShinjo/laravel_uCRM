<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Item;

class Purchase extends Model
{
    use HasFactory;

    // $fillableは、不正なデータ登録を防ぐため、一括代入を許可するカラムを制限する
    protected $fillable = [
        'customer_id',
        'status',
    ];

    public function customer()
    {
        // belongsToは、多対1のリレーションを定義
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        // belongsToManyは、多対多のリレーションを定義
        // withPivotは、中間テーブルのカラムを取得するためのメソッド
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }
}
