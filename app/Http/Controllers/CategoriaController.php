<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function listar (Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $categoria=Categoria::all();
        }
        else {
            $categoria=Categoria::where('categoria.nombre','like','%'. $buscar.'%')->get();
        }
        return $categoria;    
    }

    public function guardar(Request $request){
        $categoria=new Categoria();
        $categoria->nombre=$request->nombre;
        $categoria->save();
    }
    public function modificar(Request $request){
        $categoria= Categoria::findOrFail($request->id);
        $categoria->nombre=$request->nombre;
        $categoria->save();
    }
    public function eliminar(Request $request){
        $categoria= Categoria::findOrFail($request->id);
        $categoria->delete();
    }

    public function selectCategoria(){
        $categoria= Categoria::select('id','nombre')->get();
        return $categoria;
    }
}
