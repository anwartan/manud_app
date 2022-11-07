<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'attachments'
    ];
    public function getBudgetDateString() {
        return Carbon::createFromFormat('Y-m-d', $this->budget_date)->format('d/m/y');
    }
}
