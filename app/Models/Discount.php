<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'tbl_discount';

    protected $fillable = [
        'percentage', 'trip_number', 'begin_at', 'end_at', 'status', 'description', 'created_at', 'updated_at', 'deleted_at', 'deleted_by', 'created_by', 'updated_by'
    ];
}
