<script type="text/javascript">
	var save_method;
	var table;
	var	base_url = '<?php echo base_url(); ?>';

	$(document).ready(function(){

	    loadchart1();

	    loadchart2();
		//datatables
	    table = $('#table').DataTable({ 
	    	
	    	"responsive": true,
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('MainPage/list_admin')?>",
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

	    /*
		$("#change_basic").unbind('submit').bind('submit', function() {
        var form = $(this);

	        $.ajax({
	            //action dan method merupakan atribut yang ada dii tag form pada v_profile
	            url: form.attr('action'),
	            type: form.attr('method'),
	            data: form.serialize(),
	            dataType: 'json',
	            success:function(response) {                
	                if(response.success == true) {
	                    swal({
							title: "Sukses",
							text: "Profile berhasil diupdate!",
							showConfirmButton: true,
							confirmButtonColor: '#87CEFA',
							type:"success"
						},
						function(){
						  window.location.replace(window.location.pathname + window.location.search + window.location.hash);
						});
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
	    */ 
	    

	    $("#change_pass").unbind('submit').bind('submit', function() {
	        var form = $(this);

	        $.ajax({
	            //action dan method merupakan atribut yang ada dii tag form pada v_profile
	            url: form.attr('action'),
	            type: form.attr('method'),
	            data: form.serialize(),
	            dataType: 'json',
	            success:function(response) {                
	                if(response.success == true) {
	                    swal({
	                        title: "Great!",
	                        text: "Password berhasil diubah, anda akan segera logout",
	                        showConfirmButton: true,
	                        confirmButtonColor: '#00BFFF',
	                        type:"success"
	                    },
	                    function(){
	                      window.location.href = "<?php echo site_url('MainPage/logout'); ?>";
	                    });
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

	function loadchart1(){       
        $.ajax({
        	url:'<?php echo base_url(); ?>Mainpage/barChart/',        
        	success:function(data){ 
        	$( "#div_chart" ).html(data);
        	}
   	    });         
    }

    function loadchart2(){       
        $.ajax({
        	url:'<?php echo base_url(); ?>Mainpage/pieChart/',        
        	success:function(data){ 
        	$( "#pie_chart" ).html(data);
        	}
   	    });         
    }

  	function showhide() {
    	var x = document.getElementById("newpass");//"password" adalah id dari <input type="password" id="password">;
    	var y = document.getElementById("oldpass");//"password1" adalah id dari <input type="password" id="password">;
    	var z = document.getElementById('confirm')
    	if (x.type === "password" && y.type ==="password" && z.type ==="password") { //"password" adalah type dari <input type="password"
      		x.type = "text";
      		y.type = "text";
      		z.type = "text";
    	} else {
      		x.type = "password";
      		y.type = "password";
      		z.type = "password";
    	}
  	}

  	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}

	function add(){
		save_method = 'add';
	    $('#user')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form_user').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Tambah Data User'); // Set Title to Bootstrap modal title
	}	

  	function edit(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('MainPage/get_user/')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	                $('[name="id_admin"]').val(data.id_admin);
	                $('[name="level"]').val(data.level);
	                $('[name="status"]').val(data.status);
	                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	                $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

	                $('#photo-preview').show(); // show photo preview modal

	                if(data.avatar)
	                {
	                    $('#label-photo').text('Change Result'); // label photo upload
	                    $('#photo-preview div').html('<img src="'+base_url+'assets/img/foto_admin/'+data.avatar+'" height="220px" width="220px;" class="img-square"><br>'); // show photo
	                }
	                else
	                {
	                    $('#label-photo').text('Upload Result'); // label photo upload
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

	    if(save_method == 'add') {
	    	url = "<?php echo site_url('MainPage/add_user') ?>";

	    	// ajax adding data to database
		    var formData = new FormData($('#user')[0]);
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
		                $('#modal_form_user').modal('hide');
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
	    }else{
	        url = "<?php echo site_url('MainPage/update_user')?>";

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
		                $('#modal_form_user').modal('hide');
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
	}

	function simpan()
	{
	    $('#btnSave').text('Saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable 
	    var url;

	    save_method == 'simpan'
	    url = "<?php echo site_url('MainPage/change_basic')?>";

	    // ajax adding data to database
	    var formData = new FormData($('#change_basic')[0]);
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
                        text: "Profile berhasil diupdate !",
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
	                    url : "<?php echo site_url('MainPage/delete_user/')?>/"+id,
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