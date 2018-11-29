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
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form @submit.prevent="agregarPredio">
                  <!-- text input -->
                  <div class="row">
                    <div class="col-lg-3 col-md-3">
                      <div class="form-group">
                        <label>Codigo Predio</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Codigo de Predio"
                          v-model="predio.codPredio"
                          required
                          maxlength="10"
                        >
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <div class="form-group">
                        <label>Calle</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Calle"
                          v-model="predio.calle"
                          required
                        >
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <div class="form-group">
                        <label>Numero</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Numero"
                          v-model="predio.numero"
                          maxlength="6"
                        >
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                      <div class="form-group">
                        <label>Piso</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Piso"
                          v-model="predio.piso"
                          required
                        >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-3">
                      <div class="form-group">
                        <label>Manzana</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Manzana"
                          v-model="predio.mz"
                          maxlength="1"
                          
                        >
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <div class="form-group">
                        <label>Lote</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Lote"
                          v-model="predio.lote"
                          maxlength="5"
                        >
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <div class="form-group">
                        <label>Interior</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Interior"
                          v-model="predio.interior"
                          maxlength="3"
                        >
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                      <div class="form-group">
                        <label>Sector</label>
                        <select
                          class="form-control"
                          name="material"
                          id="material"
                          v-model="predio.sector"
                          required
                        >
                          <option
                            v-for="sc in sector"
                            :value="sc.id_sector"
                            :key="sc.id_sector"
                          >{{sc.descripcion}}</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4">
                      <div class="form-group">
                        <label>Material</label>
                        <select
                          class="form-control"
                          name="material"
                          id="material"
                          v-model="predio.material"
                          required
                        >
                          <option
                            v-for="m in material"
                            :value="m.id_material"
                            :key="m.id_material"
                          >{{m.descripcion}}</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                      <div class="form-group">
                        <label>Condicion Propiedad</label>
                        <select class="form-control" v-model="predio.condicion" required>
                          <option
                            v-for="c in condicion"
                            :value="c.id_condicion"
                            :key="c.id_condicion"
                          >{{c.descripcion}}</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                      <div class="form-group">
                        <label>conservacion</label>
                        <select class="form-control" v-model="predio.conservacion" required>
                          <option
                            v-for="co in conservacion"
                            :value="co.id_conservacion"
                            :key="co.id_conservacion"
                          >{{co.descripcion}}</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-4">
                      <div class="form-group">
                        <label>clasificación</label>
                        <select class="form-control" v-model="predio.clasificacion" required>
                          <option
                            v-for="cl in clasificacion"
                            :value="cl.id_clasificacion"
                            :key="cl.id_clasificacion"
                          >{{cl.descripcion}}</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-8 col-md-8">
                      <div class="form-group">
                        <label>Localidad</label>
                        <select class="form-control" v-model="predio.localidad" required>
                          <option
                            v-for="l in localidad"
                            :value="l.id_localidad"
                            :key="l.id_localidad"
                          >{{l.descripcion}}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-10 col-md-10">
                      <h3>Contribuyente
                        <small>(Buscar por DNI)</small>
                      </h3>
                      <div class="form-group">
                      </div>
                    </div>
                  </div>
                  <div v-for="(row, index) in rows" :key="index">
                    <div class="row">
                      <div class="col-lg-8 col-md-8">
                        <div class="form-group">
                          <tags-input
                            element-id="tags"
                            placeholder="Agregar contribuyente"
                            input-class="form-control"
                            :limit="1"
                            :only-existing-tags="true"
                            v-model="selectedTags[index]"
                            :existing-tags="lista"
                            :typeahead="true"
                          ></tags-input>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-2">
                        <a
                          class="btn btn-info"
                          v-on:click="removeElement(index);"
                          style="cursor: pointer"
                        >
                          <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for>Valor Predio</label>
                          <input class="form-control" type="text" v-model="row.valor">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for>Año</label>
                          <input class="form-control" type="text" v-model="row.anio" maxlength="">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for>Porcentaje de Propiedad</label>
                          <input class="form-control" type="text" v-model="row.percent" maxlength="3">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-md-4">
                      <div class="form-group">
                        <button
                          type="button"
                          class="button btn-primary form-control"
                          @click="addRow"
                        >Agregar Contribuyente</button>
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
                            <input
                              type="text"
                              aria-label="First name"
                              class="form-control"
                              v-model="predio.latitud"
                              readonly
                            >
                            <div class="input-group-prepend">
                              <span class="input-group-text">Altitud</span>
                            </div>
                            <input
                              type="text"
                              aria-label="Last name"
                              class="form-control"
                              v-model="predio.longitud "
                              readonly
                            >
                          </div>
                          <gmap-map
                            ref="gmap"
                            :center="center"
                            :zoom="16"
                            style="width:100%;  height: 100vh;"
                          >
                            <gmap-marker
                              :key="index"
                              v-for="(m, index) in markers"
                              :position="m.position"
                              :draggable="true"
                              @drag="updateCoordinates"
                              @click="toggleInfoWindow(m,index)"
                            ></gmap-marker>
                            <gmap-info-window
                              :options="infoOptions"
                              :position="infoWindowPos"
                              :opened="infoWinOpen"
                              @closeclick="infoWinOpen=false"
                            >
                              <div v-html="infoContent"></div>
                            </gmap-info-window>
                          </gmap-map>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-10 col-md-10">
                      <div class="form-group">
                        <input
                          type="submit"
                          :disabled="errors.any()"
                          class="form-control btn btn-primary pull-left"
                        >
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.box-body -->
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
        longitud: null,
      },
      buscar: null,
      selectedTags: [],
      lista: {
        // 1: 'Web Development',
        // 2: 'PHP',
        // 3: 'JavaScript',
        // 4:'Java',
      },
      listaAd: [],
      // ALTERNATIVELY
      // selectedTags: null,
      material: [],
      condicion: [],
      sector: [],
      conservacion: [],
      clasificacion: [],
      localidad: [],
      rows: [],
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
    $("input[placeholder='Agregar contribuyente']").keyup(function(
      a = this.getContribuyente()
    ) {
      return this.value;
    });
  },
  created() {},
  methods: {
    addRow: function() {
      var elem = document.createElement("tr");
      this.rows.push({
        valor: "",
        anio: "",
        percent: ""
        // file: {
        //     name: 'Choose File'
        // }
      });
    },
    removeElement: function(index) {
      this.rows.splice(index, 1);
    },
    setFilename: function(event, row) {
      var file = event.target.files[0];
      row.file = file;
    },
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
    setSelectedTags() {
      this.selectedTags = ["programmatically", "selected", "tags"];
      // ALTERNATIVELY
      this.selectedTags = "programmatically,selected,tags";
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
          this.sector = data.data.sector;
        })
        .catch(error => {
          console.log("Ocurrio un error " + error);
          this.$Progress.fail();
        });
    },
    getContribuyente(e) {
      axios
        .get(`/getContribuyente/${e}`)
        .then(data => {
          let datos = data.data.contribuyente;
          datos.forEach((e, i) => {
            this.lista[e.dniRUC] = `${e.nombres}-${e.dniRUC}`;
          });
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
          predio: this.predio,
          contribuyentes: this.selectedTags,
          rows: this.rows
        })
        .then(data => {
          if (data.data == "OK") {
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
              title: "No se pudo Ingresar datos",
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
    buscarContribuyente() {
      swal({
        title: "Busca contribuyente",
        input: "text",
        inputAttributes: {
          autocapitalize: "off"
        },
        showCancelButton: true,
        confirmButtonText: "Look up",
        showLoaderOnConfirm: true,
        preConfirm: login => {
          return fetch(`//api.github.com/users/${login}`)
            .then(response => {
              if (!response.ok) {
                throw new Error(response.statusText);
              }
              return response.json();
            })
            .catch(error => {
              swal.showValidationMessage(`Request failed: ${error}`);
            });
        },
        allowOutsideClick: () => !swal.isLoading()
      }).then(result => {
        if (result.value) {
          swal({
            title: `${result.value.login}'s avatar`,
            imageUrl: result.value.avatar_url
          });
        }
      });
    }
  }
};
</script>
<style>
/* The input */
.tags-input {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.tags-input input {
  flex: 1;
  background: transparent;
  border: none;
}

.tags-input input:focus {
  outline: none;
}

.tags-input input[type="text"] {
  color: #495057;
}

.tags-input-wrapper-default {
  padding: 0.5rem 0.25rem;

  background: #fff;

  border: 1px solid transparent;
  border-radius: 0.25rem;
  border-color: #dbdbdb;
}

/* The tag badges & the remove icon */
.tags-input span {
  margin-right: 0.3rem;
}

.tags-input-remove {
  cursor: pointer;
  position: relative;
  display: inline-block;
  width: 0.5rem;
  height: 0.5rem;
  overflow: hidden;
}

.tags-input-remove:before,
.tags-input-remove:after {
  content: "";
  position: absolute;
  width: 100%;
  top: 50%;
  left: 0;
  background: #5dc282;

  height: 2px;
  margin-top: -1px;
}

.tags-input-remove:before {
  transform: rotate(45deg);
}
.tags-input-remove:after {
  transform: rotate(-45deg);
}

/* Tag badge styles */
.tags-input-badge {
  display: inline-block;
  padding: 0.25em 0.4em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem;
}

.tags-input-badge-pill {
  padding-right: 0.6em;
  padding-left: 0.6em;
  border-radius: 10rem;
}

.tags-input-badge-selected-default {
  color: #212529;
  background-color: #f0f1f2;
}

/* Typeahead - badges */
.typeahead-badges > span {
  cursor: pointer;
  margin-right: 0.3rem;
}

/* Typeahead - dropdown */
.typeahead-dropdown {
  list-style-type: none;
  padding: 0;
  margin: 0;
  position: absolute;
  width: 100%;
}

.typeahead-dropdown li {
  padding: 0.25rem 1rem;
  cursor: pointer;
}

/* Typeahead elements style/theme */
.tags-input-typeahead-item-default {
  color: #fff;
  background-color: #343a40;
}

.tags-input-typeahead-item-highlighted-default {
  color: #fff;
  background-color: #007bff;
}
</style> 