<script type="text/javascript">
	$(function(){
	  var el = $('video, audio');
      if(!el.length) return;
      el.each(function() {
        var $this = $(this);
        if( this.unifato === undefined )
          this.unifato = {};
        $this.mediaelementplayer({
          pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
          shimScriptAccess: 'always'
        });
        if( this.tagName === 'VIDEO' ) {
          $this.on('playing', function() {
            $this.closest('.mejs__container').addClass('mejs__video--playing');
          });
          $this.on('ended', function() {
            $this.closest('.mejs__container').removeClass('mejs__video--playing');
          });
        }
        this.unifato.mediaelementplayer = $this.data('mediaelementplayer');
      });
	});
</script>
<link rel="stylesheet" href="<?= base_url('assets/fancy/jquery.fancybox.min.css') ?>" type="text/css" media="screen" />

<style type="text/css">
	.boxWhite {
		width: 100%;
		padding: 10px;
		min-height: 100px;
		background-color: white;
		border: 1px solid black;
		border-radius: 6px;
	}
	p.number {
		font-size: 20px;
		margin-top: -5px;
		color: black;
	}
	.is-countdown {
		background-color: transparent;
		border: none;
	}
	.is-countdown .countdown-row .countdown-section {
		font-size: 15px;
		font-weight: bold;
		color: #A9A9A9;
	}
	.is-countdown .countdown-row .countdown-section:first-child {
		margin-right: 10px;
	}
	.is-countdown .countdown-row .countdown-section:last-child {
		margin-left: 10px;
	}
	.btn-own {
		background-color: #119AE1;
		border-color: #119AE1;
		color: white;
	}
	.btn-own:hover {
		background-color: #119AE1;
		border-color: #119AE1;
		color: white;
	}
	.btn-own:visited {
		background-color: #119AE1;
		border-color: #119AE1;
		color: white;
	}
	.line {
		border-bottom: 1px solid black;
		width: 100%;
		min-height: 1px;
		margin:2px 0px;
	}
</style>

<script type="text/javascript">
	$(function(){
		//ambil data assignment duration dari variable dataAssignment yang dikirim dari controller exam function begin
		var D = '<?= $dataAssignment->assignment_duration ?>';
		var divide = '<?= $long ?>';
		var clean = D - parseInt(divide);
		if (parseInt(clean) < 1) {
			timesUp();
		} else {
			var duration = parseInt(clean * 60);
			$("#countdown").countdown({
				until: duration, format: 'HMS',
				onExpiry: timesUp,
			});
		};
	});
	function timesUp() {
		var data = $('form').serialize();
		var showReport = '<?= $dataAssignment->show_report ?>';
		$.ajax({
			url : '<?= site_url("frontend/exam/calculate") ?>',
			type : 'POST',
			data : data,
			success:function(res) {
				swal({
	                title: 'Oooppss waktu telah berakhir!',
	                type: 'error',
	                text: 'Jawaban anda akan disimpan secara otomatis.',
	                timer: 3000,
	                showConfirmButton: false
	            });
				setTimeout(function(){	
					if (parseInt(showReport) == 1) {
						window.location.href = "<?= site_url('frontend/exam/report/'.$dataAssignment->id_assignment) ?>";
					} else {
						window.location.href = "<?= site_url('frontend/exam') ?>";
					}
				},3000);
			}
		});
	}
</script>

<!-- JAVASCRIPT -->
<script type="text/javascript">
	$(function() {
		var tQuestion = parseInt($("#totalQuestion").val());
		if (tQuestion > 1) {
			$("#finished").hide();
			$("#prev").hide();
		} else {
			$("#finished").show();
			$("#next").hide();
			$("#prev").hide();
		};
		$("#buttonNavigation0").removeClass('btn-default');
		$("#buttonNavigation0").addClass('btn-own');
	});
	function nextQuest() {
		var questNow = parseInt($("#questNow").val());
		var total = parseInt($("#totalQuestion").val());
		questNow++;
		if (questNow >= (parseInt(total) - 1)) {
			$("#finished").show();
			$("#next").hide();
			$("#prev").hide();
		} else {
			$("#prev").show();
		};
		openQuestion(questNow);
		$("#questNow").val(questNow);
	}
		function clearButton() {
			var total = $("#totalQuestion").val();
			for (var i = 0; i <= parseInt(total); i++) {
				$("#buttonNavigation"+i).addClass('btn-default');
				$("#buttonNavigation"+i).removeClass('btn-own');
			};
		}
	function prevQuest() {
		var questNow = parseInt($("#questNow").val());
		questNow--;
		if (questNow === 0) {
			$("#finished").hide();
			$("#prev").hide();
			$("#next").show();
		} else {
			$("#finished").hide();
		};
		openQuestion(questNow);
		$("#questNow").val(questNow);
	}
	function openQuestion(rows) {
		var total = $("#totalQuestion").val();
		for (var i = 0; i <= parseInt(total); i++) {
			$("#question"+i).hide();

			// BUTTON VAL //
			if ($("#buttonNavigation"+i).hasClass('btn-success')) {

			} else {
				$("#buttonNavigation"+i).removeClass('btn-own');
				$("#buttonNavigation"+i).addClass('btn-default');
			};
		};

		// SECOND BUTTON VAL //
		if ($("#buttonNavigation"+rows).hasClass('btn-success')) {} else {
			$("#buttonNavigation"+rows).removeClass('btn-default');
			$("#buttonNavigation"+rows).addClass('btn-own');
		}
		// END SECOND BUTTON VAL //
		$("#question"+rows).show();

		// NEXT PREV VAL //
		if (parseInt(rows) === parseInt(total - 1)) {
			$("#next").hide();
			$("#prev").hide();
			$("#finished").show();
		} else if(parseInt(rows) === 0) {
			$("#finished").hide();
			$("#prev").hide();
			$("#next").show();
		} else {
			$("#finished").hide();
			$("#next").show();
			$("#prev").show();
		};
		$("#questNow").val(rows);
	}
	function answered(rows) {
		$("#buttonNavigation"+rows).removeClass('btn-default');
		$("#buttonNavigation"+rows).removeClass('btn-own');
		$("#buttonNavigation"+rows).addClass('btn-success');
	}
</script>
<script src="<?= base_url('assets/fancy/jquery.fancybox.min.js') ?>" type="text/javascript"></script>