<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function listar (Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $cliente=Cliente::all();
        }
        else {
            $cliente=Cliente::where('cliente.nombre','like','%'. $buscar.'%')->get();
        }
        return $cliente;    
    }

    public function guardar(Request $request){
        $cliente=new Cliente();
        $cliente->nombre=$request->nombre;
        $cliente->apellidos=$request->apellidos;
        $cliente->fechaNacimiento=$request->fechaNacimiento;
        $cliente->sexo=$request->sexo;
        $cliente->ci=$request->ci;
        $cliente->telefono=$request->telefono;
        $cliente->correo_electronico=$request->correo_electronico;
        $cliente->save();
    }
    public function modificar(Request $request){
        $cliente= Cliente::findOrFail($request->id);
        $cliente->nombre=$request->nombre;
        $cliente->apellidos=$request->apellidos;
        $cliente->fechaNacimiento=$request->fechaNacimiento;
        $cliente->sexo=$request->sexo;
        $cliente->ci=$request->ci;
        $cliente->telefono=$request->telefono;
        $cliente->correo_electronico=$request->correo_electronico;
        $cliente->save();
    }
    public function eliminar(Request $request){
        $cliente= Cliente::findOrFail($request->id);
        $cliente->delete();
    }


}
