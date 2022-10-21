<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public static function tags(){
        $tags = [
            'EVENT'=>'Event',
            'CULINARY'=>'Culinary',
            'CULTURE'=>'Culture'
        ];
        return $tags;
    }
    public static function getTagByKey($key){
       
        return self::tags()[$key];
    }
    
    protected $fillable = [
        'title', 'description', 'tag','image_url','attachments'
    ];
}
