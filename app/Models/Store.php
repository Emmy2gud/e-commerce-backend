<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Store extends Model
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasApiTokens,  HasFactory, Notifiable;

    protected $fillable = [
        'store_name',
        'description',
        'user_id', // Assuming a store is owned by a user
        'country',
        'full_address',
        'city',
        'store_coverphoto',
        'store_profilephoto',
        'facebook',
        'twitter',
        'instagram',
        'return_policy',
        'shipping_policy',
        'privacy_policy',
        'store_email',
        'phone_number',
        'business_hours',
        'status', // pending, approved, rejected
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
