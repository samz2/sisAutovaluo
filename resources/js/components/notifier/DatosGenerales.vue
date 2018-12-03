<template>
    <div class="card card-default">
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
    </div>
</template>

<script>
export default {
    props: [    
        'predio',
        'contribuyente',
        'estado_cuenta',
        'total'
    ],
    data() {
        return {
            
        }
    }
}
</script>
