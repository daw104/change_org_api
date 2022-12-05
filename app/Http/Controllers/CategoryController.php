<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //guardar una categoria
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        $category = Category::create([
            'name' => $request->get('name'),
        ]);
        return response()->json(['message'=>'Categoria Created satisfactoriamente','data'=>$category],200);
    }


    public function show(Category $category){
        return response()->json(['message'=>'Este es la categoria','data'=>$category],200);
    }


    //mostrar todos los usuarios
    public function show_all(){
        $categories = Category::all();
        return response()->json($categories);
    }


}
