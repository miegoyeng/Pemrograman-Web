<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fighter extends Model
{
    //
    use HasFactory;
    /** 
    * fillable 
    * 
    * @var array 
    */ 
    protected $fillable = [
        'name',
        'weight_class',
        'record',
        'region',
    ];
}
