<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['app_name', 'user_id','rate_us_link', 'share_link', 'share_subject', 'image_url', 'privacy_policy_link', 'terms_condition_link', 'disclaimer_link'];
}
