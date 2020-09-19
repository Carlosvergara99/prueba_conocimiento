<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                      <div class="card-header">
                       <h3 class="card-title text-center"> Registros Reserva </h3>

                     <div class="card-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#Reserva" @click="openModalWindow">Crear Reserva</button>
                      </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
                         <thead>
                          <tr>
                             <th scope="col">id</th>
                             <th scope="col">Fecha </th>
                             <th scope="col">Restaurante</th>
                             <th scope="col">No de reservas</th>
                             <th scope="col-2">Accion</th>

                           </tr>
                          </thead>
                         <tbody>
                            <tr  v-for="(item , index) in reservas " :key="index"> 
                               <th>{{item.id}}</th>
                               <td>{{item.fecha}}</td>
                               <td>{{item.nombre}}</td>
                               <td>{{item.numero_reservas}}</td>
                               <td>
                                   <button class="btn btn-primary" @click="GetReserva(item.id)">Editar</button>

                                   <button class="btn btn-danger" @click="deleteReserva(item.id)">Eliminar</button>

                               </td>
                             </tr>
                         </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="Reserva" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">

                 <h5  v-show="editMode== flase" class="modal-title">Crear Reserva </h5>
                 <h5  v-show="editMode == true" class="modal-title">Actualizar  Reserva </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

               <div class="modal-body">
                <form @submit.prevent="editMode ? updated() : add()">

                    <div class="form-group">
                        <label>Fecha de la reserva :</label>

                      <date-picker  v-model="reserva.fecha" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                     </div>

                    <div class="form-group">
                        <label>numero de reserva :</label>

                    <select v-model="reserva.numero_reservas" class="form-control" required>
                             <option v-for="(item , index) in numero " :key="index" :value="item">
                                  {{ item}}
                            </option>
                            <option disabled value="">Seleccione</option>
                         </select>
                    </div>

                    <div class="form-group">
                        <label>restaurante :</label>

                        <select v-model="reserva.id_restaurantes" class="form-control" required>
                             <option v-for="(item , index) in restaurante " :key="index" :value="item.id">
                                  {{ item.nombre }}
                            </option>
                            <option disabled value="">Seleccione</option>
                         </select>

                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
          
                 </div>
            </div>
            </div>
    </div>
</template>

<script>
  import datePicker from 'vue-bootstrap-datetimepicker';

    export default {
        mounted() {
           this.GetReservas();
           this.GetRestaurante();
        },
        data(){
            return{
                reservas:{},
                restaurante:{},
                reserva: {fecha:'', id_restaurantes:'',numero_reservas:''},
                numero:14,
                editMode: false
            }
        },
        methods:{   
            add(){
                const ReservaNew = this.reserva;
                axios.post('api/reservar',ReservaNew)
                .then(response =>{
                     this.reservas = response.data
                    toastr.success('La reserva ha sido registrado con exito!');
                     this.reserva = {name: '',fecha:'',id_restaurantes:'',numero_reservas:''} 

                    $('#Reserva').modal('hide');
                    this.GetReservas();

                })
                 .catch(error => {
                   if (error.response.sataus = 400) {
                      toastr.error('Error no se puede asignar mas de 15 reservas');

                    }else{
                       toastr.error('Error');

                    }
                })

            },
            updated(id){
              this.GetReserva(id);
                const ReservaEdit = this.reserva;
                 axios.put(`api/reservar/${id}`,ReservaEdit)
                   .then(response =>{
                    this.reservas = response.data
                       this.reserva = {name: '',fecha:'',id_restaurantes:'',numero_reservas:''} 

                     $('#Reserva').modal('hide');

                      toastr.success('la  reserva  ha sido actualizada con exito!');

                  }).catch(error => {
                    if (error.response.sataus = 400) {
                      toastr.error('Error no se puede asignar mas de 15 reservas');

                    }else{
                       toastr.error('Error');

                    }
                })

            },
              deleteReserva(id){
                 if(confirm("Esta seguro de Eliminar la reserva")){
                   axios.delete(`api/reservar/${id}`)
                    .then(resp =>{
                        let i = this.reservas.map(item => item.id).indexOf(id);
                         this.reservas.splice(i, 1)
                        toastr.success('la reserva  ha sido eliminada con exito!');
                     })
                 }
            },
            GetReserva(id){
              this.editMode = true;
              this.openModalWindow();
              axios.get(`api/reservar/${id}`).then(response =>{
                 this.reserva =response.data
              })

            },
            GetRestaurante(){
                axios.get('api/restaurante')
                 .then(response =>{
                   this.restaurante = response.data
                 })
            },
            GetReservas(){
                axios.get('api/reservar')
                 .then(response =>{
                   this.reservas = response.data
                 })
            },
             openModalWindow(){
             $('#Reserva').modal('show');
             }
        },
        components: {
      datePicker
    }
        
    }
     
</script>
