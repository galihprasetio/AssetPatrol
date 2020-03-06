<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryAsset extends Model
{
    //
    protected $table = 'history_asset';
    protected $fillable = [
        'serial_number',
        'status',
        'location',
        'pic',
        'remark',
        'updated_by',
        'created_at',
        'updated_at',
    ];

}
