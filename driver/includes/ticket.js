$(function(){
  const userid = <?php echo $ticket['userId']; ?>;
  const ticketid = <?php echo $ticket['id']; ?>;
  const dataStr = 'userid='+userid+'&ticketid='+ticketid;
   setInterval(function(){
    $.ajax({
      type:'GET',
      url:'ticket_loader.php',
      data:dataStr,
      success: function(e){
        $('#ticket_load').html(e);
      }
    });
  }, 3000);
 });

 function chat_validation(){

  const message = $('#message').val();
  const repliedById = <?php echo $admin['id']; ?>;
  const ticketId = <?php echo $ticket['id']; ?>;

  if(message == ""){
   alert('Type Message....');
   return false;
  }
  const datastr = 'message='+message+'&ticketId='+ticketId+'&repliedById='+repliedById;
   $.ajax({
    url:'ticket-update.php',
    type:'POST',
    data:datastr,
    success:function(e){
      // $('#msg').html(e);
    }
  });
  document.getElementById('chatForm').reset();
  return false;
 }
