<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id_like';

    // Relación de Muchos a Uno
    public function user(){
        return $this->belongsTo(User::class, 'fk_user');
    }

    // Relación de Muchos a Uno
    public function image(){
        return $this->belongsTo(Image::class, 'fk_image');
    }
}