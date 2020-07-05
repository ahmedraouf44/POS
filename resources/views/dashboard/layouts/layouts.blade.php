<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E3lan Misr  - @yield('title')</title>

    <!-- ======================= CSS ===================== -->

    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/style_updates.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Bootstrap Min CSS -->
    <!-- Fonts and icons -->
    @yield('customizedStyle')





</head>







<body class="hold-transition skin-blue sidebar-mini">
<div id="app">
    <main>
        <div class="wrapper">
            @include('dashboard.layouts.header')
            @include('dashboard.layouts.sideMenu')
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('dashboard.layouts.footer')
        </div>
    </main>
</div>






{{--<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>--}}
<!-- JS
============================================ -->

<!-- jQuery 3 -->
<script src="{{asset('dashboard/AdminLte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('dashboard/AdminLte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('dashboard/AdminLte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('dashboard/AdminLte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/AdminLte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('dashboard/AdminLte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('dashboard/AdminLte/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('dashboard/AdminLte/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('dashboard/AdminLte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('dashboard/AdminLte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('dashboard/AdminLte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('dashboard/AdminLte/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('dashboard/AdminLte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('dashboard/AdminLte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('dashboard/AdminLte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('dashboard/AdminLte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('dashboard/AdminLte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('dashboard/AdminLte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dashboard/AdminLte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dashboard/AdminLte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE/ for demo purposes -->
<script src="{{asset('dashboard/AdminLte/dist/js/demo.js')}}"></script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

<!-- GoogleMap purposes -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.4/jstree.min.js"></script>
<!--<script src="{{url('dashboard')}}/GoogleMap/map.js"></script>-->
<script >
    function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 30.0595581,
            lng: 31.2233591
        },
        zoom: 7,
        mapTypeId: 'roadmap'
    });

    var input = document.getElementById('searchMapInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();

        /* If the place has a geometry, then present it on a map. */
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);


        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);


        /* Location details */
        $('#lat').val(marker.getPosition().lat());
        $('#lng').val(marker.getPosition().lng());

        document.getElementById('location-snap').innerHTML = place.formatted_address;
        document.getElementById('lat').innerHTML = place.geometry.location.lat();
        document.getElementById('lng').innerHTML = place.geometry.location.lng();
    });

    // Create the search box and link it to the UI element.
    var marker = new google.maps.Marker({
        position: {
            lat: 30.0595581,
            lng: 31.2233591
        },
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP
    });

    google.maps.event.addListener(map, 'click', function(event) {
        if (marker) {
            marker.setMap(null);
            var myLatLng = event.latLng;
        }
        marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
        });
            var geocoder;

            // 

            var reverseGeocoder = new google.maps.Geocoder();
            var currentPosition = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());
        
            reverseGeocoder.geocode({'latLng': currentPosition}, function(results, status) {
                console.log(results[0].formatted_address ,'7777777777777');
                $('#searchMapInput').val(results[0].formatted_address);

    
            });
    
        // console.log(event.latLng);
        $('#lat').val(marker.getPosition().lat());
        $('#lng').val(marker.getPosition().lng());
        console.log(marker.getPosition().lat());
        console.log(marker.getPosition().lng());
    })

    google.maps.event.addListener(map, 'zoom_changed', function() {
        $('#zoom').val(map.getZoom())
    });

}
    
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ67H5QBLVTdO2pnmEmC2THDx95rWyC1g&libraries=places&callback=initAutocomplete" async defer></script>

<!-- End GoogleMap -->

@yield('customizedScript')

</body>
</html>
