<template>
    <div class="container">
        <div class="row" v-show="tabla">
            <div class="col-md-12">
                <div class="card">
                    <div class="header pt-4">
                        <div class="container-fluid">
                            <div class="row">
                                    <div class="col align-self-center offset-lg-4">
                                         <h3>Conservación Predio</h3>
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
                                    <v-client-table :data="conservacion" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                        <!-- <a  target="_blank" slot="Acciones" slot-scope="props" :href="props.row.Acciones" class="pe-7s-pen">ASD</a>
                                        <a  target="_blank" :href="props.row.Acciones" class="pe-7s-pen">DSA</a> -->
                                        <button class="btn btn-info" data-toggle="tooltip" v-on:click="viewEditarConservacion(props.row.id_conservacion,props.row.descripcion)" data-placement="left" title="Editar Sector"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger" data-toggle="tooltip" v-on:click="eliminarConservacion(props.row.id_conservacion)" data-placement="left" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
	                    <form @submit.prevent="agregarConservacion" class="ml-2 mr-2 mb-2">
	                        <div class="row ml-2">
                                <div class="col-md-5">
	                                <div class="form-group">
	                                    <label for="ndescripcion">Descripcion</label>
	                                    <input type="text" class="form-control" id="descripcion" name="descripcion" v-model="conservacionForm.descripcion" required>
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
	                    <center><h3 class="title">Editar Conservacion</h3></center>
                        <hr>
	                    </div>
	                    <form @submit.prevent="editarConservacion" class="ml-2 mr-2 mb-3">
	                        <div class="row">
                                <div class="col-md-10">
	                                <div class="form-group ml-2">
	                                    <label for="ndescripcion">Descripcion</label>
	                                    <input type="text" class="form-control" id="descripcion" name="descripcion" v-model="conservacionEdit.descripcion" required>
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
            conservacion: [
                {
                    id_conservacion:null,
                    descripcion:null
                }
            ],
            conservacionForm:{
                id_conservacion:null,
                descripcion:null
            },
            conservacionEdit:{
                id_conservacion:null,
                descripcion:null
            },
            columns: ['id_conservacion','descripcion','Acciones'],
            options: {
                headings: {
                    id_conservacion:'ID',
                    descripcion:'Descripcion',
                    Acciones:'Acciones'
                        },
                sortable: ['id_conservacion','descripcion'],
                filterable: ['id_conservacion','descripcion']
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
            axios.get('getConservacion')
                .then(data => {
                   this.conservacion=data.data.datos;
                   console.log(data);
                   this.conservacion.forEach((element,i) => {
                       this.conservacion[i].id_conservacion=this.conservacion[i].id_conservacion;
                   });
                //    console.log(data);
                }).catch(error => console.log('Ocurrio un error ' + error)); 
        },
        agregarConservacion(){
            axios.post(`agregarOrUpdateConservacion`, {
                        conservacionForm:this.conservacionForm
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
        eliminarConservacion(id){
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
                    axios.get(`/eliminarConservacion/${id}`)
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
        viewEditarConservacion(id,des){
            this.editar=true;
            this.tabla=false;
            this.conservacionEdit.descripcion=des;
            this.conservacionEdit.id_conservacion=id;
        },
        editarConservacion(){
            axios.post(`agregarOrUpdateConservacion`, {
                        conservacionForm:this.conservacionEdit
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