<style>
.digit-group input{
		width: 40px!important;
		height: 50px;
		background-color: lighten('#0f0f1a', 5%);
		border: none;
		line-height: 50px;
		text-align: center;
		font-size: 24px;
		font-family: 'Raleway', sans-serif;
		font-weight: 200;
		color: #000;
		margin: 0 2px;
        padding: 1px 2px;
        background-color: #d6d6d6;
	}

    .digit-group.splitter {
		padding: 0 5px;
		color: #000;
		font-size: 24px;
	}

.prompt {
	margin-bottom: 20px;
	font-size: 20px;
	color: #000;
    text-align:center;
}
form {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}
.containerBtn{
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 20px;

}
#content{
    margin-top:20%;
}
#timer{
	text-align: center;
    margin-bottom: 15px;
    font-size: 1.5rem;
}
#timer a{
	color: #720bff;
    text-decoration: underline;
}
.container-loader{
	display: flex;
    width: 100%;
    justify-content: center;
}
.none {
	display:none!important;
}
</style>
<div class="prompt">
	Mohon verifikasi email terlebih dahulu
</div>
<div class="container-loader none">
	<div class="loader"></div>
</div>

<div id="timer">01:01</div>

<form method="get" action="<?= CController::createUrl('/front/verifikasiEmail') ?>" class="digit-group" data-group-name="digits" data-autosubmit="true" autocomplete="off">
	<input type="number" id="digit-1" name="digit-1" data-next="digit-2" />
	<input type="number" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
	<input type="number" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
	<input type="number" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
	<input type="number" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
	<input type="number" id="digit-6" name="digit-6" data-next="digit-7" data-previous="digit-5" />

    <div class="containerBtn">
    <button type="button" class="btn btn-success btnSuccess" id="btnSend">SEND</button>
    </div>
</form>

<script>
	function initVerifikasiEmail(){ 
		var timeOut;
		$('.digit-group').find('input').each(function() {
		$(this).attr('maxlength', 1);
		$(this).on('keyup', function(e) {
			var parent = $($(this).parent());
			
			if(e.keyCode === 8 || e.keyCode === 37) {
				var prev = parent.find('input#' + $(this).data('previous'));
				
				if(prev.length) {
					$(prev).select();
				}
			} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
				var next = parent.find('input#' + $(this).data('next'));
				
				if(next.length) {
					$(next).select();
				} else {
					if(parent.data('autosubmit')) {
						clearTimeout(timeOut);
						// parent.submit();
						submitForVerify();
					}
				}
			}
		});
		});

		$('#btnSend').on('click', function() {
			clearTimeout(timeOut);
			submitForVerify();
		});

		startTimer();
		function startTimer() {
		var presentTime = document.getElementById('timer').innerHTML;
		var timeArray = presentTime.split(/[:]+/);
		var m = timeArray[0];
		var s = checkSecond((timeArray[1] - 1));
		if(s==59){m=m-1}
		if((m + '').length == 1){
			m = '0' + m;
		}
		if(m < 0){
			m = '59';
			resendAgain();
			clearTimeout(timeOut);
			return false;
		}
		document.getElementById('timer').innerHTML = m + ":" + s;
		timeOut = setTimeout(startTimer, 1000);
		}

		function checkSecond(sec) {
		if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
		if (sec < 0) {sec = "59"};
		return sec;
		}

		function resendAgain() {
			document.getElementById('timer').innerHTML = "<a id='timerBtn' href='javascript:void(0);'>Kirim ulang kode verifikasi</a>";
			$('#timerBtn').on('click', function(){
				triggerResend();
			});
		}

		function triggerResend() {
				let id = "<?= $id ?>";
				let type = "<?= $type ?>";
				$('.container-loader').removeClass('none');
				//send email again
				$.ajax({
                    url: "<?= Constant::baseUrl().'/front/resendVerification?id=' ?>"+id+"&type="+type,
                    type: 'get',
                    dataType: 'JSON',
                    success: function(data) {
						$('.container-loader').addClass('none');
                        result = data.success;
                        if (result == 1) {
							document.getElementById('timer').innerHTML = "01:01";
							startTimer();
						} else {
							document.getElementById('timer').innerHTML = "Gagal kirim ulang. <a href='javascript:void(0);' id='timerBtn'>Kirim lagi</a>";
							$('#timerBtn').on('click', function(){
								triggerResend();
							});
						}

                    }
                });
			};


		function submitForVerify() {
			$('#preloader').show();
			let id = "<?= $id ?>";
			let type = "<?= $type ?>";
			var code = $('#digit-1').val()+$('#digit-2').val()+$('#digit-3').val()+$('#digit-4').val()+$('#digit-5').val()+$('#digit-6').val();
			$.ajax({
                    url: "<?= Constant::baseUrl().'/front/verify' ?>",
                    type: 'post',
					data: {id:id,code:code,type:type},
                    dataType: 'JSON',
                    success: function(data) {
                        result = data.success;
                        if (result == 1) {
							window.location.href = "<?= Constant::baseUrl().'/'; ?>";
						} else {
							$('#preloader').hide();
							$('#timer').html('Verifikasi Gagal! Kode verifikasi tidak cocok. <a href="javascript:void(0);" id="timerBtn">Kirim lagi</a>');
							$('#timerBtn').on('click', function(){
								triggerResend();
							});
						}

                    }
                });
		}
	};
</script>