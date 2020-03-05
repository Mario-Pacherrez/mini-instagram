<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){

        // Validación
        $validate = $this->validate($request, [
            'image_path' => ['required', 'image'],
            'description' => ['required'],
        ]);

        // Recoger datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Asignar valores nuev objeto
        $user = \Auth::user();
        $image = new Image();
        $image->fk_user = $user->id_user;
        $image->description = $description;

        // Subir fichero
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')->with([
            'message' => 'La foto ha sido subida correctamente !!'
        ]);
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id_image){
        $image = Image::find($id_image);
        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id_image){
        $user = \Auth::user();
        $image = Image::find($id_image);
        $comments = Comment::where('fk_image', $id_image)->get();
        $likes = Like::where('fk_image', $id_image)->get();

        if($user && $image && $image->user->id_user == $user->id_user) {
            // Eliminar comentarios
            if($comments && count($comments) >= 1){
                foreach ($comments as $comment){
                    $comment->delete();
                }
            }

            // Eliminar los likes
            if($likes && count($likes) >= 1){
                foreach ($likes as $like){
                    $like->delete();
                }
            }

            // Eliminar ficheros de imagen
            Storage::disk('images')->delete($image->image_path);

            // Eliminar registros de la imágen
            $image->delete();

            $message = array('message' => 'La imágen se ha borrado correctamente.');
        } else {
            $message = array('message' => 'La imágen no se ha borrado correctamente.');
        }
        return redirect()->route('home')->with($message);
    }

    public function edit($id_image){
        $user = \Auth::user();
        $image = Image::find($id_image);

        if ($user && $image && $image->user->id_user == $user->id_user) {
            return view('image.edit', [
                'image' => $image
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function update(Request $request) {
        // Validación
        $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['image']
        ]);

        // Recoger datos
        $fk_image = $request->input('id_image');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Conseguir objeto imágen
        $image = Image::find($fk_image);
        $image->description = $description;

        // Subir fichero
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        // Actualizar registro
        $image->update();

        return redirect()->route('image.detail', ['id_image' => $fk_image])
            ->with(['message' => 'Imágen actualizada con éxito.']);
    }

}