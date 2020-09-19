<template>

    <div >
    
          <div class="col-md-12">
            <div class="card">
             
              <div class="card-header">
                 <h3 class="card-title">Registros de  restaurante </h3>
                 
                 <router-link to="/restauranteAdd" tag="button" class="btn btn-success">Crear restaurante</router-link>

                 </div>
              </div>

            <table class="table table-striped p-0  table-bordered">
                <thead>
                  <tr>
                     <th scope="col">id</th>
                     <th scope="col">Nombre</th>
                     <th scope="col">Descripcion</th>
                     <th scope="col">Dirección </th>
                     <th scope="col">Ciudad </th>
                     <th scope="col">foto </th>

                     <th scope="col-2">Accion</th>
                  </tr>
                 </thead>
                <tbody>
                    <tr v-for="(item , index) in restaurante" :key="index">
                         <td>{{item.id}}</td>
                         <td>{{item.nombre}}</td>
                         <td>{{item.descripcion}}</td>
                         <td>{{item.direccion}}</td>
                         <td>{{item.ciudad}}</td>
                         <td>
                          <img :src="`${item.foto}`" style="width:80px; height:80px;  border-radius:50%">
                          </td>

                         <td>
                           <router-link :to="{name: 'restauranteEdit', params: { id: item.id }}" class="btn btn-primary">Edit
                           </router-link>
                            <button class="btn btn-danger" @click="deleteRestaurante(item.id)">Delete</button>

                          </td>
                          
                   </tr>
                 </tbody>
               </table>
            </div>
        </div>

 </template>
<script>
    export default {
        mounted() {
            this.getDatos();
        },
        data(){
            return{
                restaurante: [],
                editMode: false,
            }
        },
         methods:{
             
            getDatos(){
            var urlTienda ='api/restaurante';
            axios.get(urlTienda).then(response =>{
                this.restaurante =response.data
            })
            },
            deleteRestaurante(id){
                 if(confirm("Esta seguro de Eliminar el restaurante")){
                   axios.delete(`api/restaurante/${id}`)
                    .then(resp =>{
                        let i = this.restaurante.map(item => item.id).indexOf(id);
                         this.restaurante.splice(i, 1)
                        toastr.success('el restaurante ha sido eliminada con exito!');
                     })
                 }
            }
        }
       
    }
</script>