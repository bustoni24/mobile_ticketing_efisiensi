<style>
    .select2-container{
        width: 100%!important;
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
            <label>Masukkan Tanggal Penugasan</label>
              <?= CHtml::textField('Booking[startdate]',$model->startdate,['placeholder' => 'yyyy-m-dd', 'class' => 'form-control startdate', 'autocomplete' => 'off', 'readonly'=>true]); ?>
        </div>
      </div>

      <div class="row d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Pilih RIT</label>
              <?= CHtml::dropDownList('Booking[rit]',$model->rit, [
                1 => 'RIT 1',
                2 => 'RIT 2',
              ],['class' => 'form-control','prompt'=>'Pilih RIT']); ?>
        </div>
      </div>

      <div class="row d-relative">
        <div class="col-md-12 col-sm-12 col-xs-12">
              <?= CHtml::dropDownList('Booking[tujuan]', $model->tujuan, $arrayTujuan, 
              ['class' => 'form-control','prompt'=>'Pilih Tujuan','required'=>true]); ?>
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
        'emptyText' => (isset($penugasan['message']) ? $penugasan['message'] : 'Tidak ditemukan penugasan'),
    )); ?>

    <?php 
    $data = isset($model->searchBooking()->getData()[0]) ? $model->searchBooking()->getData()[0] : [];
    $status_trip = isset($data['data']['post']['post']['status_trip']) ? $data['data']['post']['post']['status_trip'] : 4;
    $status_rit = isset($data['data']['post']['post']['status_rit']) ? $data['data']['post']['post']['status_rit'] : 0;
    // Helper::getInstance()->dump($data);
    echo $this->renderPartial('_bottom_field', array(
        'data' => $data
        ), false); ?>
</div>

<script>
    var latitude = "<?= isset($_GET['latitude']) ? $_GET['latitude'] : null ?>";
    var longitude = "<?= isset($_GET['longitude']) ? $_GET['longitude'] : null ?>";
    var titik_real_id = "<?= isset($data['data']['listTitikTerdekat']['titik_id']) ? $data['data']['listTitikTerdekat']['titik_id'] : '' ?>";
    var rit = "<?= $model->rit ?>";
    var armada_ke = "<?= isset($data['data']['post']['post']['armada_ke']) ? $data['data']['post']['post']['armada_ke'] : null ?>"
    var penjadwalan_id = <?= isset($data['data']['post']['post']['penjadwalan_id']) ? $data['data']['post']['post']['penjadwalan_id'] : null ?>
    
    // console.log(tujuan);
    document.addEventListener("DOMContentLoaded", function() {
        $('#Booking_tujuan').select2();
        $('#Booking_rit').select2();

            if (latitude === 'null' || latitude === null || latitude === "") {
                 // Cek apakah browser mendukung Geolocation API
                getLatLong();
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

    repeaterLatlong = setTimeout(getLatLong, 5000*60); //reload every 5 minutes
        });
        
    function getLatLong()
    {
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
                                refreshListBooking("-7.8033209", "110.312795");
                                break;
                            case error.POSITION_UNAVAILABLE:
                                console.log("Informasi lokasi tidak tersedia.");
                                refreshListBooking("-7.8033209", "110.312795");
                                break;
                            case error.TIMEOUT:
                                console.log("Permintaan waktu untuk akses lokasi habis.");
                                refreshListBooking("-7.8033209", "110.312795");
                                break;
                            case error.UNKNOWN_ERROR:
                                console.log("Terjadi kesalahan yang tidak diketahui.");
                                refreshListBooking("-7.8033209", "110.312795");
                                break;
                        }
                    }
                );
            } else {
                console.log("Geolocation tidak didukung oleh browser Anda.");
                refreshListBooking("-7.8033209", "110.312795");
            }

        saveLatlong(latitude, longitude);
    }

function refreshListBooking(latitude, longitude) {
    if (latitude !== null && longitude !== null) {
        location.href="<?= Constant::baseUrl().'/'.$this->route.'?startdate=' ?>"+$('#Booking_startdate').val()+"&latitude="+latitude+"&longitude="+longitude+"&rit="+$('#Booking_rit').val()+"&tujuan="+$('#Booking_tujuan').val();
        // var data = {'Booking[startdate]': $('#Booking_startdate').val(), latitude: latitude, longitude: longitude};
        // updateListView(data);
    } else {
        location.href="<?= Constant::baseUrl().'/'.$this->route.'?startdate=' ?>"+$('#Booking_startdate').val()+"&latitude=-7.8033209&longitude=110.312795&rit="+$('#Booking_rit').val()+"&tujuan="+$('#Booking_tujuan').val();
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
        $(this).html('PROSES..');
        getLatLong();
    });

    $('#Booking_rit').on('change', function(){
        getLatLong();
    });
    $('#Booking_tujuan').on('change', function(){
        getLatLong();
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
            .end()
            .find(".opsi_pengantaran_form")
            .addClass('none')
            .end();

            // $('#harga_kursi').append('<div id="'+ elementID +'" class="row d-flex justify-between"> <p class="mb-0">Nomor Kursi '+ element.val() +'</p> <p class="mb-0 text-bold">Rp. '+harga+'</p></div>');

            if (count <= 0 || $('#form-passenger0').find('input.seatForm').val() === "") {
                $('#form-passenger0').find('input.seatForm').val(valSeat);
            } else {
                $('#table-form-passenger').append($addForm);
            }
        } else {
            if (count > 0 && typeof $('#' + passengerFormId).val() !== "undefined") {
                $('#' + passengerFormId).remove();
            } else {
                $('#form-passenger0').find('input[type="text"]').val('');
                $('#form-passenger0').find('input[type="number"]').val('');
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
        var real_armada_ke = $('#BookingTrip_armada_ke').val();
        var status_trip = "<?= ($status_trip == Constant::STATUS_TRIP_CLOSE || in_array($status_rit, [Constant::STATUS_RIT_SKIP, Constant::STATUS_RIT_CLOSE])) ? false : true ?>";
        
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
                            <tr>
                                <th>Opsi Pengantaran</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="opsi_pengantaran" class="form-control">
                                        <option ${dataPassenger.opsi_pengantaran === "<?= Constant::PENGANTARAN_TIDAK ?>" ? 'selected="selected"' : ''} value="<?= Constant::PENGANTARAN_TIDAK ?>"><?= ucwords(Constant::PENGANTARAN_TIDAK) ?></option>
                                        <option ${dataPassenger.opsi_pengantaran === "<?= Constant::PENGANTARAN_YA ?>" ? 'selected="selected"' : ''} value="<?= Constant::PENGANTARAN_YA ?>"><?= ucwords(Constant::PENGANTARAN_YA) ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="${dataPassenger.opsi_pengantaran === "<?= Constant::PENGANTARAN_YA ?>" ? '' : 'none'} opsi_pengantaran_form_id">
                                <th>Daerah Pengantaran</th>
                            </tr>
                            <tr class="${dataPassenger.opsi_pengantaran === "<?= Constant::PENGANTARAN_YA ?>" ? '' : 'none'} opsi_pengantaran_form_id">
                                <td>
                                    <input type="text" id="daerah_pengantaran" class="form-control" placeholder="- Ketik Daerah Pengantaran -" value="${dataPassenger.daerah_pengantaran}">
                                </td>
                            </tr>
                            <tr class="${dataPassenger.opsi_pengantaran === "<?= Constant::PENGANTARAN_YA ?>" ? '' : 'none'} opsi_pengantaran_form_id">
                                <th>Zona Pengantaran</th>
                            </tr>
                            <tr class="${dataPassenger.opsi_pengantaran === "<?= Constant::PENGANTARAN_YA ?>" ? '' : 'none'} opsi_pengantaran_form_id">
                                <td>
                                    <select id="zona_pengantaran" class="form-control">
                                        <option value="">- Pilih Zona Pengantaran -</option>
                                        <option ${dataPassenger.zona_pengantaran === "1" ? 'selected="selected"' : ''} value="1">1</option>
                                        <option ${dataPassenger.zona_pengantaran === "2" ? 'selected="selected"' : ''} value="2">2</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="col-md-4 p-0">
                                        <div class="checkbox">
                                            <label>
                                                <input type="hidden" value="0" name="extra_bagasi"><input class="extra_bagasi" value="1" type="checkbox" name="extra_bagasi" id="extra_bagasi" ${dataPassenger.extra_bagasi === "1" ? 'checked="checked"' : ''}> Extra Bagasi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 p-0 pl-5">
                                    <div class="checkbox">
                                        <input type="text" id="nominal_bagasi" class="form-control number" placeholder="- Nominal Bagasi -" value="${dataPassenger.nominal_bagasi !== null ? dataPassenger.nominal_bagasi : ''}" ${dataPassenger.extra_bagasi === "1" ? '' : 'readonly="readonly"'}>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                `,
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                showConfirmButton: status_trip,
                confirmButtonText: 'Ubah Data',
                confirmButtonColor: '#F58220',
                focusConfirm: false,
                preConfirm: () => {
                    const nama_penumpang = Swal.getPopup().querySelector('#nama_penumpang').value;
                    const no_hp = Swal.getPopup().querySelector('#no_hp').value;
                    const no_kursi = Swal.getPopup().querySelector('#no_kursi').value;
                    const kode_booking = Swal.getPopup().querySelector('#kode_booking').value;
                    const status = Swal.getPopup().querySelector('#status').value;
                    const opsi_pengantaran = Swal.getPopup().querySelector('#opsi_pengantaran').value;
                    const daerah_pengantaran = Swal.getPopup().querySelector('#daerah_pengantaran').value;
                    const zona_pengantaran = Swal.getPopup().querySelector('#zona_pengantaran').value;
                    var choose_extra_bagasi = Swal.getPopup().querySelector('#extra_bagasi');
                    const nominal_bagasi = Swal.getPopup().querySelector('#nominal_bagasi').value;
                    if (!nama_penumpang) {
                        Swal.showValidationMessage(`Silahkan ketik nama penumpang`);
                    }
                    if (!no_hp) {
                        Swal.showValidationMessage(`Silahkan ketik nama penumpang`);
                    }
                    if (!no_kursi) {
                        Swal.showValidationMessage(`Silahkan ketik nama penumpang`);
                    }
                    if (!status) {
                        Swal.showValidationMessage(`Silahkan pilih status penumpang`);
                    }
                    var extra_bagasi = 0;
                    if (choose_extra_bagasi.checked) {
                        extra_bagasi = 1;
                    }

                    if (extra_bagasi === 1 && !nominal_bagasi) {
                        Swal.showValidationMessage(`Silahkan isi nominal bagasi`);
                    }

                    return { kode_booking: kode_booking, nama_penumpang: nama_penumpang, no_hp: no_hp, no_kursi: no_kursi, status: status, opsi_pengantaran: opsi_pengantaran, daerah_pengantaran: daerah_pengantaran, zona_pengantaran: zona_pengantaran, extra_bagasi: extra_bagasi, nominal_bagasi: nominal_bagasi }
                }
            }).then((result) => {
            if (result.isConfirmed) {
                    var value_bagasi = result.value.nominal_bagasi;
                    value_bagasi = value_bagasi.replace(".", "");
                    value_bagasi = value_bagasi.replace(".", "");

                    var data = {kode_booking: result.value.kode_booking, nama_penumpang: result.value.nama_penumpang, no_hp: result.value.no_hp, no_kursi: result.value.no_kursi, penjadwalan_id: penjadwalan_id, status: result.value.status, latitude:"<?= isset($_GET['latitude']) ? $_GET['latitude'] : '' ?>", longitude:"<?= isset($_GET['longitude']) ? $_GET['longitude'] : '' ?>", titik_real_id:titik_real_id,
                    opsi_pengantaran: result.value.opsi_pengantaran, daerah_pengantaran: result.value.daerah_pengantaran, zona_pengantaran: result.value.zona_pengantaran, extra_bagasi: result.value.extra_bagasi, nominal_bagasi: value_bagasi, rit: rit, real_armada_ke: real_armada_ke, armada_ke: armada_ke
                    };

                    /* console.log(data);
                    return false; */
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
    
    $("body").on('keyup', 'input.number', function(e){
        e.preventDefault();
        var value = $(this).val();
        value = value.replace(".", "");
        value = value.replace(".", "");
        $(this).val(accounting.formatNumber(value, 0, "."));
    });
    $("body").on("change", '.extra_bagasi', function(e){
        e.preventDefault();

        if ($(this).is(":checked")) {
            $('.nominal_bagasi').attr('readonly', false);
        } else {
            $('.nominal_bagasi').attr('readonly', true);
        }
    });
    $("body").on("change", '#BookingTrip_tipe_pembayaran', function(e) {
        e.preventDefault();

        if ($(this).val() === 'transfer') {
            $('#formBuktiBayar').removeClass('none');
            $('#BookingTrip_bukti_pembayaran').attr('required', true);
        } else {
            $('#formBuktiBayar').addClass('none');
            $('#BookingTrip_bukti_pembayaran').attr('required', false);
        }
    });

    $("body").on("change", '.opsi_pengantaran', function(e){
        e.preventDefault();

        var parents = $(this).parent().parent().parent().parent().parent().parent();
        if ($(this).val() === 'ya') {
            parents.find('.opsi_pengantaran_form').removeClass('none');
        } else {
            parents.find('.opsi_pengantaran_form').addClass('none');
        }
    });

    $("body").on("change", '#opsi_pengantaran', function(e){
        e.preventDefault();

        if ($(this).val() === 'ya') {
            $('.opsi_pengantaran_form_id').removeClass('none');
        } else {
            $('.opsi_pengantaran_form_id').addClass('none');
        }
    });
    $("body").on("change", "#extra_bagasi", function(e){
        e.preventDefault();

        if ($(this).is(":checked")) {
            $('#nominal_bagasi').attr('readonly', false);
        } else {
            $('#nominal_bagasi').attr('readonly', true);
        }
    })

    function saveLatlong(latitude, longitude)
    {
      if (penjadwalan_id !== null) {
        $.ajax({
              type : "POST",
              url : "<?= Constant::baseUrl() . '/booking/saveLatlong' ?>",
              dataType : "JSON",
              data: {penjadwalan_id:penjadwalan_id, latitude:latitude, longitude:longitude},
              success : function(data) {
                console.log(data);
              },
              error : function(data){
                  if (typeof(data.responseText) !== "undefined")
                      console.log(data.responseText);
              }
          });
      }
    }
</script>