<style type="text/css">
    .chooseAnswer {
        width: 70px;
        height: 100px;
        background-color: #737373;
        cursor: pointer;
        border-radius: 4px;
        color: white;
        font-size: 25px;
        text-align: center;
        padding-top: 30px;
    }
    .chooseAnswer.active {
        background-color: #32B61C;
    }

</style>

<script type="text/javascript">

	$(document).ready(function(){

         table = $('#question').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "order": [], //Initial no order.

            //Set column definition initialisation properties.
            "columnDefs": [
                { 
                    "targets": [ ], //last column
                    "orderable": false, //set not orderable
                },
            ],

        });

        $("#question_image").change(function(){
           readQuestion(this);// script jquery untuk preview gambar dengan id preview gambar pada tag img
        });

        $("#option_image").change(function(){
           readOption(this);// script jquery untuk preview gambar dengan id preview gambar pada tag img
        });
        
	});

    //fungsi javascript untuk proses preview gambar 
    function readQuestion(input) {
       if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#image_question').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
       }
    }

    //fungsi javascript untuk proses preview gambar 
    function readOption(input) {
       if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#image_option').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
       }
    }

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }


	function changeStatus(idAssignment,param) {
        $.ajax({
            url : '<?= site_url("AssignmentCtrl/changeStatusAssignment/'+idAssignment+'/'+param+'") ?>',
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
                url : '<?= site_url("AssignmentCtrl/changeStatusAssignment/'+idAssignment+'/1") ?>',
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
                                window.location ="<?= site_url('page/assignments') ?>"
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
                        url : "<?php echo site_url('Admin/Assignment/delete_assignment/')?>/"+id,
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

    function alphabet(data) {
        var callback = '';
        switch(parseInt(data)) {
            case 1 :
                callback = 'B';
            break;
            case 2 :
                callback = 'C';
            break;
            case 3 :
                callback = 'D';
            break;
            case 4 :
                callback = 'E';
            break;
            case 5 :
                callback = 'F';
            break;
            case 6 :
                callback = 'G';
            break;
            case 7 :
                callback = 'H';
            break;
            case 8 :
                callback = 'I';
            break;
            case 9 :
                callback = 'J';
            break;
            case 10:
                callback = "K";
                break;
            case 11:
                callback = "L";
                break;
            case 12:
                callback = "M";
                break;
            case 13:
                callback = "N";
                break;
            case 14:
                callback = "O";
                break;
            case 15:
                callback = "P";
                break;
            case 16:
                callback = "Q";
                break;
            case 17:
                callback = "R";
                break;
            case 18:
                callback = "S";
                break;
            case 19:
                callback = "T";
                break;
            case 20:
                callback = "U";
                break;
            case 21:
                callback = "V";
                break;
            case 22:
                callback = "W";
                break;
            case 23:
                callback = "X";
                break;
            case 24:
                callback = "Y";
                break;
            case 25:
                callback = "Z";
            break;
            default :
                callback = data;
            break;
        }
        return callback;
    }
  
</script>