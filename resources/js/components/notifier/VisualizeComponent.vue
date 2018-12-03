<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Componente de Visualizacion</div>
                    <div class="card-body">
                        <v-client-table :data="tableData" :columns="columns" class="text-center" :options="options">
                            <div slot="Acciones" slot-scope="props">
                                <a style="color: blue; cursor: pointer" @click="getUser(props.row.codigo_predio)" title="Ver más">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </div>
                        </v-client-table>
                    </div>
                </div>
                <!-- <div class="card card-default" v-if="hasData">
                    <div class="card-header">Datos Generales</div>
                    <div class="card-body">
                        <h2 class="text-center">DATOS GENERALES</h2>
                        <form class="mt-4">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="calle">Código de Predio:</label>
                                    <p v-text="predio.codPredio"></p>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="calle">Calle: </label>
                                    <p v-text="predio.calle"></p>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="calle">Número: </label>
                                    <p v-text="predio.numero"></p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">Datos del Contribuyente</label>
                                </div>
                            </div>
                            <div class="form-row mb-2" style="border-width: 4px; border-left-style: solid; border-color: #6c757d!important; 
                                background-color: #f5f5f5" v-for="(c, index) in contribuyente" :key="index">
                                    <p class="col-md-3"><b>Código Contribuyente</b>: {{ c.codigo_contribuyente }}</p>
                                    <p class="col-md-6"><b>Nombres Completos</b>: {{ c.nombre }} {{ c.apellidos }}</p>
                                    <p class="col-md-3"><b>DNI Contribuyente</b>: {{ c.dni }}</p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="piso">Piso: </label>
                                    <p v-text="predio.piso"></p>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="manzana">Manzana: </label>
                                    <p v-text="predio.manzana"></p>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="lote">Lote: </label>
                                    <p v-text="predio.lote"></p>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="interior">Interior: </label>
                                    <p v-text="predio.interior"></p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="sector">Sector: </label>
                                    <p v-text="predio.sector"></p>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="condicion_propiedad">Condición de Propiedad: </label>
                                    <p v-text="predio.condicion"></p>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="conservacion_propiedad">Conservacion de Propiedad: </label>
                                    <p v-text="predio.conservacion"></p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="material">Material: </label>
                                    <p v-text="predio.material"></p>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="clasificacion">Clasificacion: </label>
                                    <p v-text="predio.clasificacion"></p>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="localidad">Localidad: </label>
                                    <p v-text="predio.localidad"></p>
                                </div>
                            </div>
                        </form>
                        <h2 class="text-center">ESTADO DE CUENTA</h2>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Periodo</th>
                                    <th>Formato</th>
                                    <th>Impuesto Predial</th>
                                    <th>Limpieza Pública</th>
                                    <th>Barrido Calles</th>
                                    <th>Parques y Jardines</th>
                                    <th>Serenazgo</th>
                                    <th>SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(e, index) in estado_cuenta" :key="index">
                                    <td>{{ e.periodo }}</td>
                                    <td>{{ e.formato }}</td>
                                    <td>{{ e.impuesto_predial }}</td>
                                    <td>{{ e.limpieza_publica }}</td>
                                    <td>{{ e.barrido_calles }}</td>
                                    <td>{{ e.parques_jardines }}</td>
                                    <td>{{ e.serenazgo }}</td>
                                    <td>{{ e.sub_total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="text-right"><b>TOTAL</b></td>
                                    <td>{{ total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
                <div v-if="hasData">
                    <datos-generales :hasData="hasData" :predio="predio" :contribuyente="contribuyente" :estado_cuenta="estado_cuenta"
                        :total="total">
                    </datos-generales>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            columns: ['codigo_predio', 'calle', 'cant_contribuyentes', 'estado', 'deuda', 'Acciones'],
            tableData: [
                { codigo_predio: null, calle: null, cant_contribuyentes: null, estado: null, deuda: null }
            ],
            options: {
                headings: {
                    codigo_predio: 'Codigo Predio',
                    calle: 'Dirección',
                    cant_contribuyentes: 'Contribuyentes',
                    estado: 'Estado',
                    deuda: 'Deuda',
                    Acciones: 'Acciones'
                },
                sortable: ['calle', 'codigo_predio'],
                filterable: ['calle', 'codigo_predio']
            },
            estado_cuenta: [],
            contribuyente: [],
            hasData: false,
            predio: {}, 
            total: 0.0,
            title: 'Hola Mundo'
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('obtener-estado')
                .then(data => {
                    const datos = data.data.predioSalvaje.map((e, i) => {
                        const deuda = (e.suma > 0) ? `${e.suma}` : `${e.suma}`;
                        const state = (e.suma > 0) ? `Con deuda` : `Sin deuda`;

                        return {
                            codigo_predio: e.Codigo_Predio,
                            calle: e.Calle,
                            cant_contribuyentes: e.Cantidad_Contribuyente,
                            estado: state,
                            deuda: deuda
                        }
                    });

                    this.tableData = datos;
                    this.$Progress.finish();
                }).catch(error => {
                    this.$Progress.fail();
                    console.log(error);
                });
        },
        getUser(id) {
            this.hasData = true;
            axios.get(`/obtener-personal/${id}`)
                .then(data => {
                    var total = 0.0;
                    this.estado_cuenta = data.data.estado_cuenta.map(e => {
                        const subtotal = parseFloat(e.barrido_calles) + parseFloat(e.formato) + parseFloat(e.impuesto_predial) + 
                                    parseFloat(e.limpieza_publica) + parseFloat(e.parques_jardines) + parseFloat(e.serenazgo);
                        total += subtotal;

                        return {
                            barrido_calles: parseFloat(e.barrido_calles),
                            formato: parseFloat(e.formato),
                            impuesto_predial: parseFloat(e.impuesto_predial),
                            id_predio: parseFloat(e.id_predio),
                            limpieza_publica: parseFloat(e.limpieza_publica),
                            parques_jardines: parseFloat(e.parques_jardines),
                            periodo: parseFloat(e.periodo),
                            serenazgo: parseFloat(e.serenazgo),
                            sub_total: subtotal.toFixed(2)
                        };
                    });
                    this.total = parseFloat(total).toFixed(2);

                    this.predio = {
                        calle: data.data.predio.calle,
                        clasificacion: data.data.predio.clasificacion ? data.data.predio.clasificacion : 'Sin datos',
                        codPredio: data.data.predio.codPredio,
                        condicion: data.data.predio.condicion ? data.data.predio.condicion : 'Sin datos',
                        conservacion: data.data.predio.conservacion ? data.data.predio.conservacion : 'Sin datos',
                        interior: data.data.predio.interior ? data.data.predio.interior : 'Sin datos',
                        localidad: data.data.predio.localidad ? data.data.predio.localidad : 'Sin datos',
                        lote: data.data.predio.lote ? data.data.predio.lote : 'Sin datos',
                        material: data.data.predio.material ? data.data.predio.material : 'Sin datos',
                        manzana: data.data.predio.mz ? (data.data.predio.mz).toUpperCase() : 'Sin datos',
                        numero: data.data.predio.numero ? data.data.predio.numero : 'Sin datos',
                        piso: data.data.predio.piso ? data.data.predio.piso : 'Sin datos',
                        sector: data.data.predio.sector ? data.data.predio.sector : 'Sin datos'
                    };

                    var contribuyente = data.data.contribuyentes.map(e => {
                        return {
                            codigo_predio: e.codPredio,
                            codigo_contribuyente: e.codContribuyente,
                            nombre: e.nombre,
                            apellidos: e.apellidos,
                            dni: e.dniRUC
                        }
                    });

                    this.contribuyente = contribuyente;
                }).catch(error => {
                    console.log(error);
                })
        }
    },
}
</script>
