<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Componente de Administrador</div>

                    <div class="card-body">
                        <h1>asd</h1>
                        <!-- <GmapMap style="width: 600px; height: 400px;" :zoom="16" :center="center"
                            ref="map">
                            <GmapMarker v-for="(marker, index) in markers" :key="index" :position="marker.latLng"/>
                        </GmapMap> -->
                        <gmap-map ref="gmap" :center="center" :zoom="12" style="width:100%;  height: 100vh;">
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
            center: { lat: -8.362015113641032, lng: -74.57030276914249 },
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
            markers: [
                {
                    name: "Casa de Antony",
                    description: "descripcion 1",
                    position: { lat: -8.362034144896839, lng: -74.57029082816086 }
                },
                {
                    name: "Casa de John",
                    description: "descripcion 2",
                    position: { lat: -8.392125575238598, lng: -74.55437721388037 }
                }
            ],
        }
    },
    mounted() {
        //set bounds of the map
        this.$refs.gmap.$mapPromise.then((map) => {
            const bounds = new google.maps.LatLngBounds()
            for (let m of this.markers) {
                bounds.extend(m.position)
            }
            map.fitBounds(bounds);
        });
    },
    methods: {
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
            return (`
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-4">${marker.name}</p>
                            </div>
                        </div>
                        <div class="content">
                            ${marker.description}
                        </div>
                    </div>
                </div>`
            );
        },
    }
}
</script>
