<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'destinatario',
        'firmantes',
        'estado',
        'image',
        'categorie_id',
        'user_id'
    ] ;


    //1-n on users
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion con categories
    public function category(){
        return $this->belongsTo(Category::class);
    }


}
