<?php
include('../lib/dbh.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
   if(isset($_POST['butt'])){
    echo "hello";
   }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../templates/forms.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<script src="../../jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script>
function check(div,tocheck){

  window.div_id=div;
  window.next_div=div_id+1;
  window.item=tocheck;
$(document).ready(function()
{   
  $('#'+item).keyup(function(e)
  {   
    window.keyCode=e.keyCode || e.which;
    var check_item = $(this).val(); 
    check_item=check_item.trim();
    
    if(check_item.length > 3)
    {   
      $("#result").html("<span style='font-size: 18px'>checking...</span>");
      
      /*$.post("../lib/validation.php", $("#reg-form").serialize())
        .done(function(data){
        $("#result").html(data);
      });*/
      $.ajax({
        
        type : 'POST',
        url  : '../lib/validation.php',
        data :  $('#'+item).serialize(),
        success : function(data)
              { 
                 if(data>0) {//username already exis 
                    $('#result').html("<span style='color:brown; font-size: 12px'>Oophs! Looks like username is already in use.</span>");
                    $('#enname').css('color','red');
                    if(e.keyCode==13){
                     e.preventDefault();
                     window.alert('Cannot proceed!'); }
                    isok=false;
                   } 
                    else{ //username available
                      $('#result').html("<span style='color:green; font-size:12px'><b>Available.</b>Press Enter to proceed. </span>");
                            isok=true;
                            $('#enname').css('color','green');
                       if(keyCode==13){
                        e.preventDefault();
                        window.name=$('#enname').val();
                        window.greet= Array('', 'Hey '+name+' !','Now '+name+',', '');
                                
                        do_transition(1);

                       }
                    } 
                }
        });
        return false;
    }
    else
    {
      $("#result").html("<span style='color:red; font-size:12px'>Atleast 4 characters</span>");
    }
  }); 
});

}

function do_transition(div){
   window.div_id=div;
  window.next_div=div_id+1;
                     $('#'+div_id).hide('slow',function(){//a
                                $('#'+next_div).prepend(greet[(div_id)]+'<br>');
                                $('#'+next_div).show('slow',function(){
                                $('#'+(next_div+10)).focus();
                               });
                          })//a
           
                   $("#14").keyup(function(event){
               if(event.keyCode == 13){
             $("#submit").click();
              }
          }); 
       
    }

function insert(){
    $(function () {
        $('#form_id').on('click','#submit', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "../lib/insert-reg-data.php",
                data: $('#form_id').serialize(),
                success: function(data) {
                  
                } //end success
            });
            return false;
        });
    });
}
   </script>

<title>Register</title>
</head>
<body>
<center>
 <form id="form_id" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
 <div id="reg_form" >
    <div id='1' style="">Hi there!<br>What is your name?<br> <input id="enname" type="text" name="username" placeholder="My name is" required="required"  onchange="check(1,this.id)">
    <span id="result"></span>
    </div><br>


   <div id="2" style="display: none;">Can we have your e-mail please?<br>
        <input type="text" id='12' onchange="do_transition(2)" name="email" placeholder="My Email">
      </div>

    <div id="3" style="display: none;">You need to set a password <br> <input type="password" id="13" name="pass" onchange="do_transition(3)" placeholder="Password" >
    </div>

    <div id="4" style="display: none;">Almost done!<br>Just confirming your password once<br/><input type="password" id="14" name="cpass" placeholder="Confirm Password" onchange="">
    <input style="display: none;" type="button" name="submit" id="submit" onclick="insert()">
    </div>
   </form> 
    </div>
    <div id="5"></div>

 </center>
</body>
</html>