<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    use HasFactory, SoftDeletes;

    const PENDING = 1;
    const DIKEMAS = 2;
    const DIKIRIM = 3;
    const SELESAI = 4;

    protected $guarded = ['id', 'created_at', 'updated_at'],
        $dates = ['deleted_at'];


    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'checkout_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
