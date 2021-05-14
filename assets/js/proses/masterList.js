var tableList;
var index = 0; var sequence = 1;
var save_method = null;

$(document).ready(function(){
    popUpProgressShow();
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
        }],
        "initComplete": function (settings, json) {
            popUpProgressHide();
        },
    });

    $("#btnAddMasterList").on("click", function(){
        save_method = "ADD";
        index = 0; sequence = 1;
        $("#titleAddEditMasterList").text('Tambah Data')
        $("#modalMasterList").modal("show");
        $('#formAddEdit')[0].reset();
        $("#btnSubmit").text("Save");
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

    $("#btnSubmit").on("click", function(){
        var method = null;
        var validation = validate();
        if (validation != 1) {
            var url = site_url + "MasterList/AddOrUpdateData";
            if (save_method == 'ADD') {
                $('#btnSubmit').text('Saving...').prop("disabled", true);
                method = save_method;
            } else {
                $("#btnSubmit").text("Updating...").prop("disabled", true);
                method = save_method;
            }
            processWithAjax(getDataValue(method), url, method);
        }
    });

    $(document).on("click", "#btnEdit", function(){
        var id = $(this).data("id");
        popUpProgressShow();
        save_method = "UPDATE";
        index = 0; sequence = 1;
        $("#titleAddEditMasterList").text('Edit Data')
        $("#btnSubmit").text("Update");
        initialModal();
        getEdiViewtDataById(id, save_method);
    });

    $(document).on("click", "#btnDelete", function(){
        var data = new Object();
        data.ID = $(this).data("id");
        data.Method = "DELETE";
        var url = site_url + "MasterList/deleteData";
        swal({
            title: "Caution",
            text: "Would you like to delete ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
       function (isConfirm) {
           if (isConfirm) {
               processWithAjax(data, url, data.Method);
           }
       });
    });
});

function initialModal(){
    $(".form-group").removeClass("has-error");
    $(".text-danger").text('');
    $("tbody").removeClass("has-error");
    $('#btnDelDtl').remove();
    $("#tblDetail tbody tr").remove();
    $(".modal-body").animate({ scrollTop: 0 }, 'slow');
    $("input[type=checkbox]").prop("checked", false);
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
    onCheckEmptyField(index);
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
        $('.divButtonDetail').append('<button id="btnDelDtl" class="btn btn-xs btn-outline btn-danger" type="button">Del</button>');
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

function onCheckEmptyField(i) {
    $(document).on("keyup",
        "#subDetail" + i + "," +
        "#title," +
        "#description", function () {
            clearOnKeyDown(this);
        });
}

function clearOnKeyDown(element) {
    $(element).closest(".has-error").removeClass("has-error");
    $(".text-danger." + $(element).attr("id")).text("");
}

function getDataValue(method) {
    var params = new Object();
    var data = new Object();

    data.ID = $("#idList").val();
    data.TITLE = $("#title").val();
    data.DESCRIPTION = $("#description").val();
    data.listDetail = [];

    $("#tblDetail").children('tbody').children('tr').each(function () {
        var dtl = new Object();
        var trObj = jQuery(this);

        dtl.ID = trObj.children('td').eq(0).children('input').val();
        dtl.ID_LIST = null;
        dtl.DESCRIPTION = trObj.children('td').eq(2).children('input').val();

        data.listDetail.push(dtl);
    });
    params.method = method;
    params.data = data;
    return params;
}

function processWithAjax(getData, linkURL, method) {
    popUpProgressShow();
    $.ajax({
        type: "POST",
        url: linkURL,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        dataType: 'json',
        processData: true,
        data: getData,
        success: function (data) {
            if (data.status == false) {
                swal("Ooppss!", data.message, "error");
            } else {                
                tableList.ajax.reload();
                swal({
                    title: "Great!",
                    text: data.message,
                    showConfirmButton: true,
                    confirmButtonColor: '#00BFFF',
                    type: "success"
                },
                function () {
                    if(method != "DELETE"){
                        $("#modalMasterList").modal("hide");
                    }
                });
            }
            changeTextButton(method);
            popUpProgressHide();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            popUpProgressHide();
            console.log("Status: " + textStatus, "Error: " + errorThrown);
            console.log(XMLHttpRequest);
        }
    });
}

function changeTextButton(method) {
    if (method == 'ADD') {
        $('#btnSubmit').text("Save").prop("disabled", false);
    } else if (method == 'UPDATE') {
        $('#btnSubmit').text("Update").prop("disabled", false);
    }
}

function getEdiViewtDataById(id, method) {
    $.ajax({
        type: "POST",
        url: site_url + "MasterList/getDataById",
        dataType: "JSON",
        data: { ID: id },
        success: function (data) {
            popUpProgressHide();
            onViewDataSuccess(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            popUpProgressHide();
            console.log("Status: " + textStatus, "Error: " + errorThrown);
            console.log(XMLHttpRequest);
        }
    });
}

function onViewDataSuccess(returnResult) {
    var data = returnResult;    
    $("#modalMasterList").modal("show");

    $("#idList").val(data.ID);
    $("#title").val(data.TITLE);
    $("#description").val(data.DESCRIPTION);

    for (var i = 0; i < data.listDetail.length; i++) {
        btnAddDtl_onClick();
        $("#txtAddEditApprovalFlowId" + i).val(data.listDetail[i].ID)
        $("#subDetail" + i).val(data.listDetail[i].DESCRIPTION);
    }
    isGriDetailEmpty();
}