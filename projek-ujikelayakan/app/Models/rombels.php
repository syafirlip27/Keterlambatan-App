<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rombels extends Model
{
    use HasFactory;
    protected $fillable = ([
        'rombel',
    ]);
    public function student (){
        return $this->belongsTo(lates::class, 'user_id', 'id');
    }
}