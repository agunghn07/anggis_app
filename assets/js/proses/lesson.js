$(document).ready(function(){
	$('#btnUpdate').attr('disabled', true);
	$("#kosong").hide();

	     //datatables
	table = $('#lesson').DataTable({ 

		"responsive": true,
	    "processing": true, //Feature control the processing indicator.
	    "serverSide": true, //Feature control DataTables' server-side processing mode.
	    "order": [], //Initial no order.

	    // Load data for the table's content from an Ajax source
	    "ajax": {
	        url: 'Lesson/daftar_pelajaran',
	        type: 'POST'
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
	        url: "Lesson/add_mapel",
	        type: form.attr('method'),
	        data: form.serialize(),
	        dataType: 'json',
	        success:function(response) {                
	            if(response.success == true) {
	                swal("Great!", "Data berhasil ditambah !", "success");
	                $('#lesson_name').val('');
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

	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}

	function resetdata(){
		$('#lesson_name').val('');
		$('#btnTambah').attr('disabled', false);
		$('#btnUpdate').attr('disabled', true);
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
	        url : "Lesson/get_mapel/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	                $('[name="id_lesson"]').val(data.id_lesson);
	                $('[name="lesson_name"]').val(data.lesson_name);
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}

	function update()
	{
	    $('#btnUpdate').text('Edit'); //change button text
	    $('#btnUpdate').attr('disabled',true); //set button disable 
	    var url;

	    url = "Lesson/update_mapel";
	   
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
	                swal("Great!", "Mata pelajaran berhasil diubah", "success")
	                $('#lesson_name').val('');
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
        function(isConfirm) {
          if (isConfirm) {
            $.ajax({
                    url : "Lesson/hapus_mapel/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        swal("Deleted!", "Data telah berhasil dihapus", "success");
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