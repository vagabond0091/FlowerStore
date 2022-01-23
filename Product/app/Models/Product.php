<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_name',
        'product_description',
        'price',
        'quantity',
        'status',
        'image_link'
    ];
    public function User(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    
    public function Order(){
        return $this->hasMany(Order::class)->withTimestamps();
    }
}
