<style type="text/css">
    .onoffswitch {
        position: relative; width: 54px;
        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }
    .onoffswitch-checkbox {
        display: none;
    }
    .onoffswitch-label {
        display: block; overflow: hidden; cursor: pointer;
        height: 30px; padding: 0; line-height: 30px;
        border: 2px solid #E3E3E3; border-radius: 30px;
        background-color: #C9C7C7;
        transition: background-color 0.3s ease-in;
    }
    .onoffswitch-label:before {
        content: "";
        display: block; width: 30px; margin: 0px;
        background: #FFFFFF;
        position: absolute; top: 0; bottom: 0;
        right: 22px;
        border: 2px solid #E3E3E3; border-radius: 30px;
        transition: all 0.1s ease-in 0s; 
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label {
        background-color: #5F9EA0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label, .onoffswitch-checkbox:checked + .onoffswitch-label:before {
       border-color: #5F9EA0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label:before {
        right: 0px; 
    }

    /*When the modal fills the screen it has an even 2.5% on top and bottom*/
    /*Centers the modal*/
    .modal-dialog {
      margin: 2.5vh auto;
    }

    /*Sets the maximum height of the entire modal to 95% of the screen height*/
    .modal-content {
      max-height: 95vh;
      overflow: scroll;
    }

    /*Sets the maximum height of the modal body to 90% of the screen height*/
    .modal-body {
      max-height: 80vh;
    }

    .panel-body{
        max-height: 60vh;
        overflow: scroll;
    }
</style>
<script type="text/javascript">

	$(document).ready(function(){

        table = $('#assignment').DataTable({ 

            "responsive": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('backend/assignment/list_assignment')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                { 
                    "targets": [ ], //last column
                    "orderable": false, //set not orderable
                },
            ],

        });

		var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#5F9EA0', secondaryColor: '#DCDCDC'});
        //var switchery = new Switchery(elem, { color: '#5F9EA0' });

        var elem = document.querySelector('.js-switch_2');
        var switchery = new Switchery(elem, { color: '#5F9EA0', secondaryColor: '#DCDCDC'});
	});

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }


	function changeStatus(idAssignment,param) {
        $.ajax({
            url : '<?= site_url("backend/assignment/changeStatusAssignment/'+idAssignment+'/'+param+'") ?>',
            type : 'GET',
            success:function(res){
                return res;
            }
        });
        // return callback;
    }
    function forCheck(idAssignment) {
        if (document.getElementById("assignment_active"+idAssignment).checked == true) {
            $("#assignment_active"+idAssignment).prop("disabled",true);
            $("#textLoading"+idAssignment).text('loading');
            $.ajax({
                url : '<?= site_url("backend/assignment/changeStatusAssignment/'+idAssignment+'/1") ?>',
                type : 'GET',
                success:function(res){
                    if(res === 'limit') {
                        document.getElementById("assignment_active"+idAssignment).checked = false;
                        setTimeout(function(){
                            $("#assignment_active"+idAssignment).prop("disabled",false);
                            $("#textLoading"+idAssignment).text('');
                            swal({
                              title: "Ooppss! Ujian aktif sudah 10",
                              text: "Memuat ulang dalam 2 detik",
                              type: "error",
                              timer: 2000,
                              showConfirmButton: false
                            });
                            setTimeout(function() {
                                window.location ="<?= site_url('backend/assignment/') ?>"
                            },2000)
                        },1200);
                    } else {
                        setTimeout(function(){
                            $("#assignment_active"+idAssignment).prop("disabled",false);
                            $("#textLoading"+idAssignment).text('');
                            swal({
                              title: "Woohoo!",
                              text: "Status ujian berhasil diubah menjadi aktif",
                              type: "success",
                              button: true,
                            });
                        },1200);
                    };
                }
            });
        } else if(document.getElementById("assignment_active"+idAssignment).checked == false) {
            $("#assignment_active"+idAssignment).prop("disabled",true);
            $("#textLoading"+idAssignment).text('loading');
            changeStatus(idAssignment,2);
            setTimeout(function(){
                $("#assignment_active"+idAssignment).prop("disabled",false);
                $("#textLoading"+idAssignment).text('');
                swal({
                  title: "Woohoo!",
                  text: "Status ujian berhasil diubah menjadi tidak aktif",
                  type: "success",
                  button: true,
                });
            },1200);
        };
    }

    function hapus(id)
    {
       swal({
              title: "Anda yakin ?",
              text: "Data yang dihapus juga akan terhapus dari database!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Hapus",
              cancelButtonText: "Batal",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url : "<?php echo site_url('backend/Assignment/delete_assignment/')?>/"+id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            swal("Deleted!", "Data telah dihapus dari database.", "success");
                            $('#modal_form').modal('hide');
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error deleting data');
                        }
                    });
                } else {
                swal("Cancelled", "Tidak jadi menghapus data", "error");
            }
        });
    }
  
</script>