	var save_method;
	var tableEmployee, tableDivision, tablePosition;

	Dropzone.autoDiscover = false;
	$(document).ready(function () {

		if(id_position == 1 || id_position == 2){
			//tableEmployee
			tableEmployee = $('#tableEmployee').DataTable({

				// "responsive": true,
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
				"scrollX": true,
				"scrollY": 250,
				"scrollCollapse": true,
				"pagingType": "input",

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": site_url + "MainPage/list_employee",
					"type": "POST",
					"error": function (XMLHttpRequest, textStatus, errorThrown) {
						console.log("Status: " + textStatus, "Error: " + errorThrown);
						console.log(XMLHttpRequest);
					}
				},
				"language": {
					"infoFiltered": ""
				},

				//Set column definition initialisation properties.
				"columnDefs": [{
					"targets": [1, 8], //last column
					"orderable": false, //set not orderable
				}, ],
				"initComplete": afterReload,

			});
		}
		if(id_position == 1){
			//tableDivision
			tableDivision = $('#tableDivision').DataTable({
				"processing": true, 
				"serverSide": true, 
				"order": [],
				"scrollX": true,
				"scrollY": 135,
				"scrollCollapse": true,
				"pagingType": "input",
				"ajax": {
					"url": site_url + "MainPage/list_division",
					"type": "POST"
				},
				"columnDefs": [{
					"targets": [2, 3],
					"orderable": false,
				}, ],
				"initComplete": afterReload,

			});

			//tablePosition
			tablePosition = $('#tablePosition').DataTable({
				"processing": true, 
				"serverSide": true, 
				"order": [],
				"scrollX": true,
				"scrollY": 135,
				"scrollCollapse": true,
				"pagingType": "input",
				"ajax": {
					"url": site_url + "MainPage/list_position",
					"type": "POST"
				},
				"columnDefs": [{
					"targets": [1, 2, 3],
					"orderable": false,
				}, ],
				"initComplete": afterReload,

			});
		}

		$("#passContent input," +
		  "#modalAddEmployee input, " + 
		  "#modalAddEditDivision input, " +
		  "#modalEditOccupation input, " +
		  "#modalAddEmployee select, " +
		  "#modalAddEditDivision select, " +
		  "#modalEditOccupation select").change(function(){
	        $(this).parents(".form-group").removeClass('has-error');
			$(this).next().empty();
			$(this).closest('.fileinput').next().next().empty();
	    });

		$('#checkbox4').on('click', function () {
			var x = document.getElementById('newpass');
			var y = document.getElementById('oldpass');
			var z = document.getElementById('confirm');
			if (x.type === "password" && y.type === "password" && z.type === "password") {
				x.type = "text";
				y.type = "text";
				z.type = "text";
			} else {
				x.type = "password";
				y.type = "password";
				z.type = "password";
			}
		});

		$('#btnChangePhoto').on('click', function () {
			$('#modalChangePhoto').modal('show');
			$('#btnUpdatePhoto').remove();
			if(photo != 'noimage.png'){
				$('#modalChangePhoto .modal-footer').prepend('<button type="button" id="btnUpdatePhoto" class="btn btn-info">Hapus Foto Saat Ini</button>');
			}
		});

		$(document).on('click', '#btnUpdatePhoto', function(){
			$.ajax({
				url: site_url+'MainPage/removeCurrentPhoto',
				type: 'POST',
				dataType: 'JSON',
				success:function(result){
					photo = result.photo;
					if(result.status){
						onSuccessPhoto(result.photo);
					}else{
						alert(result.msg);
					}
				}
			});
		});

		$('#addEmployee').on('click', function(){
			$('#modalAddEmployee').modal('show');
			$('#empAddEditForm')[0].reset(); 
			$("#titleAddEditEmp").text('Add Employee')
			$(".form-group").show();
			$("#empPosition option[value=2]").show();
			$("#picList").remove();
			removeError();
			save_method = 'ADD';
		});

		$(document).on('click', '#btnEditEmp', function(){
			$('#empAddEditForm')[0].reset(); 
			$('#modalAddEmployee').modal('show');
			$("#titleAddEditEmp").text('Edit Employee');
			$("#empPassword").closest('.form-group').siblings('.form-group').hide();
			$("#empNoreg").val($(this).attr('data-noreg'));
			$("#picList").remove();
			if($(this).attr('data-position') == 4){
				var idPic = $(this).attr('data-idpic');
				createPicDropDown("empPassword");
				$.ajax({
					type: "POST",
					url : site_url + "MainPage/onChangePosition",
					dataType: "JSON",
					data: {division : $(this).attr('data-division')},
					success: function(data){
						for(var i = 0; i < data.listPic.length; i++){
							$('#listPic').append($("<option/>", {
								value: data.listPic[i].noreg,
								text : data.listPic[i].name
							}));
						}
						$("#listPic").val(idPic);
					}
				});
			}
			removeError();
			save_method = 'EDIT';
		});

		$(document).on('click', '#addDivision', function(){
			$('#addEditDivisionForm')[0].reset(); 
			$('#modalAddEditDivision').modal('show');
			$("#titleDivisionForm").text('Add Division');
			$("#divisionId").prop("disabled", false);
			removeError();
			save_method = 'ADD';
		});

		$(document).on("click", "#btnEditDivision", function(){
			$('#addEditDivisionForm')[0].reset(); 
			$('#modalAddEditDivision').modal('show');
			$("#titleDivisionForm").text('Edit Division');
			$("#divisionId").val($(this).attr('data-id')).prop("disabled", true);
			$.ajax({
				type: "POST",
				url : site_url + "MainPage/getDivisionById",
				dataType: "JSON",
				data: {id : $(this).attr('data-id')},
				success: function(data){
					$("#divisionName").val(data);
				}
			});	
			removeError();
			save_method = 'EDIT';
		});

		$(document).on('click', '#btnEditOccupation', function(){
			$('#editOccupationForm')[0].reset(); 
			$("#titleOccupationForm").text('Edit Position');
			$("#modalEditOccupation").modal("show");
			$("#occupationId").val($(this).attr('data-id'));
			$("#occupationName").val($(this).attr('data-position'));
			removeError();
			save_method = 'EDIT';
		});

		$(document).on('click', '#btnDeleteEmp', function(){
			var data = new Object();
			var url = site_url + "MainPage/deleteEmp";
			data.noreg = $(this).attr('data-noreg');
			swal({
				title: "Delete",
				text: "Want to delete the record?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Delete",
				cancelButtonText: "Cancel",
				closeOnConfirm: false,
				closeOnCancel: false
			},
		   function (isConfirm) {
			   if (isConfirm) {
				   processWithAjax(data, url, "DELETE", "Employee");
			   } else {
				   swal("Cancelled", "Cancel on deleting data", "error");
			   }
		   });
		});

		$("#submitEmpForm").on('click', function(){
			beforeSendToAjax("Employee", site_url + "MainPage/addEditEmployee");
		});

		$("#submitDivsForm").on('click', function(){
			beforeSendToAjax("Division", site_url + "MainPage/addEditDivision");
		});

		$("#submitOccForm").on('click', function(){
			beforeSendToAjax("Occupation", site_url + "MainPage/EditOccupation");
		});

		$(document).on("click", ".picText", function(){
			var noreg = $(this).attr('data-noreg');
			var currentPic = $(this).attr('data-picnoreg');
			$(this).hide();
			$(this).after("<select class='form-control' data-noreg=" + noreg + " id='picSelect' style='width: 100px;'><option> -- Choose PIC -- </option></select>")
			$("#picSelect").prop("disabled", true);
			$.ajax({
				type: "POST",
				url : site_url + "MainPage/onChangePosition",
				dataType: "JSON",
				data: {division : $(this).attr('data-division')},
				success: function(data){
					if(data.listPic.length != 0){
						for(var i = 0; i < data.listPic.length; i++){
							$('.form-control[data-noreg="' + noreg + '"]').append($("<option/>", {
								value: data.listPic[i].noreg,
								text : data.listPic[i].name,
							}));
						}
					}
					$("#picSelect").prop("disabled", false);
					$('.form-control[data-noreg="' + noreg + '"]').val(currentPic);
				}
			});
		});

		$(document).on('keypress', '#picSelect', function(e){
			var key = e.which;
			var noreg = $(this).attr('data-noreg');
			var picName = $('.form-control[data-noreg="' + noreg + '"] option:selected').text();
			var picNoreg = $('.form-control[data-noreg="' + noreg + '"]').val();
			$(this).prop('disabled', true);
			if(key == 13){
				$('.form-control[data-noreg="' + noreg + '"]').focusout();
				$.ajax({
					type: "POST",
					url : site_url + "MainPage/changePicStaff",
					dataType: "JSON",
					data: {noreg : noreg, pic : $('.form-control[data-noreg="' + noreg + '"]').val()},
					success:function(data){
						$('.form-control[data-noreg="' + noreg + '"]').remove();
						$(".picText[data-noreg='" + noreg + "']").show().text(picName).attr('data-picnoreg', picNoreg);
					}
				}); 
			}
		});

		$(document).on('change', '#empDivision', function(){
			var divisionId = $(this).val();
			$("#empPosition").val('').prop("disabled", true);
			$("#picList").remove();
			$("#empPosition option").show();
			$.ajax({
				type: "POST",
				url : site_url + "MainPage/onChangeDivision",
				dataType: "JSON",
				data: {division : $(this).val()},
				success:function(data){
					if(data.isHaveManager){
						$("#empPosition option[value=2]").hide();
						if(divisionId == 'DK'){
							$("#empPosition option[value=3]").hide();
						}
					}else{
						if(data.listPic.length == 0){
							$("#empPosition option[value=2]").show();
							$("#empPosition option[value!=2]").hide();
						}
					}
					$("#empPosition").prop("disabled", false);
				}
			}); 
		});

		$(document).on("change", "#empPosition", function(){
			$("#picList").remove();
			if(($(this).val() == 4) && ($("#empDivision").val() != 'DK')){
				createPicDropDown($(this).attr('id'));
				$("#listPic").prop("disabled", true);
				$.ajax({
					type: "POST",
					url : site_url + "MainPage/onChangePosition",
					dataType: "JSON",
					data: {division : $("#empDivision").val()},
					success: function(data){
						if(data.listPic.length != 0){
							for(var i = 0; i < data.listPic.length; i++){
								$('#listPic').append($("<option/>", {
									value: data.listPic[i].noreg,
									text : data.listPic[i].name
								}));
							}
						}else{
							$('#listPic').append($("<option/>", {value: "", text : "-- No PIC --"}));
						}
						$("#listPic").prop("disabled", false);
					}
				});
			}else{
				$("#picList").remove();
			}
		});

		if(id_position == 1){
			$(document).on('click', '.label-status', function(){
				$(this).parents('#listEmpSection').addClass('sk-loading');
				var noregEmp = $(this).parent().siblings().eq(0).text();
				var statusEmp = $(this).attr('status');
				var id = $(this).attr('id');
				$.ajax({
					type: "POST",
					url : site_url + "MainPage/changeEmpStatus",
					dataType: "JSON",
					data: {noreg : noregEmp, status : statusEmp},
					success:function(data){
						if(data.status){
							$('#' + id)
								.removeClass((statusEmp == 0 ? 'label-default' : 'label-primary'))
								.addClass((statusEmp == 0 ? 'label-primary' : 'label-default'))
								.text((statusEmp == 0 ? 'Aktif' : 'Nonaktif'))
								.attr('status', (statusEmp == 0 ? 1 : 0));
	
							$('#listEmpSection').removeClass('sk-loading');
						}else{
							swal("Oopps!", "There are somethings wrong", "error");
						}
					}
				});
			});
		}

		$("#change_pass").unbind('submit').bind('submit', function () {
			var form = $(this);
			$("#passContent").addClass('sk-loading');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success: function (response) {
					if (response.success == true) {
						swal({
								title: "Great!",
								text: "Password berhasil diubah, anda akan segera logout",
								showConfirmButton: true,
								confirmButtonColor: '#00BFFF',
								type: "success"
							},
							function () {
								window.location.href = site_url + "MainPage/logout";
							});
					} else {
						$.each(response.messages, function (index, value) {
							var element = $("#" + index);

							$(element)
								.closest('.form-group')
								.removeClass('has-error')
								.removeClass('has-success')
								.addClass(value.length > 0 ? 'has-error' : 'has-success')
								.find('.text-danger').remove();

							$(element).after(value);

						});
					}
					$("#passContent").removeClass('sk-loading');
				} 
			}); 

			return false;
		});

		$("#btnBasicProfile").on('click', function(){
			var validation = validate('basicProfile');
			var url = site_url + 'MainPage/editBasicProfile';
			if (validation != 1) {
				$('#btnBasicProfile').text('Saving...');
				processWithAjax(getDataValue('Edit', 'basicProfile'), url, 'Edit', 'basicProfile');
			}
		});
	});

	function createPicDropDown($id){
		$("#" + $id).closest(".form-group").after(`
			<div class="form-group" id="picList"><label class="col-lg-2 control-label">PIC</label>
				<div class="col-lg-10">
					<select name="nListPic" id="listPic" class="form-control"></select>
					<small class="text-danger listPic"></small>
				</div>
			</div>
		`);
	}

	function removeError(){
		$(".form-group").removeClass("has-error");
		$(".text-danger").text('');
	}

	function onSuccessPhoto(fileName){
		swal("Success", "Foto profile berhasil diupdate !", "success");
		$("#profileImage").attr('src', site_url + 'assets/img/empPhoto/' + fileName);
		$("#profileSidebar").attr('src', site_url + 'assets/img/empPhoto/' + fileName);
		$('#modalChangePhoto').modal('hide');
		if(id_position == 1){
			tableEmployee.ajax.reload(afterReload);
		}
	}

	function validate(formType) {
		var errorIndex = 0;
		if(formType == "Employee"){
			var email = $("#empEmail").val();
			if (($("#empName").val() == null || $("#empName").val() == "") && $("#empName").closest('.form-group').css('display') != "none") {
				errorIndex = showErrorTextOnField("empName");
			}
			if (($("#empUsename").val() == null || $("#empUsename").val() == "") && $("#empUsename").closest('.form-group').css('display') != "none") {
				errorIndex = showErrorTextOnField("empUsename");
			}
			
			if (($("#empEmail").val() == null || $("#empEmail").val() == "") && $("#empEmail").closest('.form-group').css('display') != "none") {
				errorIndex = showErrorTextOnField("empEmail");
			}else if(!validateEmail(email) && $("#empEmail").closest('.form-group').css('display') != "none"){
				errorIndex = showErrorTextOnField("empEmail", "* " + email + " is not valid email!");
			}

			if (($("#empPosition").val() == null || $("#empPosition").val() == "") && $("#empPosition").closest('.form-group').css('display') != "none") {
				errorIndex = showErrorTextOnField("empPosition");
			}
			if (($("#empDivision").val() == null || $("#empDivision").val() == "") && $("#empDivision").closest('.form-group').css('display') != "none") {
				errorIndex = showErrorTextOnField("empDivision");
			}
			if (($("#listPic").val() == null || $("#listPic").val() == "") && $("#listPic").length == 1) {
				errorIndex = showErrorTextOnField("listPic");
			}
			if ($("#empPassword").val() == null || $("#empPassword").val() == "") {
				errorIndex = showErrorTextOnField("empPassword");
			}
			if (($("#empSignature").val() == null || $("#empSignature").val() == "") && $("#empSignature").closest('.form-group').css('display') != "none") {
				errorIndex = showErrorTextOnField("empSignature");
			}
		}else if(formType == "Division"){
			if ($("#divisionId").val() == null || $("#divisionId").val() == "") {
				errorIndex = showErrorTextOnField("divisionId");
			}
			if ($("#divisionName").val() == null || $("#divisionName").val() == "") {
				errorIndex = showErrorTextOnField("divisionName");
			}
		}else if(formType == "Occupation"){
			if ($("#occupationName").val() == null || $("#occupationName").val() == "") {
				errorIndex = showErrorTextOnField("occupationName");
			}
		}else{
			if ($("#nameEmpDashboard").val() == null || $("#nameEmpDashboard").val() == "") {
				errorIndex = showErrorTextOnField("nameEmpDashboard");
			}
			if ($("#usernameEmpDashboard").val() == null || $("#usernameEmpDashboard").val() == "") {
				errorIndex = showErrorTextOnField("usernameEmpDashboard");
			}
			if ($("#emailEmpDashboard").val() == null || $("#emailEmpDashboard").val() == "") {
				errorIndex = showErrorTextOnField("emailEmpDashboard");
			}else if(!validateEmail($("#emailEmpDashboard").val())){
				errorIndex = showErrorTextOnField("emailEmpDashboard", "* " + $("#emailEmpDashboard").val() + " is not valid email!");
			}
		}
		return errorIndex;
	}

	function showErrorTextOnField(attr, msg = null) {
		var errorIndex;
		var element = $("#" + attr);
		// swal("Oopps!", "There are some empty fields", "error");
		element.closest(".form-group").addClass("has-error");
		$(".text-danger." + attr).text(msg != null ? msg : "* Field tidak boleh kosong");
		return errorIndex = 1;
	}

	function beforeSendToAjax(formType, url){
		var method = null;
		var validation = validate(formType);
		if (validation != 1) {
			if (save_method == 'ADD') {
				$('#submitEmpForm, #submitDivsForm, #submitOccForm').text('Saving...');
				method = 'Add';
			} else {
				$("#submitEmpForm, #submitDivsForm, #submitOccForm").text("Updating...");
				method = 'Edit';
			 }
			 processWithAjax(getDataValue(method, formType), url, method, formType);
		}
	}

	function getDataValue(method, formType){
		var params = new Object();
		var data = new Object();

		if(formType == "Employee"){

			var formData = new FormData($("#empAddEditForm")[0]);
			formData.append('method', method);

			return formData;

			// data.noreg = $("#empNoreg").val();
			// data.name = $("#empName").val();
			// data.username = $("#empUsename").val();
			// data.sex = $("#empGender:checked").val();
			// data.email = $("#empEmail").val();
			// data.position = $("#empPosition").val();
			// data.division = $("#empDivision").val();
			// data.pic = $("#listPic").val();
			// data.password = $('#empPassword').val();

		}else if(formType == "Division"){

			data.id = $("#divisionId").val();
			data.description = $("#divisionName").val();

		}else if(formType == "Occupation"){

			data.id = $("#occupationId").val();
			data.position = $("#occupationName").val(); 
		}else{
			var formData = new FormData($("#empFormProfile")[0]);
			return formData;

			// data.noreg = $("#noregEmpDashboard").val();
			// data.name = $("#nameEmpDashboard").val();
			// data.username = $("#usernameEmpDashboard").val();
			// data.email = $("#emailEmpDashboard").val();
		}
		
		params.method = method;
		params.data = data;
		return params;
	}

	function processWithAjax(getData, linkURL, method, formType) {
		$.ajax({
			type: "POST",
			url: linkURL,
			dataType: 'json',
			contentType: (formType == 'Employee' || formType == 'basicProfile' ? false : 'application/x-www-form-urlencoded; charset=UTF-8'),
			processData: (formType == 'Employee' || formType == 'basicProfile' ? false : true),
			data: getData,
			success: function (data) {
				
				console.log(data.msg);
				console.log(data.msg);
				console.log(data.listDivision);
				if (data.status != true) {
					// swal("Oopps!", "There are some errors!", "error");
					$(".text-danger."+ data.class +"")
						.text(data.msg)
						.closest(".form-group").addClass("has-error");
				} else {
					swal({
						title: "Great!",
						text: "Process " + method + " " + formType + " Finish Succesfully",
						showConfirmButton: true,
						confirmButtonColor: '#00BFFF',
						type: "success"
					});
					if(formType == "Employee"){
						tableEmployee.ajax.reload(afterReload);
						$("#modalAddEmployee").modal("hide");
					}else if(formType == "Division"){
						removeOptionDivision();
						for(var i = 0; i < data.listDivision.length; i++){
							$('#empDivision').append($("<option/>", {
								value: data.listDivision[i].id,
								text : data.listDivision[i].description
							}));
						}
						tableDivision.ajax.reload(afterReload);
						tableEmployee.ajax.reload(afterReload);
						$("#modalAddEditDivision").modal("hide");
					}else if(formType == "Occupation"){
						tablePosition.ajax.reload(afterReload);
						tableEmployee.ajax.reload(afterReload);
						$("#modalEditOccupation").modal("hide");
					}else{
						var name = $("#nameEmpDashboard").val();
						var username = $("#usernameEmpDashboard").val();
						$("#profileEmpName, #nameEmpProfile").text(name);
						$("#profileEmpNameUsername").text(name + ', ' + username);
						$("#sidebarEmpUsername").text(username);
						$(".close.fileinput-exists").trigger("click");
					}
				}
				$('#submitEmpForm, #submitDivsForm, #submitOccForm, #btnBasicProfile').text('Submit');
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus, "Error: " + errorThrown);
                console.log(XMLHttpRequest);
            }
		});
	}

	function removeOptionDivision(){
		$('#empDivision option').each(function(){ 
			if($(this).val() != ""){
				$(this).remove();
			} 
		});
	}

	function validateEmail(email){
		const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  		return re.test(email);
	}

	var myDropzone = new Dropzone("#dropzoneForm", {
		paramName: "file", // The name that will be used to transfer the file
		maxFilesize: 2, // MB
		acceptedFiles: "image/jpeg,image/png,image/gif,image/jpeg",
		maxFiles: 1,
		dictDefaultMessage: '<i class="upload-icon ace-icon fa fa-cloud-upload fa-5x" style="opacity: 0.4"></i><br>\
            <span class="" style="color: #999;"><i class="ace-icon fa fa-caret-right blue" style="opacity: 0.4"></i> Drop files to upload </span> \
			<span class="smaller-80" style="color: #999;">(or click)</span> ',
		success: function (file, returnResult) {
			var data = JSON.parse(returnResult);
			photo = returnResult.filename;
			if (data.status) {
				onSuccessPhoto(data.filename);
			} else {
				alert('There are somethings wrong');
			}
		},
	});

	myDropzone.on("complete", function (file) {
		myDropzone.removeFile(file);
	});
