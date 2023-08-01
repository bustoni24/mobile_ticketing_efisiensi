
<div class="row mt-20">

<?php 
$this->widget('zii.widgets.CListView', array(
    'id'=>'listViewBooking',
    'dataProvider'=>$model->routeDetail(),
    'itemView'=>'/home/_view_list_booking',
    'emptyText' => 'Tidak ditemukan data booking',
)); 
?>
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

    $("body").on('click', 'input.checkSeat', function(){
        return false;
    });

$("body").on('click', 'span.booked, span.text-checkmark', function(){
    var idPassenger = $(this).attr('data-passengerId');
    var dataPassenger = {};
    if (typeof $(this).attr('data-passengerData') !== "undefined" && $(this).attr('data-passengerData') !== ""){
        dataPassenger = JSON.parse($(this).attr('data-passengerData'));
    }
    var seat = $(this).attr('data-seat');
    let startdate = $(this).attr('data-startdate');
    let penjadwalan_id = $(this).attr('data-penjadwalan_id');
    let tujuan = $(this).attr('data-tujuan');
    
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
                                <td>${tujuan}</td>
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

$("body").on('click', '#tolak', function(){
        let penjadwalan_id = "<?= $post['penjadwalan_id']; ?>";
        
        Swal.fire({
        title: 'Konfirmasi Ketidaksesuaian Data',
        html: ` <div class="row">
                    <div class="form-group">
                        <label class="col-md-4">Alasan Tidak Sesuai</label>
                        <div class="col-md-6">
                            <textarea id="alasan" class="swal2-input form-control" placeholder="- Ketik Alasan Tidak Sesuai -"></textarea>
                        </div>
                    </div>
                </div>
                `,
        showDenyButton: true,
        denyButtonText: `Cancel`,
        confirmButtonText: 'OK',
        confirmButtonColor: '#F58220',
        focusConfirm: false,
        preConfirm: () => {
            const alasan = Swal.getPopup().querySelector('#alasan').value
            if (!alasan) {
            Swal.showValidationMessage(`Silakan masukkan alasan pembatalan`)
            }
            return { alasan: alasan }
        }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                        type : "POST",
                        url : "<?= Constant::baseUrl() . '/booking/rejectTrip' ?>",
                        dataType : "JSON",
                        data: {alasan:result.value.alasan,penjadwalan_id:penjadwalan_id},
                        success : function(data) {
                            if (data.success) {
                                Swal.fire(
                                    `Konfirmasi ketidaksesuaian berhasil <br/>
                                    Alasan: ${result.value.alasan}
                                    `.trim());
                                    setTimeout(function() {
                                        location.href="<?= Constant::baseUrl().'/home/index'; ?>";
                                    }, 1000);
                            } else {
                                console.log(data);
                            }
                        },
                        error : function(data){
                            if (typeof(data.responseText) !== "undefined")
                                console.log(data.responseText);
                        }
                    });
            }
        });
    });
</script>