<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table = 'announcement';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'url',
        'image_url',
        'publish_date',
        'posted_on_instagram',
        'posted_on_twitter',
        'posted_on_facebook',
    ];
}
