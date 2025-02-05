<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    /**
     * List of attributes that mass assignable.
     */
    protected $fillable = [
        'short_url',
        'full_url',
    ];

    /**
     * Current primary key name
     */
    protected $primaryKey = 'short_url';

    /**
     * Current primary key data type
     */
    protected $keyType = 'string';

    /**
     * Current table name
     */
    protected $table = 'url';
}
