<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function listar (Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $empresa=Empresa::all();
        }
        else {
            $empresa=Empresa::where('empresa.nombre','like','%'. $buscar.'%')->get();
        }
        return $empresa;    
    }

    public function guardar(Request $request){
        $empresa=new Empresa();
        $empresa->nombre=$request->nombre;
        $empresa->nit=$request->nit;
        $empresa->telefono=$request->telefono;
        $empresa->save();
    }
    public function modificar(Request $request){
        $empresa= Empresa::findOrFail($request->id);
        $empresa->nombre=$request->nombre;
        $empresa->nit=$request->nit;
        $empresa->telefono=$request->telefono;
        $empresa->save();
    }
    public function eliminar(Request $request){
        $empresa= Empresa::findOrFail($request->id);
        $empresa->delete();
    }
}
