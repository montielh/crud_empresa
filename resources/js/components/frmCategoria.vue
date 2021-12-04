<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">REGISTROS DE CATEGORIAS</div>
                    <div class="card-body">
                       <form method="POST">
                           <table>
                               <tr>
                                   <td>Nombre</td>
                                   <td><input type="text" v-model="nombre" placeholder="Nombre Categoria"></td>
                               </tr>
                               
                                <td colspan="3">
                                    <button type="button" @click="nuevo()">Nuevo</button>
                                    <button type="button" @click="guardar()">Guardar</button>
                                    <button type="button" @click="modificar()">modificar</button>
                                    <button type="button" @click="eliminar()">eliminar</button>
                                </td>
                           </table>
                           <input type="text" v-model="buscar" placeholder="Nombre Categoria">
                            <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
                       </form>
                       <br>
                        <br>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                    <td v-text="categoria.nombre"></td>
                                    <td><a href="#" @click="editar(categoria)">Seleccionar</a></td>
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
                id_categoria:0,
                nombre :'',
                buscar : '',
                arrayCategoria : []
            }
        },
        methods:{
            listar(buscar){
                let me = this;
                 var url='/categoria?buscar=' + buscar;
                //var url='/categoria';
                axios.get(url).then(function(response){
                    me.arrayCategoria= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            nuevo(){
                let me = this;
                me.id_categoria=0;
                me.nombre='';
                me.buscar='';
            },
            guardar(){
                let me = this;
                axios.post('categoria/guardar',{
                    'nombre': me.nombre,
                }).then(function(error){
                    me.listar('');
                    me.nuevo();
                }).catch(function(error){
                    console.log(error);
                });               
            },
            editar(data=[]){
                this.id_categoria = data['id'];
                this.nombre = data['nombre'];
            },
             modificar(){
                let me = this;
                axios.put('categoria/modificar',{
                    'nombre': this.nombre,
                    'id': this.id_categoria
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            eliminar(){
                let me = this;
                axios.delete('categoria/eliminar/'+me.id_categoria).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
        },
        mounted() {
           this.listar(this.buscar);
        }
    }
</script>
