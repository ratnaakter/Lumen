<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'started_at', 'last_renewed_at', 'active_until',
    ];

    protected $table = 'memberships';
}