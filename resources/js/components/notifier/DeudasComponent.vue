<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Componente de Notificador</div>
                    <div class="card-body" v-if="center.lat && center.lng">
                        <gmap-map ref="gmap" :center="center" :zoom="14" style="width:100%;  height: 100vh;">
                            <gmap-marker :key="index" v-for="(m, index) in markers" :position="m.position"
                                @click="toggleInfoWindow(m,index)">
                            </gmap-marker>
                            <gmap-info-window :options="infoOptions" :position="infoWindowPos"  
                                :opened="infoWinOpen" @closeclick="infoWinOpen=false" >
                                <div v-html="infoContent"></div>
                            </gmap-info-window>
                        </gmap-map>
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
            // center: { lat: -8.3953133, lng: -74.5533306 },
            center: { lat: 0.0, lng: 0.0 },
            map: null,
            infoContent: '',
            infoWindowPos: {
                lat: 0,
                lng: 0
            },
            infoWinOpen: false,
            currentMidx: null,
            //optional: offset infowindow so it visually sits nicely on top of our marker
            infoOptions: {
            pixelOffset: {
                    width: 0,
                    height: -35
                }
            },
            markers: []
        }
    },
    created() { 
        this.getEstado();
    },
    mounted() {
        //set bounds of the map
        // this.$refs.gmap.$mapPromise.then((map) => {
        //     const bounds = new google.maps.LatLngBounds()
        //     for (let m of this.markers) {
        //         bounds.extend(m.position)
        //     }
        //     map.fitBounds(bounds);
        // });
    },
    methods: {
        getEstado() {
            axios.get('obtener-estado')
                .then(data => {
                    var datosSalvajes = data.data.predioSalvaje.map((e, i) => {
                        return {
                            calle: e.Calle,
                            cantidad_contribuyentes: e.Cantidad_Contribuyente,
                            codigo_contribuyentes: e.Codigo_Contribuyente,
                            codigo_predio: e.Codigo_Predio,
                            position: {
                                lat: parseFloat(e.Latitud),
                                lng: parseFloat(e.Longitud)
                            },
                            nombre_completo: e.Nombres_Apellidos,
                            total: e.suma
                        }
                    });
                    
                    this.markers = datosSalvajes;
                    this.center = {
                        lat: parseFloat(data.data.predioSalvaje[0].Latitud),
                        lng: parseFloat(data.data.predioSalvaje[0].Longitud)
                    }
                }).catch(error => {
                    console.log(error);
                });
        },
        toggleInfoWindow: function (marker, idx) {
            this.infoWindowPos = marker.position;
            this.infoContent = this.getInfoWindowContent(marker);
            
            //check if its the same marker that was selected if yes toggle
            if (this.currentMidx == idx) {
                this.infoWinOpen = !this.infoWinOpen;
            }
            //if different marker set infowindow to open and reset current marker index
            else {
                this.infoWinOpen = true;
                this.currentMidx = idx;
            }
        },
        getInfoWindowContent: function (marker) {
            var estado = '';
            if (marker.total > 0) {
                estado = '<i class="fa fa-circle" style="color: red" aria-hidden="true"></i> Deuda Pendiente';
            } else {
                estado = '<i class="fa fa-circle" style="color: green" aria-hidden="true"></i> Sin deuda';
            }
            return (`
                <div class="card">
                    <div class="card-header">
                        <p class=""><b>${'Código de Predio'.toUpperCase()}:</b> ${marker.codigo_predio}</p>
                    </div>
                    <div class="card-body">
                        <p><b>Calle:</b> ${marker.calle}</p>
                        <p><b>Cantidad de Contribuyentes:</b> ${marker.cantidad_contribuyentes}</p>
                        <p><b>Estado:</b> ${estado}</p>
                        <p><b>Cantidad Deuda:</b> ${marker.total}</p>
                    </div>
                </div>`
            );
        },
    }
}
</script>
