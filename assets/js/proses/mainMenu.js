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
            "targets": [1, 2, 4, 5], 
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
        $("input[type=checkbox]").prop("checked", false);
        getChecklistData($(this).data("id"));
    });

    $("#modalMainMenu").on("hidden.bs.modal", function () {        
        $("#wizard").smartWizard("goToStep", 1);
        $('#wizard .wizard_steps li:first a').removeClass().addClass('selected').attr("isdone", 0);
        $('#wizard .wizard_steps li:not(:first) a').attr("isdone", 0).removeClass().addClass('disabled');
        tableList.ajax.reload(); 
    });

    $(".buttonNext").on("click", function(){
        processCheckData(false)
    });

    $(".buttonFinish").on("click", function(){
        processCheckData(true)
    })
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
    processWithAjax(getDataValue(currentIndex), site_url + "MainMenu/saveCheklist", isFinish);
}

function getDataValue(index) {
    var params = new Object();
    var data = new Object();

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
    params.data = data;

    return params;
}

function processWithAjax(getData, linkURL, isFinish) {
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
                if(isFinish){                    
                    $("#modalMainMenu").modal("hide");
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
    console.log(data);

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