var tableList;
var index = 0; var sequence = 1;
var save_method = null;

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
        $('#formAddEdit')[0].reset();
        initialModal();
        btnAddDtl_onClick();
    });

    $("#checkallDetail").click(function() {
        $(".grid-checkboxDetail").prop("checked", $("#checkallDetail").is(":checked"));
    });

    $(".grid-checkboxDetail").click(function() {
        $("#checkallDetail").prop("checked", $('.grid-checkboxDetail:not(#checkallDetail)').not(
            ':checked').length == 0);
    });

    $('#btnAddDtl').click(function () {
        btnAddDtl_onClick();
    });

    $(document).on('click', '#btnDelDtl', function () {
        $('.grid-checkboxDetail').each(function () {
            if (this.checked) {
                $(this).closest("tbody tr").remove();
            }
        });

        var i = 0, seqValue = 1;

        $("#tblDetail tbody tr").each(function () {
            var input = $('<div id="txtAddEditSeq' + i + '"><span>' + seqValue + '</span></div>');
            $(this).find('td:eq(1)').html(input);
            $(this).find('td:eq(2) input').attr("id", "subDetail" + i);
            $(this).find('td:eq(2) small').attr("class", "text-danger subDetail" + i);
            i = i + 1;
            seqValue += 1;
        });
        sequence = seqValue;
        index = i;
        isGriDetailEmpty();
    });

    $("#btnSumbit").on("click", function(){
        var method = null;
        var validation = validate();
        if (validation != 1) {
            var url = "";
            if (save_method == 'ADD') {
                $('#btnAddOrUpdate').text('Saving...').prop("disabled", true);
                method = "@CommonConstant.SCREEN_MODE_ADD";
            } else {
                $("#btnAddOrUpdate").text("Updating...").prop("disabled", true);
                method = "@CommonConstant.SCREEN_MODE_EDIT";
            }
            processWithAjax(getDataValue(method), url, method);
        }
    });
});

function initialModal(){
    $(".form-group").removeClass("has-error");
    $(".text-danger").text('');
    $("tbody").removeClass("has-error");
    $('#btnDelDtl').remove();
    $("#tblDetail tbody tr").remove();
    $(".modal-body").animate({ scrollTop: 0 }, 'slow');
}

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
               '<input type="text" id="subDetail' + index + '" class="form-control input-sm" style="height: 25px;">' +
               '<small class="text-danger subDetail' + index + '"></small>' +
           '</td>' +
       '</tr>'
    );
    // onCheckEmptyField(index);
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

function validate(){
    var errorIndex = 0;
    var countTableRow = $('#tblDetail').children('tbody').children('tr').length;
    if (countTableRow == null || countTableRow == 0) {
        swal("Oopps!", "Please choose at least on data to be Part Detail List", "error");
        errorIndex = 1;
    }
    if ($("#title").val() == null || $("#title").val() == "" || $("#title").val() == undefined) {
        errorIndex = showErrorTextOnField("title", "title", null);
    }
    if ($("#title").val() == null || $("#title").val() == "" || $("#title").val() == undefined) {
        errorIndex = showErrorTextOnField("description", "description", null);
    }
    var indexTable = 1;
        $('#tblDetail').children('tbody').children('tr').each(function () {
            var subDetail = $(this).children('td').eq(2).children('input').val() 

            if (subDetail == null || subDetail == '') {
                errorIndex = showErrorTextOnField("tblDetail", "subDetail", (indexTable - 1));
            }
            indexTable++;
        });
    return errorIndex;
}

function showErrorTextOnField(attr1, attr2, i) {
    var errorIndex;
    var element = $("#" + attr2 + (attr1 == 'tblDetail' ? i : ""));
    swal("Oopps!", "There are some empty fields", "error");
    if (attr1 == 'tblDetail') {
        element.parent().addClass("has-error");
    }
    if ($("#" + attr1).attr("type") == 'radio' || $("#" + attr1).attr("type") == 'checkbox') {
        $(".labelRadio." + attr2).css({ "color": "#a94442" });
    }
    element.closest(".form-group." + attr2).addClass("has-error");
    $(".text-danger." + attr2 + (attr1 == 'tblDetail' ? i : "")).text("Field tidak boleh kosong");
    return errorIndex = 1;
}