$(document).ready(function () {

    $("#ajukanCuti").on('click', function () {
        var noregEmp = $(this).attr('data-noreg');
        $(this).text("Mohon Tunggu....").prop("disabled", true);
        $.ajax({
            type: "POST",
            url: site_url + "PengajuanCuti/cekValidasiUser",
            dataType: 'json',
            data: {
                noreg: noregEmp
            },
            success: function (data) {
                if (data.status) {
                    swal({
                        title: "Great!",
                        text: data.msg,
                        showConfirmButton: true,
                        confirmButtonColor: '#00BFFF',
                        type: "success"
                    }, function () {
                        $("#validasiCuti").hide();
                        $("#formCuti").css('display', 'block').addClass('fadeInUp');
                    });
                    $("#nomorPengajuan").val(data.nomor_pengajuan);
                } else {
                    swal("Sorry!", data.msg, "error");
                }
                $("#ajukanCuti").text('Ajukan Cuti').prop('disabled', false);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus, "Error: " + errorThrown);
                console.log(XMLHttpRequest);
            }
        });
    })

    $('.input-group.date').datepicker({
        // todayBtn: "linked",
        todayHighlight: true,
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        startDate: '+7d',
        format: "dd/mm/yyyy"
    });

    $("#btnAjukanCuti").on('click', function () {
        $("#dateStart, #dateEnd").prop('disabled', true).css('opacity','0.5');
        var validation = validate();
        var url = site_url + "PengajuanCuti/prosesPengajuanCuti";
        $(this).text('Sedang diproses...').prop('disabled', true);
        if (validation != 1) {
            $("#formPengajuan").addClass('sk-loading');
            processWithAjax(getDataValue(), url);
        }else{
            $("#dateStart, #dateEnd").prop('disabled', false).css('opacity','1');
            $(this).text('Ajukan Permohonan Cuti').prop('disabled', false);
        }
    });

    $("input, textarea").on('change', function(){
        $(this).closest('.form-group').removeClass('has-error');
        $(this).parent().next().empty();
        $(this).next().empty();
    });

});

function validate() {
    var errorIndex = 0;
    var date1 = $("#dateStart").val().split('/');
    var date2 = $("#dateEnd").val().split('/');
    var dateStarts = $("#dateStart").val();

    var starDate = date1[1] + '-' + date1[0] + '-' + date1[2];
    var endData  = date2[1] + '-' + date2[0] + '-' + date2[2];

    if ($("#nomorPengajuan").val() == null || $("#nomorPengajuan").val() == "") {
        errorIndex = showErrorTextOnField("nomorPengajuan");
    }
    if ($("#dateStart").val() == null || $("#dateStart").val() == "") {
        errorIndex = showErrorTextOnField("dateStart");
    }
    if ($("#dateEnd").val() == null || $("#dateEnd").val() == "") {
        errorIndex = showErrorTextOnField("dateEnd");
    }
    if ($("#dateEnd").val() == null || $("#dateEnd").val() == "") {
        errorIndex = showErrorTextOnField("dateEnd");
    }
    if ($("#idAlasanCuti").val() == null || $("#idAlasanCuti").val() == "") {
        errorIndex = showErrorTextOnField("idAlasanCuti");
    }

    if(new Date(endData) < new Date(starDate)){
        errorIndex = showErrorTextOnField("dateEnd", "* Tanggal harus lebih besar dari tanggal dari");
    }

    return errorIndex;
}

function showErrorTextOnField(attr, dateErrorMesg = null) {
    var errorIndex;
    var element = $("#" + attr);
    element.closest(".form-group").addClass("has-error");
    $(".text-danger." + attr).text(dateErrorMesg == null ? "* Field tidak boleh kosong" : dateErrorMesg);
    return errorIndex = 1;
}

function getDataValue() {
    var params = new Object();
    var data = new Object();

    data.nomorPengajuan = $("#nomorPengajuan").val();
    data.dateStart = $("#dateStart").val();
    data.dateEnd = $("#dateEnd").val();
    data.alasanCuti = $("#idAlasanCuti").val();
    data.cutiNoreg = $("#cutiNoreg").val();
    data.cutiName = $("#cutiName").val();
    data.cutiDivision = $("#cutiDivision").val();
    data.cutiPosition = $("#cutiPosition").val();

    params.data = data;
    return params;
}

function processWithAjax(getData, linkURL) {
    $.ajax({
        type: "POST",
        url: linkURL,
        dataType: 'json',
        data: getData,
        success: function (data) {
            if(data.status){
                swal({
                    title: "Great!",
                    text: "Pengajuan cuti berhasil diproses",
                    showConfirmButton: true,
                    confirmButtonColor: '#00BFFF',
                    type: "success"
                },
                function () {
                    window.location.href = site_url+"PersetujuanCuti";
                });
                $("#formPengajuan").removeClass('sk-loading');
                $("#dateStart, #dateEnd").prop('disabled', false).css('opacity','1');
                $("#btnAjukanCuti").text('Ajukan Permohonan Cuti').prop('disabled', false);
            }else{
                swal('Oopps', 'There are somethings error', 'error');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus, "Error: " + errorThrown); 
            console.log(XMLHttpRequest);
        } 
    });
}
