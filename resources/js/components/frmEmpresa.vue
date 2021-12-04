<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">REGISTRO DE EMPRESA</div>
                    <div class="card-body">
                       <form method="POST">
                           <table>
                               <tr>
                                   <td>Nombre</td>
                                   <td><input type="text" v-model="nombre" placeholder="Nombre Empresa"></td>
                               </tr>
                               <tr>
                                   <td>Nit</td>
                                   <td><input type="text" v-model="nit" placeholder="Nit"></td>
                               </tr>
                               <tr>
                                   <td>telefono</td>
                                   <td><input type="text" v-model="telefono" placeholder="telefono"></td>
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
                           <input type="text" v-model="buscar" placeholder="Nombre Empresa">
                            <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
                       </form>
                       <br>
                        <br>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Nit</th>
                                    <th>telefono</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="empresa in arrayEmpresa" :key="empresa.id">
                                    <td v-text="empresa.id"></td>
                                    <td v-text="empresa.nombre"></td>
                                    <td v-text="empresa.nit"></td>
                                    <td v-text="empresa.telefono"></td>
                                    <td><a href="#" @click="editar(empresa)">Seleccionar</a></td>
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
                id_empresa:0,
                nombre :'',
                nit:'',
                telefono:'',
                buscar : '',
                arrayEmpresa : []
            }
        },
        methods:{
            listar(buscar){
                let me = this;
                 var url='/empresa?buscar=' + buscar;
                //var url='/empresa';
                axios.get(url).then(function(response){
                    me.arrayEmpresa= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            nuevo(){
                let me = this;
                me.id_empresa=0;
                me.nombre='';
                me.nit='';
                me.telefono='';
                me.buscar='';
            },
            guardar(){
                let me = this;
                axios.post('empresa/guardar',{
                    'nombre': me.nombre,
                    'nit': me.nit,
                    'telefono': me.telefono,
                }).then(function(error){
                    me.listar('');
                    me.nuevo();
                }).catch(function(error){
                    console.log(error);
                });               
            },
            editar(data=[]){
                this.id_empresa = data['id'];
                this.nombre = data['nombre'];
                this.nit = data['nit'];
                this.telefono = data['telefono'];
            },
             modificar(){
                let me = this;
                axios.put('empresa/modificar',{
                    'nombre': this.nombre,
                    'nit' : this.nit,
                    'telefono' : this.telefono,
                    'id': this.id_empresa
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            eliminar(){
                let me = this;
                axios.delete('empresa/eliminar/'+me.id_empresa).then(function(error){
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
