<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Assets extends Model
{
    //
    use SoftDeletes;
    protected $table = 'assets';
    protected $fillable = [
        'asset_old', 
        'asset_new', 
        'status',
        'serial_number', 
        'team', 
        'location', 
        'pic', 
        'remarks',
        'label',
        'ad_join',
        'drm',
        'antivirus',
        'hw',
        'power',
        'flag',
        'created_by',
    ];
    protected $dates = [
        'deleted_at'
    ];

}
