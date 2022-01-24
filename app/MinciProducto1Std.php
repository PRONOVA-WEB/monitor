<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinciProducto1Std extends Model
{
    use HasFactory;
    protected $table = 'minci_producto1_std';
    protected $fillable = ['region','region_code','commune','commune_code','population','date','commit_cases'];
}
