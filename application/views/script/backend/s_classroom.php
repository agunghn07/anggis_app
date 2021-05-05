<script type="text/javascript">
	var save_method;
	var table;
	var base_url = '<?php echo base_url() ?>';

	$(document).ready(function(){

		$('#btnUpdate').attr('disabled', true);

		table = $('#classroom').DataTable({ 

			"responsive": true,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('backend/Classroom/daftar_kelas')?>",
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

	   	$("input").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });

	   $("#form").unbind('submit').bind('submit', function() {
	        var form = $(this);

	        $.ajax({
	            //action dan method merupakan atribut yang ada dii tag form pada v_profile
	            url: "<?php echo site_url('backend/classroom/tambah_kelas')?>",
	            type: form.attr('method'),
	            data: form.serialize(),
	            dataType: 'json',
	            success:function(response) {                
	                if(response.success == true) {
	                    swal("Great!", "Data berhasil ditambah !", "success");
	                    $('#class_name').val('');
	                    reload_table();
	                }
	                else {
	                    //messages merupakan elemen yang sudah didefinisikan di c_profile
	                    $.each(response.messages, function(index, value) {
	                        var element = $("#"+index);

	                        $(element)
	                        .closest('.form-group')
	                        .removeClass('has-error')
	                        .removeClass('has-success')
	                        .addClass(value.length > 0 ? 'has-error' : 'has-success')
	                        .find('.text-danger').remove();

	                        $(element).after(value);

	                    });
	                }
	            } // /success
	        });  // /ajax

	        return false;
	    });        
	});

	function reload_table(){
		table.ajax.reload(null, false);
	}

	function resetdata(){
		$('#class_name').val('');
		$('#btnUpdate').attr('disabled', true);
		$('#btnTambah').attr('disabled', false);
	}

	function edit(id){
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('html, body').animate({scrollTop : 0},100);
	    $('#btnUpdate').attr('disabled', false);
	    $('#btnTambah').attr('disabled', true);
	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('backend/Classroom/get_classroom')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	                $('[name="id_class"]').val(data.id_class);
	                $('[name="class_name"]').val(data.class_name);
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}

	function update(){
		$('#btnUpdate').text('Edit'); //change button text
	    $('#btnUpdate').attr('disabled',true); //set button disable 
	    var url;

	    url = "<?php echo site_url('backend/Classroom/update_kelas')?>";
	   
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
	                swal("Great!", "Kelas berhasil diubah", "success")
	                $('#class_name').val('');
	                $('#btnUpdate').text('Edit'); //change button text
	            	$('#btnUpdate').attr('disabled', true);
	            	$('#btnTambah').attr('disabled', false);
	                reload_table();
	            }
	             else
	            {
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
		            $('#btnUpdate').text('Edit'); //change button text
		            $('#btnUpdate').attr('disabled', false); //set button disable 
		            $('#btnTambah').attr('disabled', true)
	            }
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnUpdate').text('Edit'); //change button text
	            $('#btnUpdate').attr('disabled', true); //set button disable
	            $('#btnTambah').attr('disabled', false);

	        }
	    });
	}

	function hapus(id){
		swal({
			title: "Anda yakin ?",
          	text: "Data akan tehapus secara permanen !",
          	type: "warning",
          	showCancelButton: true,
          	confirmButtonColor: "#DD6B55",
          	confirmButtonText: "Hapus",
          	cancelButtonText: "Batal",
          	closeOnConfirm: false,
          	closeOnCancel: false
		},
		function(isConfirm){
			if(isConfirm){
				$.ajax({
					url : '<?php echo site_url('backend/classroom/hapus_kelas') ?>/'+id,
					type : 'POST',
					dataType : 'JSON',
					success : function(data){
						swal('Deleted','Data kelas berhasil dihapus!','success');
						reload_table();
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert('error deleting data');
					}  
				});
			}else{
				swal('Cancelled','Tidak jadi menghapus data','error');
			}
		});
	}

</script>