<style>
     body, html {
        margin: 0;
        padding: 0;
        height: 100vh;
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
            transform: rotate(90deg);
    }

    /* Area Fokus */
    .qr-focus-box {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 2px solid #101010;
        box-sizing: border-box;
        background: rgb(7 7 7 / 80%);
        -webkit-clip-path: polygon(0% 0%, 0% 100%, 25% 100%, 25% 25%, 75% 25%, 75% 75%, 25% 75%, 25% 100%, 100% 100%, 100% 0%);
        clip-path: polygon(0% 0%, 0% 100%, 25% 100%, 25% 25%, 75% 25%, 75% 75%, 25% 75%, 25% 100%, 100% 100%, 100% 0%);
    }

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
    </div>
    <div id="qr-result"></div>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        const videoElement = document.getElementById('qr-video');
const qrResultElement = document.getElementById('qr-result');

const scanner = new Instascan.Scanner({ video: videoElement });

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
    qrResultElement.innerHTML = `Hasil: ${content}`;
});
    </script>
