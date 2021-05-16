var tableList;

$(document).ready(function(){
    init_SmartWizard();
    popUpProgressShow();
    tableList = $('#tableCeklistDoc').DataTable({
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "scrollX": true,
        "scrollY": 250,
        "scrollCollapse": true,
        "pagingType": "input",
        "ajax": {
            "url": site_url + "MainMenu/getDataList",
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
            "targets": [1, 2, 3, 4, 5, 6, 7], 
            "orderable": false, 
        }],
        "initComplete": function (settings, json) {
            popUpProgressHide();
        },
    });

    $(document).on("click", "#btnCeklist", function(){
        $(".stepContainer").css("min-height", "245px");
        $("#id_babp").val($(this).data("id"));        
        $('#wizard .wizard_steps li:not(:first) a').attr("isdone", 0).removeClass().addClass('disabled');
        $("input[type=checkbox]").prop("checked", false).val("");
        $("#modalMainMenu textarea, .idNote").val("");
        $(".idNote").val("");
        getChecklistData($(this).data("id"));
    });

    $("#modalMainMenu").on("hidden.bs.modal", function () {        
        $("#wizard").smartWizard("goToStep", 1);
        $('#wizard .wizard_steps li:first a').removeClass().addClass('selected').attr("isdone", 0);
        $('#wizard .wizard_steps li:not(:first) a').attr("isdone", 0).removeClass().addClass('disabled');
        tableList.ajax.reload(); 
    });

    $(".buttonNext, .buttonPrevious").on("click", function(){
        processCheckData(false)
    });

    $(".buttonFinish").on("click", function(){
        processCheckData(true)
    })

    $("#btnAddBabp").on("click", function(){
        $("#modalAddBabp").modal("show");
        $(".form-group").removeClass("has-error");
        $(".text-danger").text('');
        $('#formAddEdit')[0].reset();
    });

    $('.date_babp .input-group.date').datepicker({
        format: 'd M yyyy',
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $("#btnSubmit").on("click", function(){
        var method = null;
        var validation = validate();
        if (validation != 1) {
            var url = site_url + "MainMenu/AddDataBabp";
            $('#btnSubmit').text('Saving...').prop("disabled", true);
            method = 'ADD';
            processWithAjax(getDataValue(null, method), url, null, null, method);
        }
    });

    $(document).on("keyup",
        "#no_babp,"+
        "#app," +
        "#company", function () {
            clearOnKeyDown(this);
    });

    $(document).on("change", "#date_babp", function(){
        clearOnKeyDown(this);
    });

    $(document).on("click", "#btnDelete", function(){
        var data = new Object();
        var method = "DELETE";

        data.ID = $(this).data("id");
        var url = site_url + "MainMenu/deleteDataBabp";
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
               processWithAjax(data, url, null, null, method);
           }
       });
    });
});

function init_SmartWizard() {

    if (typeof ($.fn.smartWizard) === 'undefined') { return; }

    $('#wizard').smartWizard({enableFinishButton: true});

    $('.buttonNext').addClass('btn btn-sm btn-success');
    $('.buttonPrevious').addClass('btn btn-sm btn-primary');
    $('.buttonFinish').addClass('btn btn-sm btn-info');

};

function processCheckData(isFinish){
    currentIndex = $('#wizard .wizard_steps li a.selected .step_no').text();
    processWithAjax(getDataValue(currentIndex, null), site_url + "MainMenu/saveCheklist", currentIndex, isFinish, null);
}

function getDataValue(index, method) {
    var params = new Object();
    var data = new Object();

    if(method != null){
        data.NO_BABP = $("#no_babp").val();
        data.TANGGAL_BABP = $("#date_babp").val();
        data.APP = $("#app").val();
        data.PERUSAHAAN = $("#company").val();
    }else{
        data.ID = $("#idNote_" + index).val();
        data.ID_BABP = $("#id_babp").val();
        data.ID_LIST = $("#id_list_" + index).val();
        data.NOTE = $("#note_" + index).val();
        data.checkList = [];

        $('.checkbox_idList_'+ index +':checked').each(function () {
            var eachData = new Object();
            eachData.ID = $(this).val();
            eachData.ID_LIST = data.ID_LIST;
            eachData.ID_BABP = data.ID_BABP;
            eachData.ID_SUBLIST = $(this).data("sublist");
            data.checkList.push(eachData);
        });
    }
    
    params.data = data;
    return params;
}

function processWithAjax(getData, linkURL, currentIndex, isFinish, method) {
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
                if(method != null){
                    if(method == "ADD"){
                        if(data.isExsistBabp){
                            $("#no_babp").closest(".form-group.no_babp").addClass("has-error");
                            $(".text-danger.no_babp").text("Nomor BABP " + getData.data.NO_BABP + " sudah ada !");
                        }else{
                            swal("Great!", data.message, "success");
                            $("#modalAddBabp").modal("hide");                 
                        }
                        changeTextButton(method);
                    }else{
                        swal("Great!", data.message, "success");
                    }
                    tableList.ajax.reload(); 
                } else{
                    if(isFinish){                    
                        $("#modalMainMenu").modal("hide");
                    }else{                        
                        $("#idNote_" + currentIndex).val(data.ID_NOTE);
                        $(".checkbox_idList_" + currentIndex).prop("checked", false).val("");
                        if(data.checkList.length == 0){
                            $("#wizard .wizard_steps a[rel="+ currentIndex +"]").removeClass().addClass("disabled").attr("isdone", 0);
                        }else{
                            for(var y = 0; y < data.checkList.length; y++){
                                $(".checkbox_idList_"+ currentIndex +"#checkbox_check_" + data.checkList[y].ID_SUBLIST)
                                .prop("checked", true)
                                .val(data.checkList[y].ID);
                            }
                        }
                    }
                } 
            }
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
    }
}

function getChecklistData(id){
    popUpProgressShow();
    $.ajax({
        type: "POST",
        url: site_url + "MainMenu/getChecklistDataById",
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
    $("#modalMainMenu").modal("show");

    for(var x = 0; x < data.length; x++){
        $("#idNote_" + (x + 1)).val(data[x].ID);
        $("#note_" + (x + 1)).val(data[x].NOTE);

        for(var y = 0; y < data[x].checkList.length; y++){
            $("#checkbox_check_" + data[x].checkList[y].ID_SUBLIST).val(data[x].checkList[y].ID);
            $("#checkbox_check_" + data[x].checkList[y].ID_SUBLIST).prop("checked", true);
        }
        if(data[x].checkList.length != 0 && x != 0){            
            $("#wizard .wizard_steps a[rel="+ (x + 1) +"]").removeClass().addClass("done").attr("isdone", 1);
        }
    }
}

function validate(){
    var errorIndex = 0;
    if ($("#no_babp").val() == null || $("#no_babp").val() == "" || $("#no_babp").val() == undefined) {
        errorIndex = showErrorTextOnField("no_babp", "no_babp", null);
    }
    if ($("#date_babp").val() == null || $("#date_babp").val() == "" || $("#date_babp").val() == undefined) {
        errorIndex = showErrorTextOnField("date_babp", "date_babp", null);
    }
    if ($("#app").val() == null || $("#app").val() == "" || $("#app").val() == undefined) {
        errorIndex = showErrorTextOnField("app", "app", null);
    }
    if ($("#company").val() == null || $("#company").val() == "" || $("#company").val() == undefined) {
        errorIndex = showErrorTextOnField("company", "company", null);
    }
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

function clearOnKeyDown(element) {
    $(element).closest(".has-error").removeClass("has-error");
    $(".text-danger." + $(element).attr("id")).text("");
}