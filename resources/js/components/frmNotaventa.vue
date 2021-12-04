<template>
<main>
    <div class="container">
        
        <template v-if="listado==0">
        <center>    
           <h3>FORMULARIO DE VENTAS</h3>
                 <form action="" method="post">
                 <table>
                     <tr>
                         <td>fecha venta</td>
                         <td>
                              <input type="date" v-model="fecha">  
                         </td>
                    </tr>
                    <tr>
                        <td>cliente</td>
                          <td><input type="text" v-model="nombrecliente"></td>
                          <a href="#" @click="modalcliente()" data-toggle="modal" data-target="#modalcliente">Buscar clientes</a>
                    </tr>    
                    <tr>
                        <td></td>
                          <td> <a href="#" data-toggle="modal" data-target="#modalproducto">Buscar productos</a></td>
                         
                    </tr>   
                </table>

                </form>  
                <table border="1"> 
                        <thead>
                            <tr> 
                                <th>opcion</th>
                                <th>producto</th>
                                <th>precio</th>
                                <th>cantidad</th>
                                <th>subtotal</th>
                            </tr> 
                        </thead>
                        

                        <tbody v-if="arrayDetalle.length">
                            <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                <td><a href="#" @click="eliminardetalle(index)">Quitar</a></td>
                                <td v-text="detalle.producto"></td>
                                <td v-text="detalle.precio"></td>
                                <td>
                                    <span style="color:red;" v-show="detalle.cantidad>detalle.stock">stock:{{ detalle.stock}}</span>
                                        <input type="number" v-model="detalle.cantidad">  
                                </td> 
                                <td> {{ detalle.preciov=detalle.precio*detalle.cantidad}}</td>
                            </tr>
                            <tr style="background-color: #CEECF5"> 
                                <td colspan="4" align="right">total</td>
                                <td>{{ monto = calculartotal }}</td>
                            </tr>
                        </tbody>
                </table> 

                            
                 <button type="button" @click="guardarventa()">Guardar</button>
                  <br>
                  <a href="#" @click="listadouno()"> ver listado</a>      
        </center> 

            
        </template>
        <template v-if="listado==1">

             <h2>listado de ventas</h2>

             <table border="1"> 
                        <thead>
                            <tr> 
                                <th>codigo ventas</th>
                                <th>fecha venta</th>
                                <th>monto total</th>
                                <th>clientes</th>
                                <th>opciones</th>
                            </tr> 
                        </thead>
                        <tbody>
                                <tr v-for="venta in arrayVenta" :key="venta.id">
                                    <td v-text="venta.id"></td>
                                    <td v-text="venta.fecha"></td>
                                    <td v-text="venta.monto"></td>
                                    <td v-text="venta.nombre + ' ' + venta.apellidos"></td>
                                    
                                    <td><a href="#" data-dismiss="modal" @click="seleccionarventas(venta)">ver detalle</a></td>
                                </tr>
                            </tbody>
                </table> 
                <br>
                 <a href="#" @click="listadocero()"> volver</a> 
        </template>
        

    </div>
    <!-- Inicio Modal frmBuscarCliente -->
        <div class="modal fade" id="modalcliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Busqueda de clientes</h4>
                        <button type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarC" placeholder="Nombre">
                                    <button type="button" @click="buscarCliente(buscarC)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th>correo_electronico</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cliente in arrayCliente" :key="cliente.id">
                                    <td v-text="cliente.id"></td>
                                    <td v-text="cliente.nombre"></td>
                                    <td v-text="cliente.apellidos"></td>
                                    <td v-text="cliente.telefono"></td>
                                    <td v-text="cliente.correo_electronico"></td>
                                    
                                    <td><a href="#" data-dismiss="modal" @click="seleccionarCliente(cliente)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalproducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Busqueda de productos</h4>
                        <button type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarP" placeholder="Nombre">
                                    <button type="button" @click="buscarProducto(buscarP)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>descripcion</th>
                                    <th>precio</th>
                                    <th>stock</th>
                                    <th>categoria</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in arrayProducto" :key="producto.id">
                                    <td v-text="producto.id"></td>
                                    <td v-text="producto.descripcion"></td>
                                    <td v-text="producto.precio"></td>
                                    <td v-text="producto.stock"></td>
                                    <td v-text="producto.categoria"></td>
                                    
                                    <td><a href="#" data-dismiss="modal" @click="seleccionarProducto(producto)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
</main>
</template>


<script>

export default {
    data() {  
        return{
            id_venta:0,
            fecha:'',
            monto:0.0,
            id_cliente:0,
            nombrecliente:'',
            buscarC:'',
             buscarP:'',
            arrayDetalle: [],

            arrayProducto : [],
            arrayCliente : [],
            arrayVenta : [],
            listado:0,
        }
    },
    computed:{ 
        calculartotal: function(){
            var resultado = 0.0;
            for( var i=0; i<this.arrayDetalle.length;i++){
                resultado=resultado+(this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad);
            }
            return resultado;
        }
    },
    methods:{
        modalcliente(){
         let me = this;
                me.arrayCliente=[];
                me.buscarC='';

        },

        buscarCliente(buscarC){
             let me = this;
                 var url='/cliente?buscar=' + buscarC;
                //var url='/cliente';
                axios.get(url).then(function(response){
                    me.arrayCliente= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });


        },
         buscarProducto(buscarP){
             let me = this;
                 var url='/producto?buscar=' + buscarP;
                //var url='/producto';
                axios.get(url).then(function(response){
                    me.arrayProducto= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });


        },
        seleccionarCliente(data=[]){
        this.nombrecliente=data ['nombre'];  
        this.id_cliente=data ['id']; 
    
        },
        seleccionarProducto(data=[]){
            let me=this;
            me.arrayDetalle.push({
                id_producto:data['id'],
                producto:data['descripcion'],
                cantidad:1,
                precio:data['precio'],
                preciov:0,
                stock:data['stock']
            });
        
        },
        eliminardetalle(index){
        this.arrayDetalle.splice(index,1)

        },
         guardarventa(){
            let me = this;
            axios.post('/notaventa/guardar',{
                fecha: this.fecha,
                monto: this.monto,
                id_cliente: this.id_cliente,
                data: this.arrayDetalle
            }).then(function(error){
                alert('bien...');
            }).catch(function(error){
                console.log(error);
            });               
        },


        listadouno(){
        this.listado=1;
        this.listarventas();
        },

        listarventas(){
         let me = this;
                 var url='/notaventa';
                axios.get(url).then(function(response){
                    me.arrayVenta= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });    

        },

        listadocero(){
         this.listado=0;   
        }
        
        


    },
    mounted(){

    }
}
</script>
