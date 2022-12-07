<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PetitionController extends Controller
{
    //

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|max:255',
                'description' => 'required',
                'destinatario' => 'required',
                'categorie_id' => 'required'
            ]
        );

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $validator = Validator::make($request->all(),
            [
                'image' => 'required|mimes:png,jpg|max:4096',
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        if ($file = $request->file('image')) {
            $name = $file->getClientOriginalName();
            $file->move('peticionesimgs/', $name);
            $input['image'] = $name;
        }

        $categoria = Category::findOrFail($input['categorie_id']);
        $user = Auth::user(); //asociarlo al usuario authenticado
        $peticion = new Petition($input);
        $peticion->user()->associate($user);
        $peticion->category()->associate($categoria);
        $peticion->firmantes = 0;
        $peticion->estado = 'pendiente';
        $peticion->image = 'public/peticionesimgs/' . $input['image'];
        $peticion->save();

        $imgdb = new File();
        $imgdb->name = $input['image'];
        $imgdb->peticiones_id = $peticion->id;
        $imgdb->file_path = 'public/peticionesimgs' . $input['image'];
        $imgdb->save();

        return $peticion;
    }

    public function store_(Request $request){
        $peti= json_decode($request->peticion);
//        $validator = Validator::make($request->get('peticion'), [
//            'title' => 'required|string|max:255',
//            'description' => 'required|string',
//            'destinatario' => 'required|string',
//            'user_id' => 'required|integer',
//            'categorie_id' => 'required|integer',
//        ]);

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'destinatario' => 'required|string',
            'user_id' => 'required|integer',
            'categorie_id' => 'required|integer',
        ]);





        $image = $request->file;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->file->move('peticionesimgs',$imagename);



//        if($validator->fails()){
//            return response()->json($validator->messages(), 400);
//        }


        $petition = Petition::create([
            'title' => $peti->title,
            'description' => $peti->title,
            'destinatario' => $peti->title,
            'estado'=>'pendiente',
            'firmantes'=>0,
            'image' => $imagename,
            'user_id' => $peti->title,
            'categorie_id' => $peti->title,
        ]);
        return response()->json(['data'=>$peti],200);
       // return response()->json(['message'=>'Peticion Created','data'=>$petition],200);
    }



}
