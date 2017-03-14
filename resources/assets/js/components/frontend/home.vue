<template>
  <div class="box-container row">
      <div class="col-sm-3">
          <div class="card-container  manual-flip">
              <div class="card">
                  <div class="front">

                      <div class="content">
                          <div class="main">
                              <div class="fresh-table">
                                  <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
                                          Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
                                  -->

                                  <div class="toolbar">

                                  </div>

                                  <table id="fresh-table" class="table">
                                      <thead>
                                      <tr>
                                          <th data-field="iso2">ID</th>
                                          <th data-field="country_name" data-sortable="true">Country</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr v-for="country in countries">
                                          <td>{{country.iso2}}</td>
                                          <td>{{country.country_name}}</td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="footer">
                              <button class="btn btn-simple" onclick="rotateCard(this)">
                                  <i class="fa fa-mail-forward"></i> Manual Rotation
                              </button>

                          </div>
                      </div>
                  </div> <!-- end front panel -->
                  <div class="back">
                      <div class="header">
                          <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                      </div>
                      <div class="content">
                          <div class="main">
                              <h4 class="text-center">Job Description</h4>
                              <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                              <div class="stats-container">
                                  <div class="stats">
                                      <h4>235</h4>
                                      <p>
                                          Followers
                                      </p>
                                  </div>
                                  <div class="stats">
                                      <h4>114</h4>
                                      <p>
                                          Following
                                      </p>
                                  </div>
                                  <div class="stats">
                                      <h4>35</h4>
                                      <p>
                                          Projects
                                      </p>
                                  </div>
                              </div>

                          </div>
                      </div>
                      <div class="footer">
                          <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                              <i class="fa fa-reply"></i> Back
                          </button>

                      </div>
                  </div> <!-- end back panel -->
              </div> <!-- end card -->
          </div> <!-- end card-container -->

      </div>
<div class="col-sm-9">

    <!--<div class="col-md-4 col-sm-6">-->


    <!--</div>-->
      <!--<div class="col-md-8 col-sm-8">-->
          <!--&lt;!&ndash;<gmap-map&ndash;&gt;-->
                  <!--&lt;!&ndash;:center="{lat:0 ,lng:0}"&ndash;&gt;-->
                  <!--&lt;!&ndash;:zoom="1"&ndash;&gt;-->
                  <!--&lt;!&ndash;map-type-id="terrain"&ndash;&gt;-->
                  <!--&lt;!&ndash;style="width: 100%; height: 500px"&ndash;&gt;-->
                  <!--&lt;!&ndash;scrollwheel: false&ndash;&gt;-->

          <!--&lt;!&ndash;&gt;&ndash;&gt;-->

          <!--&lt;!&ndash;</gmap-map>&ndash;&gt;-->


</div>
      <!--</div>-->
  </div>
</template>

<script>
    export default{
        data()
        {
            return{
                countries:[],
                fields: {
                    country_name: {label: 'Country', sortable: true},
                    iso2: {label: 'ISO2', sortable: true},
                    iso3: {label: 'ISO3', sortable: true}
                },
                currentPage: 1,
                perPage: 5,
                filter: null
            }
        },
        mounted()
        {
            function rotateCard(btn){
                var $card = $(btn).closest('.card-container');
                console.log($card);
                if($card.hasClass('hover')){
                    $card.removeClass('hover');
                } else {
                    $card.addClass('hover');
                }
            }
        },

        created() {

            var self=this;
            axios.get('/api/list-countries-min')
                .then(function (response)
                {
                    self.countries=response.data;
                    $().ready(function() {



                        var $table = $('#fresh-table'),
                            $alertBtn = $('#alertBtn'),
                            full_screen = false;
                        $table.bootstrapTable({
                            toolbar: ".toolbar",

                            showRefresh: false,
                            search: true,
                            showToggle: false,
                            showColumns: false,
                            pagination: true,
                            striped: true,
                            pageSize: 5,
                            pageList: [5, 10, 25, 50, 100],
                            formatShowingRows: function(pageFrom, pageTo, totalRows){
                                //do nothing here, we don't want to show the text "showing x of y from..."
                            },
                            formatRecordsPerPage: function(pageNumber){
                                return pageNumber + " rows visible";
                            },
                            icons: {
                                refresh: 'fa fa-refresh',
                                toggle: 'fa fa-th-list',
                                columns: 'fa fa-columns',
                                detailOpen: 'fa fa-plus-circle',
                                detailClose: 'fa fa-minus-circle'
                            }
                        });

                        $(window).resize(function () {
                            $('#fresh-table').bootstrapTable('resetView');
                        });


                        window.operateEvents = {
                            'click .like': function (e, value, row, index) {
                                alert('You click like icon, row: ' + JSON.stringify(row));
                                console.log(value, row, index);
                            },
                            'click .edit': function (e, value, row, index) {
                                alert('You click edit icon, row: ' + JSON.stringify(row));
                                console.log(value, row, index);
                            },
                            'click .remove': function (e, value, row, index) {
                                $('#fresh-table').bootstrapTable('remove', {
                                    field: 'iso2',
                                    values: [row.iso2]
                                });

                            }
                        };

                        $('#alertBtn').click(function () {
                            console.log('test');
                            alert("You pressed on Alert");
                        });

                        function operateFormatter(value, row, index) {
                            return [
                                '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                                '<i class="fa fa-heart"></i>',
                                '</a>',
                                '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                                '<i class="fa fa-edit"></i>',
                                '</a>',
                                '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                                '<i class="fa fa-remove"></i>',
                                '</a>'
                            ].join('');
                        }

                    });

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

//    var $table = $('#fresh-table'),
//        $alertBtn = $('#alertBtn'),
//        full_screen = false;
//
//    $().ready(function(){
//        $table.bootstrapTable({
//            toolbar: ".toolbar",
//
//            showRefresh: true,
//            search: true,
//            showToggle: true,
//            showColumns: true,
//            pagination: true,
//            striped: true,
//            pageSize: 8,
//            pageList: [8,10,25,50,100],
//
//            formatShowingRows: function(pageFrom, pageTo, totalRows){
//                //do nothing here, we don't want to show the text "showing x of y from..."
//            },
//            formatRecordsPerPage: function(pageNumber){
//                return pageNumber + " rows visible";
//            },
//            icons: {
//                refresh: 'fa fa-refresh',
//                toggle: 'fa fa-th-list',
//                columns: 'fa fa-columns',
//                detailOpen: 'fa fa-plus-circle',
//                detailClose: 'fa fa-minus-circle'
//            }
//        });
//
//
//
//        $(window).resize(function () {
//            $table.bootstrapTable('resetView');
//        });
//
//
//        window.operateEvents = {
//            'click .like': function (e, value, row, index) {
//                alert('You click like icon, row: ' + JSON.stringify(row));
//                console.log(value, row, index);
//            },
//            'click .edit': function (e, value, row, index) {
//                alert('You click edit icon, row: ' + JSON.stringify(row));
//                console.log(value, row, index);
//            },
//            'click .remove': function (e, value, row, index) {
//                $table.bootstrapTable('remove', {
//                    field: 'id',
//                    values: [row.id]
//                });
//
//            }
//        };
//
//        $alertBtn.click(function () {
//            alert("You pressed on Alert");
//        });
//
//    });
//
//
//    function operateFormatter(value, row, index) {
//        return [
//            '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
//            '<i class="fa fa-heart"></i>',
//            '</a>',
//            '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
//            '<i class="fa fa-edit"></i>',
//            '</a>',
//            '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
//            '<i class="fa fa-remove"></i>',
//            '</a>'
//        ].join('');
//    }


</script>
