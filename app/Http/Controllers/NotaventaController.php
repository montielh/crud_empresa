<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notaventa;
use App\Models\Detalleventa;
use DB;

class NotaventaController extends Controller
{
    public function listar (Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $notaventa=Notaventa::join ('cliente','notaventa.id_cliente','=','cliente.id')
            ->select('notaventa.id','notaventa.fecha','notaventa.monto','cliente.nombre','cliente.apellidos')
            ->get();
        }
        else {
            $notaventa=Notaventa::join ('cliente','notaventa.id_cliente','=','cliente.id')
            ->select('notaventa.id','notaventa.fecha','notaventa.monto','cliente.nombre','cliente.apellidos')
            ->where('notaventa.nombre','like','%'. $buscar.'%')
            ->get();
            

        }
        return $notaventa;    
    }

    public function guardar(Request $request){
        try{
           DB::beginTransaction();
           $notaventa = new Notaventa;
           $notaventa->fecha=$request->fecha;
           $notaventa->monto=$request->monto;
           $notaventa->id_cliente=$request->id_cliente;
           $notaventa->save();

           $detalleventa = $request->data;
           foreach($detalleventa as $ep=>$det){
                $detalle = new Detalleventa();
                $detalle->id_venta=$notaventa->id;   
                $detalle->id_producto=$det['id_producto']; 
                $detalle->cantidad=$det['cantidad'];
                $detalle->preciov=$det['preciov'];
                $detalle->save();
            }
          DB::commit();
          return[
             'id'=>$notaventa->id   
            ];
        }   catch (Exception $e) {
            DB::rollBack();        
        }
    }

    public function eliminar(Request $request){
        $notaventa= Notaventa::findOrFail($request->id);
        $notaventa->delete();
    }

    




}
