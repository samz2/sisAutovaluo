<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Componente de Visualizacion</div>
                    <div class="card-body">
                        <v-client-table :data="tableData" :columns="columns" :options="options">
                            <div slot="Acciones" slot-scope="props">
                                <button @click="getUser(props.row.id)">Editar</button>
                                <button>Eliminar</button>
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
            columns: ['id', 'name', 'age', 'Acciones'],
            tableData: [
                { id: 1, name: 'John', age: 20 },
                { id: 2, name: "Jane", age: "24" },
                { id: 3, name: "Susan", age: "16" },
                { id: 4, name: "Chris", age: "55" },
                { id: 5, name: "Dan", age: "40" }
            ],
            options: {
                headings: {
                    id: 'ID',
                    name: 'Nombre',
                    age: 'Edad',
                    Acciones: 'Acciones'
                },
                sortable: ['name', 'age'],
                filterable: ['name', 'age']
            }
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        getData() {
            return [{
                code: "ZW",
                name: "Zimbabwe",
                created_at: "2015-04-24T01:46:50.459583",
                updated_at: "2015-04-24T01:46:50.459593",
                uri: "http://api.lobbyfacts.eu/api/1/country/245",
                id: 245
            }, {
                code: "ZM",
                name: "Zambia",
                created_at: "2015-04-24T01:46:50.457459",
                updated_at: "2015-04-24T01:46:50.457468",
                uri: "http://api.lobbyfacts.eu/api/1/country/244",
                id: 244
            }];
        },
        getUser(id) {
            console.log(id);
        }
    },
}
</script>
