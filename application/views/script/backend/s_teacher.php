<style type="text/css">
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
      max-height: 90vh;
    }

    .tab-content{
    	max-height: 60vh;
    	overflow: scroll;
    }
</style>
<script type="text/javascript">
	var save_method;
	var table;
	var	base_url = '<?php echo base_url(); ?>';

	$(document).ready(function(){

		//datatables
	    table = $('#teacher').DataTable({ 
	    	"responsive": true,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('backend/Teacher/list_teacher')?>",
	            "type": "POST"
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ -1 ], //last column
	            "orderable": true, //set not orderable
	        },
	        ],

	    });
	});

  	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}

	function add(){
		save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Data Guru'); // Set Title to Bootstrap modal title
	    $('#photo-preview').hide(); // hide photo preview modal
	    $('#label-photo').text('Upload Foto'); // label photo upload
	}	

	function save()
	{
	    $('#btnSave').text('Saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable 
	    var url;

	    url = "<?php echo site_url('backend/Teacher/add_teacher')?>";

	    // ajax adding data to database
	    var formData = new FormData($('#form')[0]);
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: formData,
	        contentType: false,
	        processData: false,
	        dataType: "JSON",
	        success: function(data)
	        {

	            if(data.status) //if success close modal and reload ajax table
	            {
	                swal("Great!", "Data berhasil diproses!", "success")
	                $('#modal_form').modal('hide');
	                reload_table();
	            }
	             else
	            {
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }

	            }

	            $('#btnSave').text('Save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('Save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 

	        }
	    });
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
	                    url : "<?php echo site_url('backend/teacher/delete_teacher/')?>/"+id,
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

	function change()
    {
        $('#btnChange').text('Changing'); //change button text
        $('#btnChange').attr('disabled',false); //set button disable 
        var url;
        save_method == 'ganti'
        url = "<?php echo site_url('MainPage/change_photo')?>";

        // ajax adding data to database
        var formData = new FormData($('#form2')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    swal({
                        title: "Sukses",
                        text: "Foto profile berhasil diupdate !",
                        showConfirmButton: true,
                        confirmButtonColor: '#87CEFA',
                        type:"success"
                    },
                    function(){
                        window.location.replace(window.location.pathname + window.location.search + window.location.hash);
                    });
                }
                 else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }

                }

                $('#btnChange').text('Change'); //change button text
                $('#btnChange').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Empty !", "Tidak ada file yang dipilih", "error");
                $('#btnChange').text('Change'); //change button text
                $('#btnChange').attr('disabled',false); //set button enable 

            }
        });
    }
</script>