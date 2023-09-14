<style>
     body, html {
        margin: 0;
        padding: 0;
        height: 100vh;
    }

    #content {
        display: block;
        height: 100%;
        position: absolute;
        left: 0;
    }
    .container {
        height: 100vh;
        padding: 0;
    }

    #qr-video-container {
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #000;
    }

    #qr-video {
        width: auto;
        height: 100%;
        max-width: 100%;
        max-height: 100%;
        transform-origin: center; /* Pusat rotasi video */
            /* transform: rotate(90deg); */
    }

    /* Area Fokus */
   /*  .qr-focus-box {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 2px solid #101010;
        box-sizing: border-box;
        background: rgb(7 7 7 / 80%);
        -webkit-clip-path: polygon(0% 0%, 0% 100%, 25% 100%, 25% 25%, 75% 25%, 75% 75%, 25% 75%, 25% 100%, 100% 100%, 100% 0%);
        clip-path: polygon(0% 0%, 0% 100%, 25% 100%, 25% 25%, 75% 25%, 75% 75%, 25% 75%, 25% 100%, 100% 100%, 100% 0%);
    } */

    #qr-result {
        position: absolute;
        bottom: 10px;
        left: 10px;
        color: #fff;
    }
</style>
<div id="qr-video-container">
        <video id="qr-video" playsinline></video>
        <!-- Area Fokus -->
        <div class="qr-focus-box"></div>

        <div class="container-button-float">
            <div class="row-0">
                <div class="button-float" style="font-size: 2rem;">
                <button type="button" class="btn btn-warning switch-camera" onclick="switchingCamera()"><i class="fa fa-refresh"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div id="qr-result"></div>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
    var latitude = null;
    var longitude = null;
    document.addEventListener("DOMContentLoaded", function() {
        getLatLong();
    });
    
    function getLatLong()
    {
        if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        latitude = position.coords.latitude;
                        longitude = position.coords.longitude;
                        /* alert('latitude: ' + latitude + ', longitude: ' + longitude);
                        return false; */
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

const videoElement = document.getElementById('qr-video');
const qrResultElement = document.getElementById('qr-result');


let opts = {
                // Whether to scan continuously for QR codes. If false, use scanner.scan() to manually scan.
                // If true, the scanner emits the "scan" event when a QR code is scanned. Default true.
                continuous: true,
                // The HTML element to use for the camera's video preview. Must be a <video> element.
                // When the camera is active, this element will have the "active" CSS class, otherwise,
                // it will have the "inactive" class. By default, an invisible element will be created to
                // host the video.
                video: videoElement,
                // Whether to horizontally mirror the video preview. This is helpful when trying to
                // scan a QR code with a user-facing camera. Default true.
                mirror: false,
                // Whether to include the scanned image data as part of the scan result. See the "scan" event
                // for image format details. Default false.
                captureImage: false,
                // Only applies to continuous mode. Whether to actively scan when the tab is not active.
                // When false, this reduces CPU usage when the tab is not active. Default true.
                backgroundScan: true,
                // Only applies to continuous mode. The period, in milliseconds, before the same QR code
                // will be recognized in succession. Default 5000 (5 seconds).
                refractoryPeriod: 5000,
                // Only applies to continuous mode. The period, in rendered frames, between scans. A lower scan period
                // increases CPU usage but makes scan response faster. Default 1 (i.e. analyze every frame).
                scanPeriod: 1
            };

const scanner = new Instascan.Scanner(opts);
// Mengaktifkan kamera dan memulai scanning QR code
Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]); // Gunakan kamera pertama yang ditemukan
    } else {
        console.error('Kamera tidak ditemukan.');
    }
}).catch(function (error) {
    console.error('Error: ', error);
});

// Event saat QR code terdeteksi
scanner.addListener('scan', function (content) {
    doExecScannerResult(content);
});

function doExecScannerResult(value) {
    $.ajax({
        url: "<?= Constant::baseUrl().'/booking/scannerResult' ?>",
        type: 'POST',
        data: {id:value,latitude:latitude,longitude:longitude},
        dataType: 'JSON',
        success: function(data) {
            if (data.success && typeof data.data !== "undefined") {
                location.href = "<?= Constant::baseUrl() . '/home/qrResult?data=' ?>"+btoa(JSON.stringify(data.data));
            } else {
                var message = (typeof data.message !== "undefined") ? data.message : JSON.stringify(data);
                swal.fire(message, '', 'error');
            }
        }
    });
}

var existing = true;
function switchingCamera() {
    Instascan.Camera.getCameras().then(cameras => 
    {
        if (!existing) {
            if(cameras.length > 1) {
                scanner.stop(cameras[1]);
            }
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            }
            existing = true;
        } else {
            if(cameras.length > 1) {
                scanner.start(cameras[1]);
            }
            if(cameras.length > 0){
                scanner.stop(cameras[0]);
            }
            existing = false;
        }
        console.log(existing);
    });
}
    </script>
