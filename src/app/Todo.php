<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    // テーブル名
    protected $table = 'todos';

    // fill()によって書き換え可能なカラムを指定
    protected $fillable = [
        'content',
    ];
}
