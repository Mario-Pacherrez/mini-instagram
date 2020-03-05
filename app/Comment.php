<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id_comment';

    // Relación de Muchos a Uno
    public function user(){
        return $this->belongsTo(User::class, 'fk_user');
    }

    // Relación de Muchos a Uno
    public function image(){
        return $this->belongsTo(Image::class, 'fk_image');
    }
}