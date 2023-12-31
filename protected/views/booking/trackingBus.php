<style>
    /* Stil peta */
    #map {
        height: 600px;
        width: 100%;
    }
</style>

<div class="row mt-20">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'pembelian-tiket-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.,
            'method'=>'get',
            'enableAjaxValidation'=>false,
        )); 
        ?>

      <div class="row d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
              <?= CHtml::dropDownList('TrackingBus[trip_id]', "", Armada::object()->getTrip(), 
              ['class' => 'form-control','prompt'=>'Pilih Trip','required'=>true]); ?>
        </div>
      </div>
      <div class="row d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-warning pull-right" id="cari">Cari</button>
        </div>
      </div>

        <?php $this->endWidget(); ?>
    </div>
</div>

    <!-- Peta akan ditampilkan di div dengan id "map" -->
    <div id="map"></div>
    <!-- <button class="btn btn-warning" onclick="getLatLong()"><i class="fa fa-refresh"></i> Muat Ulang Rute</button> -->

<script>
var latitude = -6.2080;
var longitude = 106.8450;
var trip_id = "";

var gadgetLocations = [
    { name: 'E 363', lat: -7.649314, lng: 109.610703 },
    { name: 'E 396', lat: -7.402754, lng: 109.859601 },
];

document.addEventListener("DOMContentLoaded", function() {
    $('#TrackingBus_trip_id').select2();
});

$('#cari').on('click', function(){
    getLatLong();
})

function getLatLong()
{
    trip_id = $('#TrackingBus_trip_id').val();
    if (trip_id === "undefined" || trip_id === "") {
        Swal.fire({
                html: `Silahkan pilih Trip terlebih dahulu`,
                icon: 'error',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: 'OK'
            });
        return false;
    }
    $('#loaderWaitingRoutes').removeClass('none');
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                latitude = position.coords.latitude;
                longitude = position.coords.longitude;
                getCrewLocations()
            },
            function(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        console.log("Izin akses lokasi ditolak oleh pengguna.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        console.log("Informasi lokasi tidak tersedia.");
                        break;
                    case error.TIMEOUT:
                        console.log("Permintaan waktu untuk akses lokasi habis.");
                        break;
                    case error.UNKNOWN_ERROR:
                        console.log("Terjadi kesalahan yang tidak diketahui.");
                        break;
                }
            }
        );
    } else {
        console.log("Geolocation tidak didukung oleh browser Anda.");
    }
}

function getCrewLocations() {
    $.ajax({
        type : "GET",
        url : "<?= Constant::baseUrl() . '/booking/getCrewLocations?trip_id=' ?>"+trip_id,
        dataType : "JSON",
        success : function(data) {
            if (data.success) {
                $('#map').css('height', '600');
                console.log(data);
                gadgetLocations = data.data;
                initializeMap();
            } else {
                console.log(data);
                var message = typeof data.message !== "undefined" ? data.message : 'Data gagal konfirmasi';
                Swal.fire({
                    html: message,
                    icon: 'error',
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                });
                $('#map').css('height', '100');
                $('#map').html(message);
            }
            $('#loaderWaitingRoutes').addClass('none');
        },
        error : function(data){
            if (typeof(data.responseText) !== "undefined")
                console.log(data.responseText);
        }
    });
}

function initializeMap() {
    // Buat peta dengan lokasi awal
    var mapOptions = {
        center: new google.maps.LatLng(latitude, longitude), // Lokasi tengah peta (gadget pertama)
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // Buat objek layanan arah
    var directionsService = new google.maps.DirectionsService();
    // Tambahkan marker dan rute untuk setiap gadget
    for (var i = 0; i < gadgetLocations.length; i++) {
        var gadget = gadgetLocations[i];

        // Buat marker dengan label gadget
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(gadget.lat, gadget.lng),
            map: map,
            label: {
                text: gadget.name,
                fontSize: '14px', // Ukuran teks label
                fontWeight: 'bold', // Ketebalan teks label
                color: 'blue', // Warna teks label
                zIndex: 99
            }
        });

        // Tambahkan event listener untuk menampilkan rute ketika marker diklik
        // marker.addListener('click', function() {
            calculateAndDisplayRoute(map, gadget);
        // });
    }
}

function calculateAndDisplayRoute(map, gadget) {
    // Tentukan titik awal, misalnya, titik awal adalah koordinat Anda sendiri
    var origin = new google.maps.LatLng(latitude, longitude);

    // Buat objek permintaan arah
    var request = {
        origin: origin,
        destination: new google.maps.LatLng(gadget.lat, gadget.lng),
        travelMode: google.maps.TravelMode.DRIVING
    };

    // Kirim permintaan arah
    var directionsService = new google.maps.DirectionsService();
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            $('#loaderWaitingRoutes').addClass('none');
            // Tampilkan rute pada peta
            var directionsDisplay = new google.maps.DirectionsRenderer();
            directionsDisplay.setMap(map);
            directionsDisplay.setDirections(response);
        } else {
            Swal.fire({
                html: `Tidak dapat menampilkan rute: ${status}`,
                icon: 'error',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: 'OK'
            });
        }
    });
}

// Panggil fungsi initializeMap() setelah peta dimuat
// google.maps.event.addDomListener(window, 'load', initializeMap);
</script>

<!-- Sertakan pustaka Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBpPsPOC-5hhLQWHDHCOQq0bs5SaQkrTo" async defer></script>