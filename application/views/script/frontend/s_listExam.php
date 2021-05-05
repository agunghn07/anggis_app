<script type="text/javascript">
	$(document).ready(function(){

		table = $('#assignment').DataTable({ 

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
</script>