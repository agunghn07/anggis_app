$(document).ready(function(){
    var tableHistory = $('#tableHistoryCuti').DataTable({
        "processing": true,
        "serverSide": true, 
        "order": [], 
        "scrollX": true,
        "scrollY": 250,
        "scrollCollapse": true,
        "pagingType": "input",
        "ajax": {
            "url": site_url + "HistoryCuti/listHistoryCuti",
            "type": "POST",
            "data": function(data){
                data.startdt = $('#dariTanggal').val();
                data.untildt = $('#sampaiTanggal').val();
            }
        },
        "language": {
            "infoFiltered": ""
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }],
        "initComplete": afterReload,
    });

    $(document).on('click', "#btnEmailDetail", function(){
        $('#listHistoryCuti').addClass('sk-loading');
        $("#displayMessage").html('');
        $.ajax({
            type: "POST",
            url: site_url + 'NotifikasiSurel/getMessage',
            dataType: 'json',
            data: { nomorCuti: $(this).attr('data-nomorcuti'), idEmail: $(this).attr('data-idemail') }, 
            success: function(data){
                $("#displayMessage").html(data.message);
                $("#modalDetailEmail").modal('show');
                $('table td').css('vertical-align', 'baseline');
                $('#listHistoryCuti').removeClass('sk-loading');
                load_unseen_notification();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus, "Error: " + errorThrown);
                console.log(XMLHttpRequest);
            }
        });
    });

    $('.input-group.date.historyCuti').datepicker({
        todayBtn: "linked",
        todayHighlight: true,
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    $("#btnSearchHistoryCuti").on('click', function(){
        tableHistory.ajax.reload();
    })

    $("#btnResetHistoryCuti").on('click', function(){
        $("#dariTanggal, #sampaiTanggal").val('');
        tableHistory.search('').draw();
    });

    $("#btnDownloadHistoryCuti").on('click', function(){
        // $('#listHistoryCuti').addClass('sk-loading');
        // $.ajax({
        //     type: "POST",
        //     url: site_url + 'HistoryCuti/printHistory',
        //     dataType: 'json',
        //     data: { startdt: $('#dariTanggal').val(), untildt: $('#sampaiTanggal').val() }, 
        //     success: function(data){
        //         console.log(data);
        //         $('#listHistoryCuti').removeClass('sk-loading');
        //     },
        //     error: function (XMLHttpRequest, textStatus, errorThrown) {
        //         console.log("Status: " + textStatus, "Error: " + errorThrown);
        //         console.log(XMLHttpRequest);
        //     }
        // });
        window.location.href = site_url + 'HistoryCuti/printHistory?startdt='+($('#dariTanggal').val()).replace('"', '')+'&untildt='+($('#sampaiTanggal').val()).replace('"','')+'';
    });
});