<template>
    <div class="content">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header text-center">
                <h4 class="title">Lista de Usuarios</h4>  
            </div>
            <div class="card-body">    
                <div class="content table-responsive table-full-width">
                    <v-client-table :data="reporte" :columns="columns" :options="options">
                     <div slot="Acciones" slot-scope="props">
                        <button  class="btn btn-success" data-toggle="tooltip" v-on:click="editUsuario(props.row.DNI)" data-placement="left" title="Editar Usuario">
                        <i class="fa fa-edit"></i>
                        </button>
                        <router-link :to="'/verReporte/' + props.row.DNI" class="btn btn-primary" target="_blank" >
                        <i class="fa fa-file-pdf-o"></i>
                        </router-link>
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
            var:null,
            reporte: [{
                dni: null,
				nombre: null,
                direccion: null,
                celular: null,
                tipo: null
            }],
            columns: ["DNI","nombre","Direccion","Celular","tipo","Acciones"],
            options: {
				headings:
				{
					dni         : "DNI",
					nombre      : "Nombre",
					direccion   : "Direccion",
                    celular     : "Celular",
                    tipo        : "Tipo"  ,
                    Acciones    : "Acciones" 
                },
				sortable: ["DNI","nombre","Direccion","tipo"],
				filterable: ["DNI","nombre","Direccion","Celular","tipo"]
            }
        }
    },
    created()
    {
        this.getData();
    },        
	methods: {
        getData() {
            this.$Progress.start();
            axios.get('verUsuarios')
                .then(data => {
                    this.reporte = data.data.usuarios;
                    this.$Progress.finish();
					console.log(data);
                }).catch(error => {
                    this.$Progress.fail();
                    console.log('Error: ' + error);
                }); 
        },
        // verReporte(id)
        // {
            
        //     axios.get(`/verReporte/${id}`)
        //         .then(data => {
        //             this.var = data.data.id;
        //         }).catch(error => {
        //             console.log('Ocurrio un error ' + error);
        //             this.$Progress.fail();
        //         });
        // }
		
    }
}
</script>


