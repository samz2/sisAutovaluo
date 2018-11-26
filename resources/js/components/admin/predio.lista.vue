<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Lista de Predios</div>

                    <div class="card-body">
                        <div class="content table-responsive table-full-width">
                                <v-client-table :data="predio" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                        <!-- <a  target="_blank" slot="Acciones" slot-scope="props" :href="props.row.Acciones" class="pe-7s-pen">ASD</a>
                                        <a  target="_blank" :href="props.row.Acciones" class="pe-7s-pen">DSA</a> -->
                                        <button class="pe-7s-pen" data-toggle="tooltip" v-on:click="editGraduado(props.row.DNI)" data-placement="left" title="Editar Graduado"></button>
                                        <button class="pe-7s-look" data-toggle="tooltip" v-on:click="viewGraduado(props.row.DNI)" data-placement="left" title="Ver Hoja de Vida"></button>
                                    </div>
                                </v-client-table>
                        </div>
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
            predio:[
                {
                    codPredio:  null,
                    calle:      null,
                    numero:     null,
                    piso:       null,
                    mz:         null,
                    lote:       null,
                    interior:   null,
                    sector:     null,
                    condicion:  null,
                    conservacion:null,
                    material:   null,
                    clasificacion:null,
                    localidad:  null,
                    latitud:    null,
                    longitud:   null
                }
            ],
            columns: [
                'CodPredio',
                'Calle', 
                'Numero',
                'Piso',
                'Mz',
                'Lote',
                'Interior',
                'Sector',
                'Condicion',
                'Conservacion',
                'Material',
                'Clasificacion',
                'Localidad',
                'Longitud'
                ],
            options: {
                headings: {
                    CodPredio: 'Cod',
                    Calle: 'Calle',
                    Numero: 'Numero',
                    Piso:'Piso',
                    Mz:'Mz',
                    Lote:'Lote',
                    Interior:'Interior',
                    Sector:'Sector',
                    Condicion:'Condicion',
                    Conservacion:'Conservacion',
                    Material:'Material',
                    Clasificacion:'Clasificacion',
                    Localidad:'Localidad',
                    Longitud:'Longitud',
                        },
                sortable: ['Cod', 'Calle','Numero','Piso'],
                filterable: ['Cod', 'Calle','Numero','Piso']
                    }
        }
    },
    created(){
        this.llenarTabla();
    },
    methods:{
        llenarTabla(){
            axios.get("getPredioList").then(data => {
                        this.predio=data.data.predio;
                        console.log(data);
                        }
                ).catch();
        }
    }
}
</script>
