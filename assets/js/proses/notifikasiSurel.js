$(document).ready(function(){
    $(document).on('change', '#idAlasanTolak', function(){
        $(this).parents(".form-group").removeClass('has-error');
	    $(this).next().empty();
    });

    $(document).on('click', '.btn-primary-email', function(e){
        e.preventDefault();
        // $("#positionPic").val($(this).attr('data-picposition'));
        $("#nomorPengajuanCuti").val($(this).attr('data-nomorcuti'));
        $("#modalProcessSurel").modal('show');
    });

    $(document).on('click', '#rejectSurel', function(){
        $("#idAlasanTolak").parents('.form-group').removeClass('has-error');
        $('#idAlasanTolak').next().empty();
        $("#idAlasanTolak").val('');
        $("#modalRejectSUrel").modal('show');
    });

    $(document).on("click", "#approveSurel", function(){
        var element = $(this);
        $(element).text('Approving...').prop('disabled', true);
        $("#rejectSurel").prop('disabled', true);
        // approveRejectMessage($("#positionPic").val(), $("#nomorPengajuanCuti").val());
        approveRejectMessage($("#idEmailCuti").val(), $("#nomorPengajuanCuti").val());
    });

    $(document).on('click', '#submitRejectMessage', function(){
        $(this).text('Submitting...').prop('disabled', true);
        var alasan = $('#idAlasanTolak').val();
        if(alasan == null || alasan == ''){
            $('#idAlasanTolak').closest(".form-group").addClass("has-error");
            $(".text-danger.idAlasanTolak").text("* Field tidak boleh kosong");
            $('#submitRejectMessage').text('Submit').prop('disabled', false);
        }else{
            // approveRejectMessage($("#positionPic").val(), $("#nomorPengajuanCuti").val(), $('#idAlasanTolak').val());
            approveRejectMessage($("#idEmailCuti").val(), $("#nomorPengajuanCuti").val(), $('#idAlasanTolak').val());
        }
    });
});

function getMessage(nomorCuti, idEmail, element = null) {
    $("#idEmailCuti").val(idEmail);
    // var noreg = $(element).attr('data-noreg');
    // var idEmail = $(element).attr('data-idemail');
    // var nomorCuti = $(element).attr('data-nomorcuti');
    // var picNoreg = $(element).attr('data-picnoreg');
    // var division = $(element).attr('data-division');
    $("#headerEmail").removeClass('fadeInUp');
    $(".preloadEmail").removeClass('hide');
    $(".full-height-scroll.white-bg.border-left").addClass('addOpacity');
    $.ajax({
        type: "POST",
        url: site_url + 'NotifikasiSurel/getMessage',
        dataType: 'json',
        data: {
            // noreg: noreg,
            nomorCuti: nomorCuti,
            // picNoreg: picNoreg,
            // division: division,
            idEmail: idEmail
        },
        success: function (data) {
            $("#halamanSurel").hide();
            $("#headerEmail").removeClass('hide').addClass('fadeInUp');
            $("#receiveDate").text(data.receive_date);
            $("#senderPhoto").attr('src', site_url + 'assets/img/empPhoto/' + data.photo);
            $("#subjectEmail").text(data.subject);
            $("#positionSender").text(data.position);
            $("#isiSurat").html(data.message);
            if(element != null){
                $(element).find("#readStatus").remove();
            }
            
            if(data.isProcessed != 2){
                $("#isProcessed").removeClass('label-warning').addClass('label-primary').text('Sudah diproses');
                $('.btn-primary-email')
                    .removeClass('btn-primary-email')
                    .addClass('btn ' + (data.isProcessed == 3 ? 'btn-info' : data.isProcessed == 1 ? 'btn-danger' : '') +' btn-email')
                    .attr({'data-picposition' : '', 'data-nomorcuti' : '', 'href' : '#'})
                    .text(data.statusApproval);
            }else{
                $("#isProcessed").removeClass('label-primary').addClass('label-warning').text('Belum diproses');
            }

            $(".preloadEmail").addClass('hide');
            $(".full-height-scroll.white-bg.border-left").removeClass('addOpacity');

            load_unseen_notification();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("Status: " + textStatus, "Error: " + errorThrown);
            console.log(XMLHttpRequest);
        }
    });

    $( document ).ajaxSuccess(function( event, request, settings ) {
        $('.btn-primary-email').attr('href', "");
    });
}

function approveRejectMessage(idEmailCuti, cutiNumber, alasanTolak = null){
    // var nomorCuti = $('.btn-primary-email').attr('data-nomorcuti');
    $.ajax({
        type: "POST",
        url: site_url + 'NotifikasiSurel/updateApproval',
        dataType: 'json',
        data: { /*picPosition : picPosition,*/ nomorCuti : cutiNumber, alasanTolak : alasanTolak},
        success: function(data){
            $('#approveSurel').text('Approve').prop('disabled', false);
            $("#rejectSurel").prop('disabled', false);
            if(data.status){
                $("#modalProcessSurel").modal('hide');
                $("#modalRejectSUrel").modal('hide');
                if($('#tableListPengajuanCuti').length){
                    tblListPengajuanCuti.ajax.reload();
                    getMessage(cutiNumber, idEmailCuti);
                }
                count_list_pengajuan_cuti();
                swal({
                    title: "Great!",
                    text: "Surel Berhasil Diproses!",
                    showConfirmButton: true,
                    confirmButtonColor: '#00BFFF',
                    type: "success"
                },
                function () {
                    // getMessage('.list-group-item[data-nomorcuti="' + cutiNumber + '"]');
                    if($('#tableListPengajuanCuti').length == 0){
                        getMessage(cutiNumber, idEmailCuti);
                    }
                });
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("Status: " + textStatus, "Error: " + errorThrown);
            console.log(XMLHttpRequest);
        }
    });
}
