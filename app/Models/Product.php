<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Dışarıdan eklenebilir (fillable) sütunlara izin veriyoruz
   protected $fillable = ['name', 'category', 'description', 'price', 'stock', 'image'];
}