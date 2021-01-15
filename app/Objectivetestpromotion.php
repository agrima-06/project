<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectivetestpromotion extends Model
{
    use HasFactory; 

    protected $guarded = [
        'id'
    ];

    public function Objectivetest()
    {
        return $this->belongsTo(Objectivetest::class);
    }

}
