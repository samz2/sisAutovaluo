<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Materiales</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center mb-3">
                                <span v-if="!hasData" style="font-size: 20px; font-weight: bold; text-transform: uppercase">
                                    Agregar Material
                                    <button type="button" class="btn btn-success btn-sm" @click="add" v-if="!hasClicked">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                    <span v-if="hasClicked">
                                        <button type="button" class="btn btn-danger btn-sm" @click="cancel" title="Cancelar">
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                </span>
                                <span v-else style="font-size: 20px; font-weight: bold; text-transform: uppercase">
                                    Editar Material
                                    <button type="button" class="btn btn-danger btn-sm" @click="cancel"  title="Cancelar">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <form style="background-color: #dee2e6; padding: 0px 10px;" @submit.prevent="addMaterial" class="py-1 mb-4" v-if="hasClicked"
                            autocomplete="off">
                            <div class="form-group row">
                                <label for="material" class="col-md-2 mt-2" v-if="!hasData">Ingrese un material: </label>
                                <label for="material" class="col-md-2 mt-2" v-else>Edite el material: </label>
                                <div class="col-md-8 mt-2">
                                    <input type="text" name="material" id="material" placeholder="Ingrese un material" v-model="material"
                                        class="form-control material" required maxlength="15" minlength="5" 
                                        v-validate="'required|alpha_spaces|min:5|max:15'" :class="{'error': errors.has('material')}" 
                                        autofocus>
                                    <span v-if="errors.has('material')" class="errorSpan">{{ errors.first('material') }}</span>
                                </div>
                                <div class="col-md-2 mt-2 text-center">
                                    <button type="submit" class="btn btn-success" :disabled="errors.any()" v-if="!hasData">Agregar</button>
                                    <button type="button" @click="updateMaterial" class="btn btn-success" :disabled="errors.any()" v-else>
                                        Editar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <v-client-table :data="tableData" class="text-center" :columns="columns" :options="options">
                            <div slot="acciones" slot-scope="props">
                                <a @click="editMaterial(props.row.id_material, props.row.descripcion)" 
                                    style="cursor: pointer; font-size: 20px" class="mx-2" title="Editar">
                                    <i class="fa fa-pencil text-success" aria-hidden="true"></i>
                                </a>
                                <a @click="deleteMaterial(props.row.id_material)" style="cursor: pointer; font-size: 20px" class="mx-2"
                                    title="Eliminar">
                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                </a>
                            </div>
                        </v-client-table>
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
            columns: ["id_material", "descripcion", "acciones"],
            tableData: [{ id_material: null, descripcion: null }],
            options: {
                headings: {
                    id_material: "ID",
                    descripcion: "Descripcion",
                    acciones: "Acciones"
                },
                sortable: ["id_material", "descripcion"],
                filterable: ["id_material", "descripcion"]
            },
            hasClicked: false,
            hasData: false,
            material: null,
            id: null
        };
    },
    mounted() {
        this.getMaterial();
    },
    methods: {
        getMaterial() {
            this.$Progress.start();
            axios.get('/material')
                .then(data => {
                    this.tableData = data.data.material;
                    this.$Progress.finish();
                })
                .catch(error => {
                    this.$Progress.fail();
                    console.log(error);
                });
        },
        add() {
            this.hasClicked = true;
            $('input#material').focus();
        },
        cancel() {
            this.hasData = false; 
            this.hasClicked = false;
            this.material = null;
            this.id = null;
            $('#material').focus();
        },
        editMaterial(id, nombre) {
            this.hasClicked = true;
            this.hasData = true;
            this.material = nombre;
            this.id = id;
            $('#material').focus();
        },
        updateMaterial() {
            this.$validator.validateAll().then(res => {
                if (res) {
                    axios.put(`material/${this.id}`, {
                        material: this.material
                    }).then(data => {
                        if (data.data == 'bien') {
                            swal({
                                type: 'success',
                                title: 'Buen trabajo!',
                                text: 'Dato actualizado correctamente!',
                                timer: 2000
                            });
                        } else {
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'No se pudo actualizar correctamente!',
                                timer: 2000
                            });   
                        }
                        setTimeout(() => {
                            this.cancel()
                            this.getMaterial();
                        }, 2500);
                    }).catch(error => {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Error externo, no se pudo actualizar correctamente!',
                            timer: 2000
                        });
                        setTimeout(() => {
                            this.cancel();
                            this.getMaterial();
                        }, 2500);
                    });
                } else {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Ocurrió un error!',
                        timer: 2000
                    });
                }
            });
        },
        addMaterial() {
            this.$validator.validateAll().then(res => {
                if (res) {
                    axios.post('/material', {
                        material: this.material
                    }).then(data => {
                        if (data.data == 'bien') {
                            swal({
                                type: 'success',
                                title: 'Buen trabajo!',
                                text: 'Dato agregado correctamente!',
                                timer: 2000
                            });
                        } else {
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'No se pudo agregar correctamente!',
                                timer: 2000
                            });
                        }
                        setTimeout(() => {
                            this.cancel();
                            this.getMaterial();
                        }, 2500);
                    }).catch(error => {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Error externo, no se pudo agregar correctamente!',
                            timer: 2000
                        });
                        setTimeout(() => {
                            this.cancel();
                            this.getMaterial();
                        }, 2500);
                        console.log(error);
                    });
                } else {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Ocurrió un error!',
                        timer: 2000
                    });
                }
            });
        },
        deleteMaterial(id) {
            swal({
                title: 'Está seguro?',
                text: "No podrá revertir los cambios!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value) {
                    axios.delete(`material/${id}`)
                        .then(data => {
                            if (data.data == 'bien') {
                                swal({
                                    type: 'success',
                                    title: 'Buen trabajo!',
                                    text: 'Dato eliminado correctamente!',
                                    timer: 2000
                                });
                            } else {
                                swal({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'No se pudo eliminar correctamente!',
                                    timer: 2000
                                });
                            }
                            setTimeout(() => {
                                this.cancel();
                                this.getMaterial();
                            }, 2500);
                        }).catch(error => {
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Error externo, no se pudo agregar correctamente!',
                                timer: 2000
                            });
                            setTimeout(() => {
                                this.cancel();
                                this.getMaterial();
                            }, 2500);
                        });
                }
            })
        }
    }
};
</script>

<style scoped>
.error {
    border-color: #dc3545;
}
.errorSpan {
    color: #dc3545;
}
input:focus {
    box-shadow: none;
}
</style>