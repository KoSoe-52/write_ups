<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriteUpPoint extends Model
{
    use HasFactory;
    protected $fillable =[
        "write_up_id","point"
    ];
}
