<script type="text/javascript">
	$(document).ready(function(){

         table = $('#analytic').DataTable({ 

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
    });

	//ambil data kelas dan tipe assignment berdasarkan nama pelajaran yang dipilih pada tag select
	function find(value) {
        $("#buttonSubmit").html('Sedang mencari...');
        $("#buttonSubmit").prop('disabled',true);
        $.ajax({
        	//proses pengambilan data pada function findTypeAndClassForReport
            url : '<?= site_url("backend/result/findTypeAndClassForReport/'+value+'") ?>',
            type : 'GET',
            success:function(res){
            	//jika gagal atau data tidak ada, maka echo"failure"
                if (res === 'failure') {
                    swal({
                        title : 'Oooppss!',
                        text : 'Tidak ditemukan laporan sesuai data yang dipilih',
                        timer : 3000,
                        button : true,
                        type : 'error'
                    });
                } else {
                    var callback = $.parseJSON(res);
                    //tampilkan data type assignment pada option value dengan id = assignment type pada tag option
                    _type = '';
                    $.each(callback.dataType,function(i,v){
                        _type += '<option value="'+v.assignment_type+'">'+v.assignment_type+'</option>';
                    });
                    //tampilkan data nama kelas pada option value dengan id = id_class pada tag option
                    _class = '';
                    $.each(callback.dataClass,function(i,v){
                        _class += '<option value="'+v.id_class+'">'+v.class_name+'</option>';
                    });
                    // INJECT //
                    setTimeout(function(){
                        $("#buttonSubmit").html('<i class="fa fa-search"></i> Cari');
                        $("#buttonSubmit").prop('disabled',false);
                    	//Menampilkan data yang di get kedalam tag select
                        $("#assignment_type").html(_type);
                        $("#id_class").html(_class);
                    },700);
                };
            }
        });
    }
</script>