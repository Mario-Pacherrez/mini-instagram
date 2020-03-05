<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = \Auth::user();
        $likes = Like::where('fk_user', $user->id_user)->orderBy('id_like', 'desc')
            ->paginate(5);

        return view('like.index', [
            'likes' => $likes
        ]);
    }

    public function like($id_image){
        // Recoger datos del usuario y la imagen
        $user = \Auth::user();

        // Condición para ver si ya existe el like y no duplicarlo
        $isset_like = Like::where('fk_user', $user->id_user)
                            ->where('fk_image', $id_image)
                            ->count();

        if($isset_like == 0){
            $like = new Like();
            $like->fk_user = $user->id_user;
            $like->fk_image = (int) $id_image;

            // Guardar
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'El like ya existe.'
            ]);
        }
    }

    public function dislike($id_image){
        // Recoger datos del usuario y la imagen
        $user = \Auth::user();

        // Condición para ver si ya existe el like y no duplicarlo
        $like = Like::where('fk_user', $user->id_user)
                      ->where('fk_image', $id_image)
                      ->first();

        if($like) {
            // Eliminar like
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'Has dado Dislike correctamente.'
            ]);
        } else {
            return response()->json([
                'message' => 'El like no existe.'
            ]);
        }
    }
}