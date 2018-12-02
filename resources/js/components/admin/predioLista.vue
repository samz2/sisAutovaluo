<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Lista de Predios</div>

                    <div class="card-body">
                        <div class="content table-responsive table-sm col-lg-12 col-md-12">
                                <v-client-table :data="predio" :columns="columns" :options="options">
                                    <div slot="popover" slot-scope="props">
                                        <!-- <a  target="_blank" slot="Acciones" slot-scope="props" :href="props.row.Acciones" class="pe-7s-pen">ASD</a>
                                        <a  target="_blank" :href="props.row.Acciones" class="pe-7s-pen">DSA</a> -->
                                        <button class="pe-7s-look" data-toggle="tooltip" v-on:click="viewContribuyente(props.row.codPredio)" data-placement="left" title="Ver">Ver</button>
                                        <!--  -->
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
                    longitud:   null,
                    popover:null
                }
            ],
            columns: [
                'codPredio',
                'calle', 
                // 'numero',
                // 'piso',
                'mz',
                'lote',
                // 'interior',
                'sector',
                'condicion',
                'conservacion',
                'material',
                'clasificacion',
                'popover'
                // 'latitud',
                // 'longitud'
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
                    popover:'Contribuyentes'
                    // Localidad:'Localidad',
                    // Longitud:'Longitud',
                        },
                sortable: ['CodPredio', 'calle'],
                filterable: ['CodPredio', 'calle']
                    },
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
        }
    },
    mounted(){
        this.geolocate();
        this.markers[0].position = this.center;
    },
    created(){
        this.llenarTabla();
    },
    methods:{
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
        llenarTabla(){
            axios.get("getPredioList").then(data => {
                        this.predio=data.data.predio;
                        //console.log(data);
                        }
                ).catch();
        },
        viewContribuyente(id){
            axios.get(`contribuyentes/${id}`).then(data => {
                        console.log(data.data.contribuyentes[0]);
                        var string='';
                        data.data.contribuyentes.forEach(element => {
                            string+='<li><a href="#" class="text-muted"><strong>'
                            +element.dniRUC+'</strong> '+element.nombre+' '+element.apellidos+' -'
                            +element.domicilio+'</a></li>';
                        });
                        var html=`<ul class="list-unstyled text-small">${string}</ul>`;
                        swal({
                            title: 'Contribuyentes',
                            text: 'html',
                            html: html,
                            // imageUrl: 'https://unsplash.it/400/200',
                            // imageWidth: 400,
                            // imageHeight: 200,
                            // imageAlt: 'Custom image',
                            // animation: false
                    });
                        }
                ).catch();
            
        }
    }
}
</script>
