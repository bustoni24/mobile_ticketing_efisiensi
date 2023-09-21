
<style>
    .gj-datepicker {
        display: none;
    }
    .select2-container{
        width: 100%!important;
    }
</style>
<?php 
$data = isset($model->routeDetail()->getData()[0]) ? $model->routeDetail()->getData()[0] : [];
?>
<div class="row mt-20">

<?= CHtml::hiddenField('Booking[startdate]',$model->startdate); ?>
<?= CHtml::hiddenField('Booking[tujuan]', isset($data['data']['subTripSelected']['id']) ? $data['data']['subTripSelected']['id'] : ''); ?>

<?php 
$this->widget('zii.widgets.CListView', array(
    'id'=>'listViewBooking',
    'dataProvider'=>$model->routeDetail(),
    'itemView'=>'/home/_view_list_booking',
    'emptyText' => 'Tidak ditemukan data booking',
)); 
?>

<?php 
    echo $this->renderPartial('/home/_bottom_field', array(
        'data' => $data
        ), false); ?>
</div>

<script>
var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
$('#Booking_startdate').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd',
minDate: today,
    header: true
});

$('#Booking_startdate').on('change', function(){
    var name = $(this).attr('name');
    var value = $(this).val();
    var data = {};
    data[name] = value;
    
    updateListView(data);
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

function addFormSeatAction(element)
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
        if (count > 0 && typeof $('#' + passengerFormId).val() !== "undefined") {
            $('#' + passengerFormId).remove();
        } else {
            $('#form-passenger0').find('input[type="text"]').val('');
            $('#form-passenger0').find('input[type="number"]').val('');
        }
        // $('#' + elementID).remove();
    }
    console.log(count);
    console.log(elementID);
    console.log(passengerFormId);
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
    // let tujuan = $(this).attr('data-tujuan');
    
    if (typeof dataPassenger.nama !== 'undefined' && dataPassenger.nama !== "" && dataPassenger.nama !== null) {
        Swal.fire({
                html: `
                    <table class='table' style='text-align:left;'>
                        <tbody>
                            <tr>
                                <td width='40%'>Nama Penumpang</td>
                                <td style='width:10px;'>:</td>
                                <td>${dataPassenger.nama}</td>
                            </tr>
                            <tr>
                                <td>Tujuan</td>
                                <td style='width:10px;'>:</td>
                                <td>${dataPassenger.kota_tujuan}</td>
                            </tr>
                        </tbody>
                    </table>
                `,
                icon: 'info',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: 'OK'
            });
    } else {
        console.log(dataPassenger);
    }
});
</script>