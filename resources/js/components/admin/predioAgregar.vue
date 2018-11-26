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
                  <form @submit.prevent="agregarPredio">
                    <!-- text input -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Codigo Predio</label>
                            <input type="codigo" class="form-control" placeholder="Codigo de Predio" v-model="predio.codPredio" required>
                            </div>
                        </div>
                    
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                            <label>Calle</label>
                            <input type="Calle" class="form-control" placeholder="Calle" v-model="predio.calle" required>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>Numero</label>
                            <input type="Numero" class="form-control" placeholder="Numero" v-model="predio.numero" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Manzana</label>
                            <input type="Manzana" class="form-control" placeholder="Manzana" v-model="predio.mz" >
                            </div>
                        </div>
                    
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Lote</label>
                            <input type="Lote" class="form-control" placeholder="Lote" v-model="predio.lote">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Interior</label>
                            <input type="Interior" class="form-control" placeholder="Interior" v-model="predio.interior">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                            <label>Sector</label>
                            <input type="Sector" class="form-control" placeholder="Sector" v-model="predio.sector">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>Material</label>
                            <select class="form-control" name="material" id="material" v-model="predio.material" required>
                                <option v-for="m in material" :value="m.id_material" :key="m.id_material" >{{m.descripcion}}</option>
                            </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>Condicion Propiedad</label>
                            <select class="form-control" v-model="predio.condicion" required>
                                <option v-for="c in condicion" :value="c.id_condicion" :key="c.id_condicion">{{c.descripcion}}</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>conservacion</label>
                            <select class="form-control" v-model="predio.conservacion" required>
                                <option v-for="co in conservacion" :value="co.id_conservacion" :key="co.id_conservacion">{{co.descripcion}}</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                            <label>clasificación</label>
                            <select class="form-control" v-model="predio.clasificacion" required>
                                <option v-for="cl in clasificacion" :value="cl.id_clasificacion" :key="cl.id_clasificacion">{{cl.descripcion}}</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                            <label>Localidad</label>
                            <select class="form-control" v-model="predio.localidad" required>
                                <option v-for="l in localidad" :value="l.id_localidad" :key="l.id_localidad">{{l.descripcion}}</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <h3>Contribuyente</h3>
                            <div class="form-group">
                                <div class="input-group">
                                <input class="form-control" type="text" placeholder="Contribuyentes" aria-label="Text input with segmented dropdown button">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary" @click="buscarContribuyente()">Buscar</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">   
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Ubicación</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Latitud</span>
                                                </div>
                                                <input type="text" aria-label="First name" class="form-control" v-model="predio.latitud" readonly>
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Altitud</span>
                                                </div>
                                                <input type="text" aria-label="Last name" class="form-control" v-model="predio.longitud " readonly>
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
                        <div class="col-lg-10 col-md-10">
                            <div class="form-group">
                                <input type="submit" :disabled="errors.any()" class="form-control btn btn-primary pull-left">
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
  data() {
    return {
      predio: {
        codPredio: null,
        calle: null,
        numero: null,
        piso: null,
        mz: null,
        lote: null,
        interior: null,
        sector: null,
        condicion: null,
        conservacion: null,
        material: null,
        clasificacion: null,
        localidad: null,
        latitud: null,
        longitud: null
      },
      material: [],
      condicion: [],
      conservacion: [],
      clasificacion: [],
      localidad: [],
      center: { lat: 0, lng: 0 },
      markers: [
        {
          name: "Posicionar en ubicación",
          position: { lat: null, lng: null }
        }
      ],
      map: null,
      infoContent: "",
      infoWindowPos: { lat: 0, lng: 0 },
      infoWinOpen: false,
      currentMidx: null,
      //optional: offset infowindow so it visually sits nicely on top of our marker
      infoOptions: { pixelOffset: { width: 0, height: -35 } }
    };
  },
  mounted() {
    //set bounds of the map
    this.geolocate();
    this.markers[0].position = this.center;
    this.getDatosSelect();
  },
  created() {},
  methods: {
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        this.markers[0].position = this.center;
        this.predio.latitud = this.center.lat;
        this.predio.longitud = this.center.lng;
      });
    },
    getDatosSelect() {
      axios
        .get("datosSelect")
        .then(data => {
          this.material = data.data.material;
          this.condicion = data.data.condicion;
          this.conservacion = data.data.conservacion;
          this.clasificacion = data.data.clasificacion;
          this.localidad = data.data.localidad;
          console.log(data);
        })
        .catch(error => {
          console.log("Ocurrio un error " + error);
          this.$Progress.fail();
        });
    },
    updateCoordinates(location) {
      console.log("imprimiendo desde update");
      this.coordinates = {
        lat: location.latLng.lat(),
        lng: location.latLng.lng()
      };
      this.markers[0].position = this.coordinates;
      this.predio.latitud = this.coordinates.lat;
      this.predio.longitud = this.coordinates.lng;
    },
    toggleInfoWindow: function(marker, idx) {
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
    getInfoWindowContent: function(marker) {
      return `${marker.name}`;
    },
    agregarPredio() {
      // this.$validator.validateAll().then(res => {
      //     if (res) {
      axios
        .post(`predio`, {
          graduadoIn: this.graduadoIn,
          entidadAdd: this.entidadAdd
        })
        .then(data => {
          if (data.data == "ambos correcto") {
            swal({
              position: "top-end",
              type: "success",
              title: "Datos ingresados correctamente",
              showConfirmButton: false,
              timer: 2000
            });
            setTimeout(() => {
              location.reload();
            }, 2500);
          } else {
            swal({
              position: "top-end",
              type: "error",
              title: "No se pudo actualizar",
              showConfirmButton: false,
              timer: 2000
            });
          }
        })
        .catch(error => {
          swal({
            position: "top-end",
            type: "error",
            title: "Sucedió un error, comuníquese con el Administrador",
            showConfirmButton: false,
            timer: 2000
          });
          console.log(`Error: ${error}`);
        });
      // } else {
      //     swal({
      //         position: 'top-end',
      //         type: 'error',
      //         title: 'Por favor corrija los errores',
      //         showConfirmButton: false,
      //         timer: 2000
      //     });
      // }
      // });
    },
    buscarContribuyente(){
        swal({
                title: 'Busca contribuyente',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Look up',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return fetch(`//api.github.com/users/${login}`)
                    .then(response => {
                        if (!response.ok) {
                        throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
                }).then((result) => {
                if (result.value) {
                    swal({
                    title: `${result.value.login}'s avatar`,
                    imageUrl: result.value.avatar_url
                    })
                }
                });
    },

  }
};
</script>
