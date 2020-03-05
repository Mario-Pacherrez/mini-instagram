<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        // Validación
        $validate = $this->validate($request, [
            'fk_image' => ['required', 'integer'],
            'content' => ['required', 'string'],
        ]);

        // Recoger datos
        $user = \Auth::user();
        $fk_image = $request->input('fk_image');
        $content = $request->input('content');

        // Asigno los valores a mi nuevo objeto a guardar
        $comment = new Comment();
        $comment->fk_user = $user->id_user;
        $comment->fk_image = $fk_image;
        $comment->content = $content;

        // Guardar en la BD
        $comment->save();

        // Redirección
        return redirect()->route('image.detail', ['id_image' => $fk_image])
            ->with([
                'message' => 'Has publicado tu comentario correctamente. !!'
            ]);
    }

    public function delete($id_comment){
        // Conseguir datos del usuario logueado
        $user = \Auth::user();

        // Conseguir objeto del comentario
        $comment = Comment::find($id_comment);

        // Comprobar si soy el dueño del comentario o de la publicación
        if ($user && ($comment->fk_user == $user->id_user || $comment->image->fk_user == $user->id_user)) {
            $comment->delete();

            return redirect()->route('image.detail', ['id_image' => $comment->image->id_image])
                ->with([
                    'message' => 'Comentario eliminado correctamente. !!'
                ]);
        } else {
            return redirect()->route('image.detail', ['id_image' => $comment->image->id_image])
                ->with([
                    'message' => 'El comentario no se ha eliminado. !!'
                ]);
        }
    }
}