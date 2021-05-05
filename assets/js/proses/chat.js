ChatSection(0);

fetch_user();

notification();

$(document).ready(function() {
	$('.message').keypress(function(event){
	    var keycode = (event.keyCode ? event.keyCode : event.which);
	    if(keycode == '13'){
	    	sendTxtMessage($(this).val());
	    }
	});

	$('.btnSend').click(function(){
		var message = $('#message').val();
		//console.log(message);
		sendTxtMessage(message);
	});

	$('.selectVendor').click(function(){
		ChatSection(1);
	    var receiver_id = $(this).attr('id');
		//alert(receiver_id);
		$('#ReciverId_txt').val(receiver_id);
		$('#ReciverName_txt').html($(this).attr('title'));
		$('.chat-message').html('');
		  
		GetChatHistory(receiver_id);
		unread_message(receiver_id);
	 				
	});

	$('.upload_attachmentfile').change(function(){
		
		DisplayMessage(`
			<div class="sk-spinner sk-spinner-three-bounce">
			    <div class="sk-bounce1"></div>
			    <div class="sk-bounce2"></div>
			    <div class="sk-bounce3"></div>
			</div>`);
		ScrollDown();
		
		var file_data = $('.upload_attachmentfile').prop('files')[0];
		var receiver_id = $('#ReciverId_txt').val();   
	    var form_data = new FormData();
	    form_data.append('attachmentfile', file_data);
		form_data.append('type', 'Attachment');
		form_data.append('receiver_id', receiver_id);
		
		$.ajax({
			url: site_url+'backend/chat/sendTextMessage', 
			dataType: 'json',  
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                        
			type: 'post',
			success: function(response){			
				$('.upload_attachmentfile').val('');
					GetChatHistory(receiver_id);
				},
				error: function (jqXHR, status, err) {
	 				// alert('Local error callback');
			}
		});
	});

	$('.ClearChat').click(function(){
		var receiver_id = $('#ReciverId_txt').val();
	  	$.ajax({
			//dataType : "json",
			url: 'chat-clear?receiver_id='+receiver_id,
				success:function(data)
				{
	  				GetChatHistory(receiver_id);		 
				},
				error: function (jqXHR, status, err) {
	 				// alert('Local error callback');
				}
	 	});			
	});

	
});	

function ViewAttachment(message_id){
	//alert(message_id);
	/*$.ajax({
		//dataType : "json",
  		url: 'view-chat-attachment?message_id='+message_id,
		success:function(data)
		{
  							 		 
		},
		error: function (jqXHR, status, err) {
 			 // alert('Local error callback');
		}
 	});*/
}
function ViewAttachmentImage(image_url,imageTitle){
	$('#modelTitle').html(imageTitle); 
	$('#modalImgs').attr('src',image_url);
	$('#myModalImg').modal('show');
}

function ChatSection(status){
	//chatSection
	if(status==0){
		$('#chatSection :input').attr('disabled', true);
    } else {
        $('#chatSection :input').removeAttr('disabled');
    }   
}


function ScrollDown(){
	var elmnt = document.getElementById("content");
    var h = elmnt.scrollHeight;
   $('#content').animate({scrollTop: h}, 1000);
}
window.onload = ScrollDown();

function DisplayMessage(message){
	var Sender_Name = $('#Sender_Name').val();
	var Sender_ProfilePic = $('#Sender_ProfilePic').val();
	
	var str = '<div class="chat-message right">';
			str+='<img class="message-avatar" src="'+site_url+'assets/img/foto_admin/'+Sender_ProfilePic+'" alt="">';
			str+='<div class="message" style="background-color: #F0FFFF; box-shadow: 1px 1px 1px rgba(0,0,0,0.2);">';
				str+='<strong class="message-author" href="#">'+Sender_Name+'</strong>' ;
				str+='<span class="message-date direct-chat-timestamp pull-left"></span>'; //23 Jan 2:05 pm
				str+='<span class="message-content" style="margin-top: 3px;">'+message+'</span>';
			str+='</div>';
		str+='</div>';
	$('#dumppy').append(str);
}

function sendTxtMessage(message){
	var messageTxt = message.trim();
	if(messageTxt!=''){
		//console.log(message);
 		DisplayMessage(messageTxt);
		
		var receiver_id = $('#ReciverId_txt').val();
		$.ajax({
			dataType : "json",
			type : 'post',
			data : {messageTxt : messageTxt, receiver_id : receiver_id },
			url: site_url+'backend/Chat/sendTextMessage',
			success:function(data){
  				GetChatHistory(receiver_id)		 
			},
			error: function (jqXHR, status, err) {
 				// alert('Local error callback');
			}
 		});			
		
		ScrollDown();
		$('.message').val('');
		$('.message').focus();
	}else{
		$('.message').focus();
	}
}

function GetChatHistory(receiver_id){
	$.ajax({
		//dataType : "json",
  		url: site_url+'backend/chat/getChatHistory?receiver_id='+receiver_id,
		success:function(data)
		{
  			$('#dumppy').html(data);
			ScrollDown();	 
		},
		error: function (jqXHR, status, err) {
 			// alert('Local error callback');
		}
 	});
}

function fetch_user(){
	// var receiver_id = $('.selectVendor').attr('id');
	// $.ajax({
	// 	url: site_url+'backend/chat/fetch',
	// 	method: 'post',
	// 	data: {view:view, receiver_id:receiver_id},
	// 	dataType: 'JSON',
	// 	success:function(data){
	// 		 $('.dropdown-chat').html(data.messsage);
	// 		 if(data.unseen_message > 0)
	// 		 {
	// 		  	$('.count-message').html(data.unseen_message);
	// 		 }
	// 	}
	// });
	$.ajax({
		url: site_url+'backend/chat/fetch',
		method: 'POST',
		success:function(data){
			$('#user-details').html(data);
		}
	});
}

function notification(){
	// var receiver_id = $('.selectVendor').attr('id');
	// $.ajax({
	// 	url: site_url+'backend/chat/fetch',
	// 	method: 'post',
	// 	data: {view:view, receiver_id:receiver_id},
	// 	dataType: 'JSON',
	// 	success:function(data){
	// 		 $('.dropdown-chat').html(data.messsage);
	// 		 if(data.unseen_message > 0)
	// 		 {
	// 		  	$('.count-message').html(data.unseen_message);
	// 		 }
	// 	}
	// });
	$.ajax({
		url: site_url+'backend/chat/notification',
		method: 'POST',
		success:function(data){
			$('#notifikasi').html(data);
		}
	});
}

function unread_message(receiver_id){
	$.ajax({
		url: site_url+"backend/chat/unreadMessage",
		data: {receiver_id : receiver_id},
		method: 'POST',
		success:function(){

		}
	});
}



// setInterval(function(){ 
// 	var receiver_id = $('#ReciverId_txt').val();
// 	if(receiver_id!=''){
// 		GetChatHistory(receiver_id);
// 	}
// 	notification();
// }, 5000);
