<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'schedule','link_url'
    ];

    public function getSchedule(){
    
        return Carbon::createFromFormat('Y-m-d H:i:s',$this->schedule)->format('d/m/Y h:i A');
    }
    
}
