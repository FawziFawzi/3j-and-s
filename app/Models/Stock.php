<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable =[
      'product_id',
      'total_stocks',
      'remaining_stocks',
      'stock_price'
    ];
}
