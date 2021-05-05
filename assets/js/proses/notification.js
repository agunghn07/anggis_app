$(document).ready(function(){

  // load_unseen_notification();

  // load_unseen_message();

  //ketika id comment_form disubmit, maka akan menjalankan fungsi dibawahnya
  $('#comment_form').on('submit', function(event){
  event.preventDefault();
  //jika atribut id subject dan comment tidak kosong, artinya ada isinya
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   //jalankan fungsi ajax
   $.ajax({
    url: site_url+'backend/notification/insert',
    method:"POST",
    data:form_data,
    //pada saat succss, maka akan menjalankan fungsi yang ada dibawahnya
    success:function(data)
    {
     $('#comment_form')[0].reset();
     swal('Great','New message has been added','success');
     //jalankan fungsi load_unseen_notification()
     load_unseen_notification();
    }
   });
  }
  else
  {
   swal('Ooppsss!','Both fields are required','error');
  }
 });
 
//  function load_unseen_notification(view = '')
//  {
//   //jalankan fungsi ajax
//   $.ajax({
//    url: site_url+'MainPage/fetch', 
//    method:"POST",
//    data:{view:view},
//    dataType:"JSON",
//    success:function(data)
//    {
//     //pada saat success, ambil semua data array yang ada dicontroller untuk diparsing ke sini
//     $('#message').html(data.notification);
//     if(data.unseen_notification > 0)
//     {
//      $('.count').html(data.unseen_notification);
//     }
//    }
//   });
//  }

//  function load_unseen_message(view = ''){
//   $.ajax({
//     url: site_url+'MainPage/listMessage',
//     method:'POST',
//     data:{view:view},
//     dataType:'JSON',
//     success:function(data){
//       $('#chat').html(data.messages);
//       if(data.unseen_message > 0){
//         $('.count-message').html(data.unseen_message);
//       }
//     }
//   })
//  }
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });

  $(document).on('click', '#show-message', function(){
    $('.count-message').html('');
    load_unseen_message('yes');
  });
 
 //waktu halaman untuk merefresh setiap pergantian waktu
//  setInterval(function(){ 
//   load_unseen_notification();
//   load_unseen_message();
//  }, 5000);
 
});