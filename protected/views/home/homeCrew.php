
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
            <label>Masukkan Tanggal Penugasan</label>
              <?= CHtml::textField('Booking[startdate]',$model->startdate,['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off']); ?>
        </div>
      </div>

      <div class="row d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
              <?= CHtml::dropDownList('Booking[tujuan]', $model->tujuan, Armada::object()->getTujuan($_GET), ['prompt'=>'Pilih Tujuan','required'=>true]); ?>
        </div>
      </div>
      <div class="row d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-warning pull-right" id="cari">Cari</button>
        </div>
      </div>

        <?php $this->endWidget(); ?>
    </div>

    <?php $this->widget('zii.widgets.CListView', array(
        'id'=>'listViewBooking',
        'dataProvider'=>$model->searchBooking(),
        'itemView'=>'_view_list_booking',
        'emptyText' => 'Tidak ditemukan penugasan',
    )); ?>

    <?php 
    $data = isset($model->searchBooking()->getData()[0]) ? $model->searchBooking()->getData()[0] : [];
    echo $this->renderPartial('_bottom_field', array(
        'data' => $data
        ), false); ?>
</div>

<script>
    var latitude = "<?= isset($_GET['latitude']) ? $_GET['latitude'] : null ?>";
    var longitude = "<?= isset($_GET['longitude']) ? $_GET['longitude'] : null ?>";
    var tujuan = "<?= isset($penugasan['data']['tujuan_id']) ? $penugasan['data']['tujuan_id'] : null ?>";
    document.addEventListener("DOMContentLoaded", function() {
        $('#Booking_tujuan').select2();

            if (latitude === 'null' || latitude === null || latitude === "") {
                 // Cek apakah browser mendukung Geolocation API
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            latitude = position.coords.latitude;
                            longitude = position.coords.longitude;
                            // alert('latitude: ' + latitude + ', longitude: ' + longitude);
                            refreshListBooking(latitude, longitude);
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
            <?php
        //flashes
        foreach(Yii::app()->user->getFlashes() as $key => $message){
            ?>
            console.log('<?= $key ?>');
            Swal.fire({
                    title: '<?= $message ?>',
                    icon: '<?= $key ?>',
                    showDenyButton: '<?= ($key == 'success') ? true : false ?>',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    denyButtonText: `Cetak eTicket`,
                    denyButtonColor: '#F58220',
            }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isDenied) {
                        window.open("<?= Constant::baseUrl().'/booking/itinerary?id=' . (isset($_GET['last_id_booking']) ? $_GET['last_id_booking'] : '')  ?>",'_blank');
                    }
            });

            <?php
        }
    ?>
        });

function refreshListBooking(latitude, longitude) {
    if (latitude !== null && longitude !== null) {
        location.href="<?= Constant::baseUrl().'/'.$this->route.'?startdate=' ?>"+$('#Booking_startdate').val()+"&latitude="+latitude+"&longitude="+longitude+"&tujuan="+tujuan;
        // var data = {'Booking[startdate]': $('#Booking_startdate').val(), latitude: latitude, longitude: longitude};
        // updateListView(data);
    }
}

var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  $('#Booking_startdate').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
    minDate: today,
		header: true
	});

    $('#cari').on('click', function(){
        var startdate = $('#Booking_startdate').val();
        var tujuanId = $('#Booking_tujuan').val();
        location.href="<?= Constant::baseUrl().'/'.$this->route.'?startdate=' ?>"+startdate+"&latitude="+latitude+"&longitude="+longitude+"&tujuan="+tujuanId;
    });

    function updateListView(data)
        {
            if (typeof data === "undefined" || data === null || data === "")
                return false;

            $.fn.yiiListView.update('listViewBooking', {data:data,
			complete: function(){
			
			},
            error : function(data){
                if (typeof(data.responseText) !== "undefined")
                    console.log(data.responseText);
            }});
        }
</script>

<script>
    $("body").on('change', '.checkSeat', function(e){
        e.preventDefault();

        addFormSeatAction($(this));
        addDetailPembelian($(this));
    });

    /* function confirmSubmit(){
        const element = document.getElementById("layoutPenumpang");
        const yOffset = -100; // Jarak offset dari elemen, sesuaikan dengan kebutuhan Anda
        const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

        window.scrollTo({ top: y, behavior: 'smooth' });
    } */
    function onSubmitForm(event) {
        const requiredInputs = document.querySelectorAll("input[required]");

        const someInputsEmpty = Array.from(requiredInputs).some(input => !input.value);

        if (someInputsEmpty) {
            // Ada input yang belum terisi, lakukan scroll ke bawah
            const sections = document.querySelectorAll(".section");
            const lastSection = sections[sections.length - 1];
            const yOffset = 20; // Jarak offset dari elemen, sesuaikan dengan kebutuhan Anda
            const y = lastSection.getBoundingClientRect().top + window.pageYOffset + yOffset;

            window.scrollTo({ top: y, behavior: 'smooth' });
            event.preventDefault(); // Mencegah form melakukan submit
        }
        }

    function addFormSeatAction(element, selectedElement = "")
    {
        if (typeof element === "undefined") {
            alert('Terjadi kesalahan');
            return false;
        }

        var inputs = document.querySelectorAll('#table-form-passenger input.seatForm');
        var count = 0;
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value.trim() !== '') {
                count++;
            }
        }

        var seatIndex = parseInt(element.attr('data-index'));
        var passengerFormId = 'passengerForm' + seatIndex;
        var valSeat = element.val();

        var elementID = 'kursiForm' + seatIndex;
        /* var harga = parseInt(element.attr('data-tarif'));
        harga = accounting.formatNumber(harga, 0, "."); */
        var tlActive = parseInt(element.attr('data-tlActive'));
        if (element.is(":checked")) {
            if (count >= 4) {
                swal.fire('Maaf pembelian tiket sudah melewati batas', '', 'warning');
                element.attr('checked', false);
                return false;
            }

            if (!tlActive && element.attr('data-index') === '99') {
                swal.fire('Maaf Kursi TL belum bisa dipesan jika kursi belum full', '', 'warning');
                element.attr('checked', false);
                return false;
            }
            
            var $addForm = $('#form-passenger0')
            .clone()
            .attr('id', passengerFormId)
            .find("input:text").val("")
            .end()
            .find("input.seatForm").val(valSeat)
            .end();

            // $('#harga_kursi').append('<div id="'+ elementID +'" class="row d-flex justify-between"> <p class="mb-0">Nomor Kursi '+ element.val() +'</p> <p class="mb-0 text-bold">Rp. '+harga+'</p></div>');

            if (count <= 0 || $('#form-passenger0').find('input.seatForm').val() === "") {
                $('#form-passenger0').find('input.seatForm').val(valSeat);
            } else {
                $('#table-form-passenger').append($addForm);
            }
        } else {
            if (count > 1 && typeof $('#' + passengerFormId).val() !== "undefined") {
                $('#' + passengerFormId).remove();
            } else {
                $('#form-passenger0').find('input[type="text"]').val('');
            }
            $('#' + elementID).remove();
        }
    }

    function addDetailPembelian(element)
    {
        if (typeof element === "undefined") {
            alert('Terjadi kesalahan');
            return false;
        }

        var inputs = document.querySelectorAll('#table-form-passenger input.seatForm');
        var count = 0;
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value.trim() !== '') {
                count++;
            }
        }

        var harga = parseInt(element.attr('data-tarif'));
        var totalHarga = harga * count;
        $('#total_price').html(accounting.formatNumber(totalHarga, 0, "."));
        $('#BookingTrip_total_harga').val(totalHarga);
    }

    $("body").on('click', 'span.booked, span.text-checkmark', function(){
        var idPassenger = $(this).attr('data-passengerId');
        var dataPassenger = {};
        if (typeof $(this).attr('data-passengerData') !== "undefined" && $(this).attr('data-passengerData') !== ""){
            dataPassenger = JSON.parse($(this).attr('data-passengerData'));
        }
        var seat = $(this).attr('data-seat');
        let startdate = $(this).attr('data-startdate');
        let penjadwalan_id = $(this).attr('data-penjadwalan_id');
        
        if (typeof dataPassenger.nama !== 'undefined' && dataPassenger.nama !== "" && dataPassenger.nama !== null) {
            Swal.fire({
                title: 'Layout Kursi Nomor '+seat,
                html: `
                <div class="row">
                    <div class="form-group">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <th>Nama Penumpang</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" id="kode_booking" value="${dataPassenger.kode_booking}"/>
                                    <input type="text" id="nama_penumpang" class="form-control" placeholder="- Ketik Nama Penumpang -" value="${dataPassenger.nama}">
                                </td>
                            </tr>
                            <tr>
                                <th>Nomor HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="no_hp" class="form-control" placeholder="- Ketik Nomor HP -" value="${dataPassenger.no_hp}">
                                </td>
                            </tr>
                            <tr>
                                <th>Nomor Kursi</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="no_kursi" class="form-control" placeholder="- Ketik Nomor Kursi -" value="${dataPassenger.no_kursi}">
                                </td>
                            </tr>
                            <tr>
                                <th>Status Penumpang</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="status" class="form-control">
                                        <option value="">- Pilih Status -</option>
                                        <option ${dataPassenger.status === "<?= Constant::STATUS_PENUMPANG_NAIK ?>" ? 'selected="selected"' : ''} value="<?= Constant::STATUS_PENUMPANG_NAIK ?>">Naik</option>
                                        <option ${dataPassenger.status === "<?= Constant::STATUS_PENUMPANG_TURUN ?>" ? 'selected="selected"' : ''} value="<?= Constant::STATUS_PENUMPANG_TURUN ?>">Turun</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                `,
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Ubah Data',
                confirmButtonColor: '#F58220',
                focusConfirm: false,
                preConfirm: () => {
                    const nama_penumpang = Swal.getPopup().querySelector('#nama_penumpang').value;
                    const no_hp = Swal.getPopup().querySelector('#no_hp').value;
                    const no_kursi = Swal.getPopup().querySelector('#no_kursi').value;
                    const kode_booking = Swal.getPopup().querySelector('#kode_booking').value;
                    const status = Swal.getPopup().querySelector('#status').value;
                    if (!nama_penumpang) {
                        Swal.showValidationMessage(`Silahkan ketik nama penumpang`)
                    }
                    if (!no_hp) {
                        Swal.showValidationMessage(`Silahkan ketik nama penumpang`)
                    }
                    if (!no_kursi) {
                        Swal.showValidationMessage(`Silahkan ketik nama penumpang`)
                    }
                    if (!status) {
                        Swal.showValidationMessage(`Silahkan pilih status penumpang`)
                    }
                    return { kode_booking: kode_booking, nama_penumpang: nama_penumpang, no_hp: no_hp, no_kursi: no_kursi, status: status }
                }
            }).then((result) => {
            if (result.isConfirmed) {
                    var data = {kode_booking: result.value.kode_booking, nama_penumpang: result.value.nama_penumpang, no_hp: result.value.no_hp, no_kursi: result.value.no_kursi, penjadwalan_id: penjadwalan_id, status: result.value.status, latitude:"<?= isset($_GET['latitude']) ? $_GET['latitude'] : '' ?>", longitude:"<?= isset($_GET['longitude']) ? $_GET['longitude'] : '' ?>"};

                    if (data.status === "<?= Constant::STATUS_PENUMPANG_REJECT ?>") {
                        return false;
                    }
                    
                    $.ajax({
                        type : "POST",
                        url : "<?= Constant::baseUrl() . '/booking/updateBooking' ?>",
                        dataType : "JSON",
                        data: data,
                        success : function(data) {
                            if (data.success) {
                                updateListView({'Booking[startdate]':startdate});
                                Swal.fire({
                                    html: `Data berhasil dikonfirmasi`,
                                    icon: 'info',
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'OK'
                                    });
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
                                    //action reload
                                    /* setTimeout(function() {
                                        location.reload();
                                    }, 1500); */
                            }
                        },
                        error : function(data){
                            if (typeof(data.responseText) !== "undefined")
                                console.log(data.responseText);
                        }
                    });
                }
            });
        } else {
            console.log(dataPassenger);
        }
    });
</script>