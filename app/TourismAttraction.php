<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismAttraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description','image_url','attachments', 'link_url'
    ];
}
