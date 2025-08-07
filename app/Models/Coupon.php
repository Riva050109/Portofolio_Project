<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $guarded=[];
    public static $rules = [
        'code' => 'required|string|unique:coupons',
        'type' => 'required|in:fixed,percentage',
        'value' => 'required|numeric|min:0',
        'valid_until' => 'nullable|date',
        'usage_limit' => 'nullable|integer|min:1',
    ];
    public function scopeValid($query, $code)
    {
        return $query->where('code', $code)
                     ->where('valid_until', '>=', now())
                     ->orWhereNull('valid_until')
                     ->where(function ($q) {
                         $q->whereNull('usage_limit')
                           ->orWhere('usage_limit', '>', 0);
                     });
    }
}
