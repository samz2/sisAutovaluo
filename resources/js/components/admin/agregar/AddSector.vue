<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Sectores</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center mb-3">
                                <span v-if="!hasData" style="font-size: 20px; font-weight: bold; text-transform: uppercase">
                                    Agregar Sector
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
                                    Editar Sector
                                    <button type="button" class="btn btn-danger btn-sm" @click="cancel"  title="Cancelar">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <form style="background-color: #dee2e6; padding: 0px 10px;" @submit.prevent="addSector" class="py-1 mb-4" 
                            v-if="hasClicked" autocomplete="off">
                            <div class="form-group row">
                                <label for="sector" class="col-md-2 mt-2" v-if="!hasData">Ingrese un sector: </label>
                                <label for="sector" class="col-md-2 mt-2" v-else>Edite el sector: </label>
                                <div class="col-md-8 mt-2">
                                    <input type="text" name="sector" id="sector" placeholder="Ingrese un sector" v-model="sector"
                                        class="form-control sector" required maxlength="15" minlength="5" 
                                        v-validate="'required|min:5|max:15'" :class="{'error': errors.has('sector')}" 
                                        autofocus>
                                    <span v-if="errors.has('sector')" class="errorSpan">{{ errors.first('sector') }}</span>
                                </div>
                                <div class="col-md-2 mt-2 text-center">
                                    <button type="submit" class="btn btn-success" :disabled="errors.any()" v-if="!hasData">Agregar</button>
                                    <button type="button" @click="updateSector" class="btn btn-success" :disabled="errors.any()" v-else>
                                        Editar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <v-client-table :data="tableData" class="text-center" :columns="columns" :options="options">
                            <div slot="acciones" slot-scope="props">
                                <a @click="editSector(props.row.id_sector, props.row.descripcion)" 
                                    style="cursor: pointer; font-size: 20px" class="mx-2" title="Editar">
                                    <i class="fa fa-pencil text-success" aria-hidden="true"></i>
                                </a>
                                <a @click="deleteSector(props.row.id_sector)" style="cursor: pointer; font-size: 20px" class="mx-2"
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
            columns: ["id_sector", "descripcion", "acciones"],
            tableData: [{ id_sector: null, descripcion: null }],
            options: {
                headings: {
                    id_sector: "ID",
                    descripcion: "Descripcion",
                    acciones: "Acciones"
                },
                sortable: ["id_sector", "descripcion"],
                filterable: ["id_sector", "descripcion"]
            },
            hasClicked: false,
            hasData: false,
            sector: null,
            id: null
        }
    },
    created() {
        this.getSector();
    },
    methods: {
        add() {
            this.hasClicked = true;
            $('input#sector').focus();
        },
        cancel() {
            this.hasData = false; 
            this.hasClicked = false;
            this.sector = null;
            this.id = null;
            $('#sector').focus();
        },
        editSector(id, nombre) {
            this.hasClicked = true;
            this.hasData = true;
            this.sector = nombre;
            this.id = id;
            $('#sector').focus();
        },
        getSector() {
            this.$Progress.start();
            axios.get('sector')
                .then(data => {
                    this.tableData = data.data.sector;
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
                    console.log(error);
                });
        },
        addSector() {
            this.$validator.validateAll().then(res => {
                if (res) {
                    axios.post('sector', {
                        sector: this.sector
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
                            this.getSector();
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
                            this.getSector();
                        }, 2500);
                    })
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
        updateSector() {
            this.$validator.validateAll().then(res => {
                if (res) {
                    axios.put(`/sector/${this.id}`, {
                        sector: this.sector
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
                            this.getSector();
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
                            this.getSector();
                        }, 2500);
                    })
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
        deleteSector(id) {
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
                    axios.delete(`sector/${id}`)
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
                                this.getSector();
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
                                this.getSector();
                            }, 2500);
                        });
                }
            });
        }
    }
}
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