<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardPointLog extends Model
{
    protected $fillable = ['user_id', 'action', 'points', 'remarks'];
}
