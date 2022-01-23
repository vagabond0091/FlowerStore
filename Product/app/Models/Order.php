<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'status',
        
    ];
    public function User(){
        return $this->belongsTo(User::class)->withTimestamps();
    } 
    public function Product(){
        return $this->belongsTo(Product::class)->withTimestamps();
    }
}
