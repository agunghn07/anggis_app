$(document).ready(function(){
    tblListPengajuanCuti = $('#tableListPengajuanCuti').DataTable({
        "processing": true,
        "serverSide": true, 
        "order": [], 
        "scrollX": true,
        "scrollY": 250,
        "scrollCollapse": true,
        "pagingType": "input",
        "ajax": {
            "url": site_url + "listPengajuanCuti/listPengajuan",
            "type": "POST"
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

    $(document).on('click', '#btnProsesCuti', function(){
        $("#nomorPengajuanCuti").val($(this).attr('data-nomorcuti'));
        $("#idEmailCuti").val($(this).attr('data-idemail'));
        $("#modalProcessSurel").modal('show');
    });
});