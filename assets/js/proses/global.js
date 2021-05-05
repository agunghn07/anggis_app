$(document).ready(function () {
    load_unseen_notification();
    count_list_pengajuan_cuti();
});

function load_unseen_notification(view = '') {
    $("#message").html(`
        <li>
            <div class="text-center link-block">
                <a href="`+site_url + 'NotifikasiSurel' +`">
                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                </a>
            </div>
        </li>
    `);
    $.ajax({
        type: "POST",
		url : site_url + "MainPage/getNotif",
		dataType: "JSON",
		data: {view : view},
        success: function (data) {
            $('#message').prepend(data.notification);
            if (data.unseen_notification > 0) {
                $('#countMessage').html(data.unseen_notification);
            }else{
                $('#countMessage').html('');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus, "Error: " + errorThrown); 
            console.log(XMLHttpRequest);
        } 
    });
}

function count_list_pengajuan_cuti(){
    $.ajax({
        type: "POST",
		url : site_url + "MainPage/getCountPengajuan",
		dataType: "JSON",
        success: function (data) {
            if (data.countList > 0) {
                $('#countListPengajuanCuti').html(data.countList);
            }else{
                $('#countListPengajuanCuti').html('');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus, "Error: " + errorThrown); 
            console.log(XMLHttpRequest);
        } 
    });
}

var afterReload = function(){
    $('#listEmpSection, #listDivisionSection, #listPositionSection, #listHistoryCuti, #listPengajuanCuti').removeClass('sk-loading');
    $('table td').css('vertical-align', 'baseline');
    $("#isPrint").val(0);
};

function moveToNotifikasiSurel(element){
    window.location.href = $(element).attr('data-url');
}
