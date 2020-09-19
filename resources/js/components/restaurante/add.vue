<template>
<div>
        <h3 class="text-center">Crear Restaurante</h3>
             <img :src="imagen" class="rounded float-left" alt="" width="225" height="220">

        <div class="form-row">
            <form  @submit.prevent="addRestaurante" enctype="multipart/form-data">

              <div class="col-md-6">
               
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="restaurantes.nombre" required>
                    </div>

                    <div class="form-group">
                        <label>Descripcion</label>
                        <input type="text" class="form-control" v-model="restaurantes.descripcion" required>
                    </div>

                     <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" v-model="restaurantes.direccion" required>
                    </div>
                    
                     <div class="form-group">
                        <label>Ciudad</label>
                        <input type="text" class="form-control" v-model="restaurantes.ciudad" required>
                     </div>

                    <input type="file" @change="ObtenerImg"  accept="image/png, image/jpeg" >

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <router-link to="/" tag="button" class="btn btn-default">Cancelar</router-link>
              </div>
            </form>

            </div>
        </div>

 </template>
<script>
   export default {
       data(){
           return{
               restaurantes:{},
               dataimagen:''
            }
       },
         computed:{
            imagen(){
                return this.dataimagen;
            }
        },
        methods:{
            addRestaurante(){
                const prams ={
                    nombre :this.restaurantes.nombre,
                    descripcion :this.restaurantes.descripcion,
                    direccion :this.restaurantes.direccion,
                    ciudad :this.restaurantes.ciudad,
                    foto :this.dataimagen

                }
                axios.post('api/restaurante',prams)
                .then(response =>{
                    this.$router.push({name: 'home'} )
                  toastr.success('el restaurante ha sido registrado con exito!');
                }
                )
                .catch(error => {
                    
                    toastr.error('Error');
                })
                 .finally(() => this.loading = false)

             },
            ObtenerImg(e){
                let file =e.target.files[0];
                this.restaurantes.foto =file
                this.cargarImg(file);
            },
            cargarImg(file){
               let cargar =new FileReader();
                cargar.onload =(e)=>{
                  this.dataimagen =e.target.result;
                }
               cargar.readAsDataURL(file);
            }
        }
       
   }
</script>