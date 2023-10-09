<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriteUp extends Model
{
    use HasFactory;
    protected $fillable =[
        "title","category_id","user_id","content","point","status"
    ];
    public function categories(){
        return $this->belongsTo("App\Models\Category","category_id","id");//role_id fk, id pk
     }
}
