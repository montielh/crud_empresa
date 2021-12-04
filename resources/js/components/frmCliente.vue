<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">REGISTRO DE CLIENTES</div>
                    <div class="card-body">
                       <form method="POST">
                           <table>
                               <tr>
                                   <td>Nombre</td>
                                   <td><input type="text" v-model="nombre" placeholder="Nombre Cliente"></td>
                               </tr>
                               <tr>
                                   <td>Apellidos</td>
                                   <td><input type="text" v-model="apellidos" placeholder="Apellidos"></td>
                               </tr>
                               <tr>
                                   <td>Fecha Nacimiento</td>
                                   <td><input type="date" v-model="fechaNacimiento" placeholder="Fecha Nacimiento"></td>
                               </tr>
                               <tr>
                                   <td>sexo</td>        
                                   <td>                                       
                                       <select v-model="sexo">
                                           <option value="">Seleccione</option>
                                           <option value="M">Masculino</option>
                                           <option value="F">Femenino</option>
                                       </select>
                                       
                                    </td>
                               </tr>
                               <tr>
                                   <td>Nro Carnet</td>
                                   <td><input type="text" v-model="ci" placeholder="ci"></td>                                
                              </tr>
                               <tr>
                                   <td>telefono</td>
                                   <td><input type="text" v-model="telefono" placeholder="telefono"></td>
                               </tr>
                               <tr>
                                   <td>correo electronico</td>
                                   <td><input type="text" v-model="correo_electronico" placeholder="gmail"></td>
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
                           <input type="text" v-model="buscar" placeholder="Nombre Cliente">
                            <button type="button" @click="listar(buscar)">Buscar por Nombre</button>
                       </form>
                       <br>
                        <br>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>ci</th>
                                    <th>sexo</th>
                                    <th>telefono</th>
                                     <th>correo_electronico</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cliente in arrayCliente" :key="cliente.id">
                                    <td v-text="cliente.id"></td>
                                    <td v-text="cliente.nombre"></td>
                                    <td v-text="cliente.apellidos"></td>
                                    <td v-text="cliente.fechaNacimiento"></td>
                                    <td v-text="cliente.ci"></td>
                                    <td v-text="cliente.sexo"></td>
                                    <td v-text="cliente.telefono"></td>
                                     <td v-text="cliente.correo_electronico"></td>
                                    <td><a href="#" @click="editar(cliente)">Seleccionar</a></td>
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
                id_cliente:0,
                nombre :'',
                apellidos:'',
                fechaNacimiento:'',
                sexo:'',
                ci:'',
                telefono:'',
                correo_electronico:'',
                buscar : '',
                arrayCliente : []
            }
        },
        methods:{
            listar(buscar){
                let me = this;
                 var url='/cliente?buscar=' + buscar;
                //var url='/cliente';
                axios.get(url).then(function(response){
                    me.arrayCliente= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            nuevo(){
                let me = this;
                me.id_cliente=0;
                me.nombre='';
                me.apellidos='';
                me.fechaNacimiento='';
                me.sexo='';
                me.ci='';
                me.telefono='';
                me.correo_electronico='';
                me.buscar='';
            },
            guardar(){
                let me = this;
                axios.post('cliente/guardar',{
                    'nombre': me.nombre,
                    'apellidos': me.apellidos,
                    'fechaNacimiento': me.fechaNacimiento,
                    'ci': me.ci,
                    'sexo': me.sexo,
                    'telefono': me.telefono,
                    'correo_electronico': me.correo_electronico
                }).then(function(error){
                    me.listar('');
                    me.nuevo();
                }).catch(function(error){
                    console.log(error);
                });               
            },
            editar(data=[]){
                this.id_cliente = data['id'];
                this.nombre = data['nombre'];
                this.apellidos = data['apellidos'];
                this.fechaNacimiento = data['fechaNacimiento'];
                this.ci = data['ci'];
                this.sexo = data['sexo'];
                this.telefono = data['telefono'];
                this.correo_electronico = data['correo_electronico'];
            },
             modificar(){
                let me = this;
                axios.put('cliente/modificar',{
                    'nombre': this.nombre,
                    'apellidos' : this.apellidos,
                    'fechaNacimiento' : this.fechaNacimiento,
                    'sexo' : this.sexo,
                    'ci' : this.ci,
                    'telefono' : this.telefono,
                    'correo_electronico' : this.correo_electronico,
                    'id': this.id_cliente
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            eliminar(){
                let me = this;
                axios.delete('cliente/eliminar/'+me.id_cliente).then(function(error){
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
