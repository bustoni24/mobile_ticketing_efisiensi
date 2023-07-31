<style>
#preview {
  width: 300px;
  height: 300px;
  outline: 1px solid red;
}
.scanner-container{
    display:flex;
    width:100%;
    justify-content:center;
    align-items:center;
}
</style>
<script type="text/javascript" src="<?= Constant::assetsUrl().'/js/instascan3.min.js' ?>"></script>

<div class="scanner-container">
    <video id="preview"></video>
</div>

<script>
let opts = {
                // Whether to scan continuously for QR codes. If false, use scanner.scan() to manually scan.
                // If true, the scanner emits the "scan" event when a QR code is scanned. Default true.
                continuous: true,
                // The HTML element to use for the camera's video preview. Must be a <video> element.
                // When the camera is active, this element will have the "active" CSS class, otherwise,
                // it will have the "inactive" class. By default, an invisible element will be created to
                // host the video.
                video: document.getElementById('preview'),
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
    let scanner = new Instascan.Scanner(opts);

    scanner.addListener('scan', function(content) {
        alert('Do you want to open this page?: ' + content);
        // doExecScannerResult(content);
    });
    Instascan.Camera.getCameras().then(cameras => 
    {
        if(cameras.length > 0){
            scanner.start(cameras[1]);
        } else {
            console.error("Please enable Camera!");
        }
    });

    function doExecScannerResult(value) {
        /*$('#errorMessage').html(value).show("slow").delay('5000').hide();
        return false;*/
        $('.container-loader').removeClass('none');
        $.ajax({
            url: "<?= Constant::baseUrl().'/back/scannerResult' ?>",
            type: 'POST',
            data: {value:value,type:'checkpoint'},
            dataType: 'JSON',
            success: function(data) {
                $('.container-loader').addClass('none');
                result = data.success;
                if (result == 1) { //reload dashboard
                    window.location.reload();
                } else if (result == 2) { //redirect konfirmasi
                    stoppingScan();
                    window.location.href="<?= SERVER.'/back/konfirmasiCheckpoint?id='; ?>"+value;
                } else {
                    $('#errorMessage').html(data.message).show("slow").delay('5000').hide();
                }
            }
        });
    }
    </script>