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

    .panel-body{
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
	    table = $('#student').DataTable({ 
	    	
	    	"responsive": true,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
        	"pageLength": 10,
	        "dom": 'Bfrtip',
	        "buttons": [{
                extend: 'print',
                title: 'Laporan Data Siswa',
                exportOptions: {
                	columns: [ 2, 3, 4, 5, 6, 7 ] //Your Colume value those you want
                }
            },
            {
                extend: 'excelHtml5',
                text: 'ExportExl',
                title: 'Laporan Data Siswa',
                exportOptions: {
                	columns: [ 2, 3, 4, 5, 6, 7 ] //Your Colume value those you want
                }
            },
            {
            	extend: 'pdfHtml5',
            	text: 'ExportPDF',
            	title: 'Laporan Data Siswa',
            	customize: function ( doc ) {
					doc.content[1].table.widths = ['20%','15%','8%','20%','30%','10%']
				},
				download:'open',
            	exportOptions: {
            		columns: [ 2, 3, 4, 5, 6, 7]
            	}
            },'copy'
	        ],

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('backend/Student/list_student')?>",
	            "type": "POST",
	            "data": function(data){
	            	 data.id_classroom = $('#id_classroom').val();//id pada tag select
	            }
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ -1 ], //last column
	            "orderable": true, //set not orderable
	        },
	        ],
	    });

	    $("input").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });

	    $('#btn-filter').click(function(){ //button filter event click
	        table.ajax.reload();  //just reload table
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
	    $('.modal-title').text('Tambah Data Siswa'); // Set Title to Bootstrap modal title
	    $('#photo-preview').hide(); // hide photo preview modal
	    $('#label-photo').text('Upload Foto'); // label photo upload
	}	

	function edit(id){
		save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#btnUpdate').attr('disabled', false);
	    $('#btnTambah').attr('disabled', true);
	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('backend/Student/get_student/')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	                $('[name="id_student"]').val(data.id_student);
	                $('[name="student_name"]').val(data.student_name);
	                $('[name="student_nis"]').val(data.student_nis);
	                $('[name="student_phone"]').val(data.student_phone);
	                $('[name="student_email"]').val(data.student_email);
	                $('[name="student_email"]').val(data.student_email);
	                $('[name="id_class"]').val(data.id_class);
	                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	                $('.modal-title').text('Edit Data Siswa'); // Set title to Bootstrap modal title

	                $('#photo-preview').show(); // show photo preview modal

	                if(data.student_photo)
	                {
	                    $('#label-photo').text('Ganti Foto'); // label photo upload
	                    $('#photo-preview div').html('<img src="'+base_url+'assets/img/foto_siswa/'+data.student_photo+'" width="40%" height="40%" class="img-responsive"><br>'); // show photo
	                }
	                else
	                {
	                    $('#label-photo').text('Upload'); // label photo upload
	                    $('#photo-preview div').text('(No Result)');
	                }

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}

	function save()
	{
	    $('#btnSave').text('Saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable 
	    var url;

	    if(save_method == 'add'){
	   		url = "<?php echo site_url('backend/Student/add_student')?>";
	   	}else{
	   		url = "<?php echo site_url('backend/Student/update_student') ?>"
	   	}

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
	                    url : "<?php echo site_url('backend/Student/delete_student/')?>/"+id,
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