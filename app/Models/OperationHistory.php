<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OperationHistory extends Model
{
    protected $fillable = [
        'operation',
        'value',
        'user_id',
    ];
}
