<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">REGISTRO DE PRODUCTOS</div>
                    <div class="card-body">
                       <form method="POST">
                           <table>
                               <tr>
                                   <td>Descripcion</td>
                                   <td><input type="text" v-model="descripcion" placeholder="Nombre Producto"></td>
                               </tr>
                               <tr>
                                   <td>Precio</td>
                                   <td><input type="text" v-model="precio" placeholder="precio"></td>
                               </tr>
                               <tr>
                                   <td>Stock</td>
                                   <td><input type="text" v-model="stock" placeholder="stock"></td>
                               </tr>
                               <tr>
                                   <td>Categoria</td>
                                   <td>
                                       <select v-model="id_categoria">
                                           <option value="0">Seleccionar</option>
                                           <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                                       </select>
                                   </td>
                               </tr>
                               <tr>
                                <td colspan="3">
                                    <button type="button" @click="nuevo()">Nuevo</button>
                                    <button type="button" @click="guardar()">Guardar</button>
                                    <button type="button" @click="modificar()">modificar</button>
                                    <button type="button" @click="eliminar()">eliminar</button>
                                </td>
                                </tr>
                           </table>
                           <input type="text" v-model="buscar" placeholder="Nombre Producto">
                            <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
                       </form>
                       <br>
                        <br>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Categoria</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in arrayProducto" :key="producto.id">
                                    <td v-text="producto.id"></td>
                                    <td v-text="producto.descripcion"></td>
                                    <td v-text="producto.precio"></td>
                                    <td v-text="producto.stock"></td>
                                     <td v-text="producto.categoria"></td>
                                     
                                    <td><a href="#" @click="editar(producto)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                id_producto:0,
                descripcion :'',
                precio:'',
                stock:'',
                buscar : '',
                id_categoria:0,
                arrayProducto : [],
                arrayCategoria : []
            }
        },
        methods:{
            listar(buscar){
                let me = this;
                 var url='/producto?buscar=' + buscar;
                //var url='/producto';
                axios.get(url).then(function(response){
                    me.arrayProducto= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectcategoria(){
                let me = this;
                 var url='/categorias/selectCategoria';
                axios.get(url).then(function(response){
                    me.arrayCategoria= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            nuevo(){
                let me = this;
                me.id_producto=0;
                me.descripcion='';
                me.precio='';
                me.stock='';
                me.buscar='';
            },
            guardar(){
                let me = this;
                axios.post('producto/guardar',{
                    'descripcion': me.descripcion,
                    'precio':me.precio,
                    'stock': me.stock,
                    'id_categoria': me.id_categoria,
                    
                }).then(function(error){
                    me.listar('');
                    me.nuevo();
                }).catch(function(error){
                    console.log(error);
                });               
            },
            editar(data=[]){
                this.id_producto = data['id'];
                this.descripcion = data['descripcion'];
                this.precio = data['precio'];
                this.stock = data['stock'];
                this.id_categoria = data['id_categoria'];
            },
             modificar(){
                let me = this;
                axios.put('producto/modificar',{
                    'descripcion': this.descripcion,
                    'precio' : this.precio,
                    'stock' : this.stock,
                    'id_categoria' : this.id_categoria,
                    'id': this.id_producto
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            eliminar(){
                let me = this;
                axios.delete('producto/eliminar/'+me.id_producto).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
        },
        mounted() {
           this.listar(this.buscar);
             this.selectcategoria();
        }
    }
</script>
