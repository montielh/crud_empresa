<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function listar (Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $producto=Producto::join('categoria as c','producto.id_categoria','=','c.id')
            ->select('producto.id','descripcion','precio','stock','id_categoria','c.nombre as categoria')
            ->get();
        }
        
        else {
            $producto=Producto::join('categoria as c','producto.id_categoria','=','c.id')
            ->select('producto.id','descripcion','precio','stock','id_categoria','c.nombre as categoria')
            ->where('producto.descripcion','like','%'. $buscar.'%')
            ->get();
        }
        return $producto;    
    }

    public function guardar(Request $request){
        $producto=new Producto();
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->stock=$request->stock;
        $producto->id_categoria=$request->id_categoria;
        $producto->save();
    }
    public function modificar(Request $request){
        $producto= Producto::findOrFail($request->id);
        $producto->descripcion=$request->descripcion;
        $producto->precio=$request->precio;
        $producto->stock=$request->stock;
        $producto->save();
    }
    public function eliminar(Request $request){
        $producto= Producto::findOrFail($request->id);
        $producto->delete();
    }


}

