<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    // テーブル名
    protected $table = 'todos';

    // fill()によって書き換え可能なカラムを指定
    protected $fillable = [
        'content',
    ];
}
