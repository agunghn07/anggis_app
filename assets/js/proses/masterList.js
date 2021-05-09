var tableList;
var index = 0; var sequence = 1;

$(document).ready(function(){
    tableList = $('#tableList').DataTable({
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "scrollX": true,
        "scrollY": 250,
        "scrollCollapse": true,
        "pagingType": "input",
        "ajax": {
            "url": site_url + "MasterList/getDataList",
            "type": "POST",
            "error": function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus, "Error: " + errorThrown);
                console.log(XMLHttpRequest);
            }
        },
        "language": {
            "infoFiltered": ""
        },
        "columnDefs": [{
            "targets": [3, 4, 5], 
            "orderable": false, 
        }]
    });

    $("#btnAddMasterList").on("click", function(){
        index = 0; sequence = 1;
        $("#titleAddEditMasterList").text('Tambah Data')
        $("#modalMasterList").modal("show");
        btnAddDtl_onClick();
    });

    $("#description").summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']]
        ]
    });

    $("#checkallDetail").click(function() {
        $(".grid-checkboxDetail").prop("checked", $("#checkallDetail").is(":checked"));
    });

    $(".grid-checkboxDetail").click(function() {
        $("#checkallDetail").prop("checked", $('.grid-checkboxDetail:not(#checkallDetail)').not(
            ':checked').length == 0);
    });
});

function btnAddDtl_onClick(flagData) {
    $('#tblDetail tbody').append(
       '<tr class="' + index + '">' +
           '<td class="text-center grid-checkbox-col">' +
               '<input type="text" class="hidden" name="" id="txtAddEditApprovalFlowId' + index + '" value="" data-detail="" /> ' +
               '<input type="checkbox" class="grid-checkboxDetail grid-checkbox-body" name="chkRowDetail" id="checkboxBody" value="" data-detail="" />' +
           '</td>' +
           '<td class="text-center">' +
               '<div id="txtAddEditSeq' + index + '"><span id="spanTextDetail">' + sequence + '</span></div>' +
           '</td>' +
           '<td>' +
               '<input type="text" id="docName' + index + '" class="form-control input-sm text-right" style="height: 25px;">' +
               '<small class="text-danger docName' + index + '"></small>' +
           '</td>' +
       '</tr>'
    );
    sequence++;
    index++;
    isGriDetailEmpty();
}

function isGriDetailEmpty() {
    $('#btnDelDtl, #emptyGridDetailData').remove();
    if ($('#tblDetail tbody tr').length == 1) {
        $('#btnDelDtl').remove();
    } else if ($('#tblDetail tbody tr').length == 0) {
        $('#tblDetail tbody').append('<tr id="emptyGridDetailData"><td colspan="5"><center>There is no data</center></td></tr>');
    } else {
        $('.divButtonDetail').append('<button id="btnDelDtl" class="btn btn-sm btn-danger" type="button">Del</button>');
    }
}