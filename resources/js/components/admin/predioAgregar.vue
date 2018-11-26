<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Agregar Predio</div>

                    <div class="card-body">
                        <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos Generales</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form">
                    <!-- text input -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Codigo Predio</label>
                            <input type="codigo" class="form-control" placeholder="Codigo de Predio">
                            </div>
                        </div>
                    
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                            <label>Calle</label>
                            <input type="Calle" class="form-control" placeholder="Calle" >
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>Numero</label>
                            <input type="Numero" class="form-control" placeholder="Numero" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Manzana</label>
                            <input type="Manzana" class="form-control" placeholder="Manzana">
                            </div>
                        </div>
                    
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Lote</label>
                            <input type="Lote" class="form-control" placeholder="Lote" >
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Interior</label>
                            <input type="Interior" class="form-control" placeholder="Interior" >
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Sector</label>
                            <input type="Sector" class="form-control" placeholder="Sector">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>Material</label>
                            <select class="form-control" name="material" id="material" required>
                                <option v-for="m in material" :value="m.descripcion" :key="m.id" >{{m.descripcion}}</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>Condicion Propiedad</label>
                            <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>conservacion</label>
                            <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                    
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>clasificación</label>
                            <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>Localidad</label>
                            <input type="Localidad" class="form-control" placeholder="Localidad">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                                            
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Ubicación</label>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Latitud</span>
                                                </div>
                                                <input type="text" aria-label="First name" class="form-control" v-model="markers[0].position.lat" readonly>
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Altitud</span>
                                                </div>
                                                <input type="text" aria-label="Last name" class="form-control" v-model="markers[0].position.lng" readonly>
                                            </div>
                                            <gmap-map ref="gmap" :center="center" :zoom="16" style="width:100%;  height: 100vh;">
                            <gmap-marker :key="index" v-for="(m, index) in markers" 
                            :position="m.position"
                            :draggable="true"
                            @drag="updateCoordinates"
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

                  </form>
                </div><!-- /.box-body -->
              </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
     name: "GoogleMap",
    data(){
        return{
            predio:{
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
            },
            material:[],
            center: { lat: 0, lng: 0 },
            markers: [ {
                    name: "Posicionar en ubicación",
                    position: { lat: null, lng: null }
                    } ],
            map: null,
            infoContent: '',
            infoWindowPos: { lat: 0, lng: 0 },
            infoWinOpen: false,
            currentMidx: null,
            //optional: offset infowindow so it visually sits nicely on top of our marker
            infoOptions: { pixelOffset: { width: 0, height: -35 } },
        }
    },
    mounted() {
        //set bounds of the map
         this.geolocate();
         this.markers[0].position=this.center;
    },
    created(){
        this.getPais();
    },
    methods:{
    
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        this.markers[0].position=this.center;
      });
    },
    getPais()
            {
            axios.get('datosMaterial')
                .then(data => {
                    this.pais = data.data.pais;
                    this.departamento = data.data.departamento;
                    this.estado_civil = data.data.estado_civil;
                    this.discapacidad = data.data.discapacidad;
                    this.facultad = data.data.facultad;
                    this.escuela = data.data.escuela;
                    this.$Progress.finish();
                }).catch(error => {
                    console.log('Ocurrio un error ' + error);
                    this.$Progress.fail();
                }); 
        },
    updateCoordinates(location) {
        console.log("imprimiendo desde update");
            this.coordinates = {
                lat: location.latLng.lat(),
                lng: location.latLng.lng(),
            };
            this.markers[0].position=this.coordinates;
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
            return (`
                ${marker.name}`
            );
        },
    }
}
</script>
