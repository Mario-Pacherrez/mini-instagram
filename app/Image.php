<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id_image';

    // Relación One To Many / de uno a muchos
    public function comments(){
        return $this->hasMany(Comment::class, 'fk_image', 'id_image')
            ->orderBy('id_comment', 'desc');
    }

    // Relación One To Many
    public function likes(){
        return $this->hasMany(Like::class, 'fk_image', 'id_image');
    }

    // Relación de Mucho a Uno
    public function user(){
        return $this->belongsTo(User::class, 'fk_user');
    }
}