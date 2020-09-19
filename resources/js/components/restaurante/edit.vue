<template>
<div>
     <h3 class="text-center">Actualizar   Restaurante</h3>
             <img  v-if="img == true"  :src="imagen"  class="rounded float-left" alt="" width="225" height="220">
             <img  v-else  :src="restaurantes.foto"  class="rounded float-left" alt="" width="225" height="220">
              <a :href="restaurantes.foto">Url</a>
        <div class="form-row">
            <form  @submit.prevent="editRestaurante" enctype="multipart/form-data">

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
</div>
</template>
<script>
 export default {
         data(){
           return{
               restaurantes:{},
               dataimagen:'',
               img : false
           }
         },
        mounted(){
            axios.get(`api/restaurante/${this.$route.params.id}`).then(response =>{
                this.restaurantes =response.data
            })
       },
        methods:{
            editRestaurante(){
                  const prams ={
                    nombre :this.restaurantes.nombre,
                    descripcion :this.restaurantes.descripcion,
                    direccion :this.restaurantes.direccion,
                    ciudad :this.restaurantes.ciudad,
                    foto :this.dataimagen
                }
             axios.put(`api/restaurante/${this.$route.params.id}`,prams)
                     .then(response =>{
                    this.$router.push({name: 'home'} )
                  toastr.success('el restaurante ha sido actualizada con exito!');
                  }).catch(error => {
                    toastr.error('Error');
                })
            },
            ObtenerImg(e){
                this.img = true;
                this.dataimagen='';
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
        },
        computed:{
            imagen(){
                return this.dataimagen;
            }
        }

       
 }
</script>