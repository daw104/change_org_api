<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //1-n con peticiones
    public function petition(){
        return $this->hasMany(Peticione::class);
    }


}
