<template>
    <div class="container">
        <div class="row" v-show="tabla">
            <div class="col-md-12">
                <div class="card">
                    <div class="header pt-4">
                        <div class="container-fluid">
                            <div class="row">
                                    <div class="col align-self-center offset-lg-4">
                                         <h3>Localidades</h3>
                                    </div>
                                    <div class="col align-self-end ">
                                        <button class="btn btn-primary ml-3" @click="tabla=false;agregar=true;">Agregar</button>
                                        <!-- <router-link to="/foo" tag="button">foo</router-link> -->
                                    </div>
                        </div>
                        </div>
                    </div>
                    <div class="well">
                        <div class="container">
                            <div class="row">
                                
                                    <div class="content table-responsive table-full-width"> 
                                    <div class="col col-lg-12 col-md-12">                          
                                    <v-client-table :data="localidad" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                        <!-- <a  target="_blank" slot="Acciones" slot-scope="props" :href="props.row.Acciones" class="pe-7s-pen">ASD</a>
                                        <a  target="_blank" :href="props.row.Acciones" class="pe-7s-pen">DSA</a> -->
                                        <button class="btn btn-info" data-toggle="tooltip" v-on:click="viewEditarLocalidad(props.row.id_localidad,props.row.descripcion)" data-placement="left" title="Editar Sector"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger" data-toggle="tooltip" v-on:click="eliminarLocalidad(props.row.id_localidad)" data-placement="left" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                    </v-client-table>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-show="agregar">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="content">
                       <div class="header mt-3">
	                    <center><h3 class="title">Agregar Nuevo</h3></center>
                        <hr>
	                    </div>
	                    <form @submit.prevent="agregarLocalidad" class="ml-2 mr-2 mb-2">
	                        <div class="row ml-2">
                                <div class="col-md-5">
	                                <div class="form-group">
	                                    <label for="ndescripcion">Descripcion</label>
	                                    <input type="text" class="form-control" id="descripcion" name="descripcion" v-model="localidadForm.descripcion" required>
	                                </div>
	                            </div>
	                        </div>
	                        <input type="submit" :disabled="errors.any()" class="btn btn-info btn-fill pull-right">
                            <button type="button" class="btn btn-primary btn-fill pull-left" @click="submitted = false" v-on:click="agregar=false;tabla=true;">Cancelar</button>
	                        <div class="clearfix"></div>
	                    </form>
                        
	                </div>
	            </div>
	         </div>
	    	</div>

        <div class="row" v-show="editar">
			 <div class="col-md-12">
	            <div class="card">
	                <div class="content">
                       <div class="header mt-3">
	                    <center><h3 class="title">Editar Localidad</h3></center>
                        <hr>
	                    </div>
	                    <form @submit.prevent="editarLocalidad" class="ml-2 mr-2 mb-3">
	                        <div class="row">
                                <div class="col-md-10">
	                                <div class="form-group ml-2">
	                                    <label for="ndescripcion">Descripcion</label>
	                                    <input type="text" class="form-control" id="descripcion" name="descripcion" v-model="localidadEdit.descripcion" required>
	                                </div>
	                            </div>
	                        </div>
	                        <input type="submit" :disabled="errors.any()" class="btn btn-info btn-fill pull-right">
                            <button type="button" class="btn btn-primary btn-fill pull-left" @click="submitted = false" v-on:click="editar=false;tabla=true;">Cancelar</button>
	                        <div class="clearfix"></div>
	                    </form>
                        
	                </div>
	            </div>
	         </div>
	    	</div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            localidad: [
                {
                    id_localidad:null,
                    descripcion:null
                }
            ],
            localidadForm:{
                id_localidad:null,
                descripcion:null
            },
            localidadEdit:{
                id_conservacion:null,
                descripcion:null
            },
            columns: ['id_localidad','descripcion','Acciones'],
            options: {
                headings: {
                    id_localidad:'ID',
                    descripcion:'Descripcion',
                    Acciones:'Acciones'
                        },
                sortable: ['id_localidad','descripcion'],
                filterable: ['id_localidad','descripcion']
                    },
            tabla:true,
            agregar:false,
            editar:false
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('getLocalidad')
                .then(data => {
                   this.localidad=data.data.datos;
                   console.log(data);
                   this.localidad.forEach((element,i) => {
                       this.localidad[i].id_localidad=this.localidad[i].id_localidad;
                   });
                //    console.log(data);
                }).catch(error => console.log('Ocurrio un error ' + error)); 
        },
        agregarLocalidad(){
            axios.post(`agregarOrUpdateLocalidad`, {
                        localidadForm:this.localidadForm
                    }).then(data => {
                        if (data.data == 'OK') {
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos ingresados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'No se pudo agregar',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }).catch(error => {
                        swal({
                            position: 'top-end',
                            type: 'error',
                            title: 'Sucedió un error, comuníquese con el Administrador',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        console.log(`Error: ${error}`);
                    });
        },
        eliminarLocalidad(id){
            swal({
                title: 'Deseas eliminar este campo?',
                text: "No será posible revertir esta acción!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, elíminalo!',
                cancelButtonText: 'No, cancelar!',
            }).then((result) => {
                if (result.value) {
                    axios.get(`/eliminarLocalidad/${id}`)
                        .then(data => {
                        if(data.data=="OK"){
                            swal(
                            'Eliminado!',
                             'El sector ha sido eliminado.',
                             'success'
                                );
                            setTimeout(() => {
                                // location.reload();
                                
                                this.getData();
                            }, 1500);
                        }
                        }).catch(error => {
                            console.log('Ocurrio un error ' + error);
                            this.$Progress.fail();
                        });
                     }
                });
        },
        viewEditarLocalidad(id,des){
            this.editar=true;
            this.tabla=false;
            this.localidadEdit.descripcion=des;
            this.localidadEdit.id_localidad=id;
        },
        editarLocalidad(){
            axios.post(`agregarOrUpdateLocalidad`, {
                        localidadForm:this.localidadEdit
                    }).then(data => {
                        if (data.data == 'OK') {
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Datos actualizados correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'No se pudo actualizar',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            console.log(data);
                        }
                    }).catch(error => {
                        swal({
                            position: 'top-end',
                            type: 'error',
                            title: 'Sucedió un error, comuníquese con el Administrador',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        console.log(`Error: ${error}`);
                    });
        }
    }
}
</script>