<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Purchase;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'kana',
        'tel',
        'email',
        'postcode',
        'address',
        'birthday',
        'gender',
        'memo'
    ];

    public function scopeSearchCustomers($query, $input = null)
    {
        if (!empty($input)) {
            if (Customer::where('kana', 'like', $input . '%')
                ->orWhere('tel', 'like', $input . '%')->exists()
            ) {
                return $query->where('kana', 'like', $input . '%')
                    ->orWhere('tel', 'like', $input . '%');
            }
        }
    }

    public function purchases()
    {
        // hasManyは、1対多のリレーションを定義
        return $this->hasMany(Purchase::class);
    }
}
