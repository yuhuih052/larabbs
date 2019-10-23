<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //设置$filllable白名单属性，允许修改的字段
    protected $fillable = [
    	'name', 'description',
    ];
}
