<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_id',
        'user_id',
        'title',
        'description',
        'destinatario',
        'estado'
    ] ;


    //1-n on users
    public function user(){
        return $this->hasMany(User::class);
    }

    //relacion con categories
    public function category(){
        return $this->belongsTo(Category::class);
    }


}
