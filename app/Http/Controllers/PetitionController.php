<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetitionController extends Controller
{
    //

    public function store_1(Request $request){
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'destinatario' => 'required',
            'file' => 'required',
        ]);
        $input = $request->all();
        $category = Category::findOrFail($input['category']);
        //$user = Auth::user(); //asociarlo al usuario authenticado
        $peticion = new Peticione($input);
        //$peticion->user()->associate($user);
        $peticion->category()->associate($category);
        $peticion->firmantes = 0;
        $peticion->estado = 'pendiente';
        $peticion->save();
        return $peticion;
    }

    public function store(Request $request){
        dd($request);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'destinatario' => 'required|string',
            'image' => 'required',
            'user_id' => 'required|integer',
            'categorie_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $petition = Petition::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'destinatario' => $request->get('destinatario'),
            'image' => $request->get('description'),
            'description' => $request->get('description'),
            'description' => $request->get('description'),
        ]);
        return response()->json(['message'=>'Peticion Created','data'=>$petition],200);
    }



}
