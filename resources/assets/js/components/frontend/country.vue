<template>
    <div class="box-container row">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                    <div class="pull-left">
                        <div class="box">
                                <h3 class="text-center">{{this.country.iso2}}</h3>
                            <p class="text-uppercase">iso2</p>
                        </div>
                        <div class="box">
                            <h3 class="text-center">{{this.country.iso3}}</h3>
                            <p class="text-uppercase">iso3</p>
                        </div>
                    </div>
                <div class="pull-left">
                    <div class="box">
                        <h3 class="text-center">{{this.country.country_code}}</h3>
                        <p class="text-uppercase">Dial code</p>
                    </div>
                    <div class="box">
                        <h3 class="text-center">{{this.country.iso3}}</h3>
                        <p class="text-uppercase">iso3</p>
                    </div>
                </div>
                <div class="pull-left">
                    <div class="box">
                        <h3 class="text-center">{{this.lat}}</h3>
                        <p class="text-uppercase">latitude</p>
                    </div>
                    <div class="box">
                        <h3 class="text-center">{{this.lng}}</h3>
                        <p class="text-uppercase">longitude</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-3">

                    <div class="input-group from-group">
                        <span class="input-group-addon">Capital</span>
                        <label class="form-control">{{this.country.capital}}</label>
                    </div>
                    <div class="input-group from-group">
                        <span class="input-group-addon">Area</span>
                        <label class="form-control">{{this.country.area}}</label>
                        <span class="input-group-addon" style="{width:20%;}"> KM<sup>2</sup></span>
                    </div>
                    <div class="input-group from-group">
                        <span class="input-group-addon">Population</span>
                        <label class="form-control">{{this.country.population}}</label>
                        <span class="input-group-addon"> Mil.</span>
                    </div>
                    <div class="input-group from-group">
                        <span class="input-group-addon">GDP</span>
                        <label class="form-control">{{this.country.gdp}}</label>
                        <span class="input-group-addon">USD</span>
                    </div>

            </div>
            <div class="col-lg-4 col-md-4">
                <div style="border:1px solid #000;">

                    <div id="mapdiv"  ></div>
                    <gmap-map
                            :center="center"
                            :zoom="7"
                            map-type-id="roadmap"
                            style="width: 100%; height: 200px"


                    >
                        <gmap-marker
                                v-for="m in markers"
                                :position="m.position"
                                :clickable="true"
                                :draggable="true"
                                @click="center=m.position"
                        ></gmap-marker>
                    </gmap-map>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <md-card>
                    <md-card-header>
                        <div class="md-title">List of Provinces</div>
                    </md-card-header>
                    <md-card-content>
                        <div class="field-group">
                            <md-input-container>
                                <label for="pagings">Pages</label>
                                <md-select name="pagings" id="pagings" v-model="perPage" >
                                    <md-option  v-for="page in [5,10,15,20,25,50,100]" :value="page" >
                                        {{page}}</md-option>
                                </md-select>
                            </md-input-container>
                            <md-input-container>
                                <label for="filter">Search</label>
                                <md-input name="filter" id="filter" v-model="filter"></md-input>
                            </md-input-container>
                        </div>





                        <b-table
                                stripped
                                hover
                                :items="province"
                                :fields="fields"
                                :current-page="currentPage"
                                :per-page="perPage"
                                :filter="filter"
                        >

                            <template slot="name" scope="item">
                                <a v-bind:href="'/'+country.country_name+'/'+item.item.name" >{{item.item.name}}</a>
                            </template>
                        </b-table>

                        <b-pagination size="md"
                                      :total-rows="this.province.length"
                                      :per-page="perPage"
                                      v-model="currentPage"
                        />

                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>

    export default{
        data()
        {
            return{
                country:{},
                province:[],
                center: {},
                lat:'',
                lng:'',
                markers: [],
                fields: {
                    name: {label: 'Province', sortable: true},
                    iso2: {label: 'ISO2', sortable: true},
                    iso3: {label: 'ISO3', sortable: true}
                },
                currentPage: 1,
                perPage: 5,
                filter: null,


            }
        },
        mounted()
        {
            // console.log(this);
        },
        created() {
          //  console.log( )); // outputs 'yay'

            var self=this;
            axios.get('/api/list-province/'+_.last( window.location.pathname.split( '/' )))
                    .then(function(response)
            {
                self.province=response.data;
            }) .catch(function(error)
                    {
                        console.log(error);
                    });

            axios.get('/api/'+_.last( window.location.pathname.split( '/' )))
                .then(function (response)
                {

                    self.country=response.data;
                    var center=new google.maps.LatLng(self.country.latitude, self.country.longitude);
                    //console.log(center);
                    self.center=center;
                    self.markers=[{position: {lat: self.country.latitude ,lng: self.country.longitude}}];
                   // self.center.lng=self.country.longitude;
                   // console.log(self.center);
                    Number.prototype.formatMoney = function(c, d, t){
                        var n = this,
                            c = isNaN(c = Math.abs(c)) ? 2 : c,
                            d = d == undefined ? "." : d,
                            t = t == undefined ? "," : t,
                            s = n < 0 ? "-" : "",
                            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
                            j = (j = i.length) > 3 ? j % 3 : 0;
                        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
                    };
                    self.country.gdp=(self.country.gdp).formatMoney(2,'.',',');
                    self.country.population=(self.country.population).formatMoney(2,'.',',');
                    self.country.area=(self.country.area).formatMoney(2,'.',',');

                    //self.markers.set(self.center);

                        var convertLat = Math.abs(self.country.latitude);
                        var LatDeg = Math.floor(convertLat);
                        var LatMin = (Math.floor((convertLat - LatDeg) * 60));
                        var LatSec = Math.round((convertLat - LatDeg - LatMin / 60) * 3600 * 1000) / 1000;
                        var LatCardinal = ((self.country.latitude > 0) ? "N" : "S");
                        self.lat=LatDeg+"°"+LatMin+"'"+LatSec.toFixed(2)+'"'+LatCardinal;
                        var convertLng = Math.abs(self.country.longitude);
                        var LngDeg = Math.floor(convertLng);
                        var LngMin = (Math.floor((convertLng - LngDeg) * 60));
                    var LngSec = Math.round((convertLng - LngDeg - LngMin / 60) * 3600 * 1000) / 1000;
                        var LngCardinal = ((self.country.longitude > 0) ? "E" : "W");
                    self.lng=LngDeg+"°"+LngMin+"'"+LngSec.toFixed(2)+'"'+LngCardinal;

                 //  console.log(response.data);
                    // console.log(response);
                    //   console.log(self.countries);
                })
                .catch(function(error)
                {
                    console.log(error);
                })
            // console.log(this.$axios);
        }
    }
  
</script>
