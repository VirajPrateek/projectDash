<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../templates/forms.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<script src="../../jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>

<script>
function check(id){  //validation call
  var item=id;
$(document).ready(function()
{    
  $("#"+item).keyup(function(e)
  {   
    keyCode=e.keyCode || e.which;
    var name = $(this).val().trim(); 
    
    if(name.length > 3)
    {   
      $("#result").html('checking...');
      
      $.post("../lib/validation.php", $("#"+item).serialize())
        .done(function(data){

        $("#result").html(data.substring(0,data.indexOf('</span>'))); //display only 'upto' </span>
        
        if(keyCode==13){ //when pressed enter
          $("#result").html(data.substring(data.indexOf('<script>'))); //display 'from' <script>
        }
      });
      //for ajax equivalent see ../../ajax/index.php
        return false;   
    }
    else
    {
      $("#result").html("<span style='color:red;font-size:14px;'>Atleast 4 charcters.</span>");
    }
  });
  
});
}

function transit(id){  //animation call
  var field_id = id;
  var curr_div_id = $('#'+field_id).closest('div').prop('id');  //id of parent of current field id (which will hide)
  
   $('#'+curr_div_id).hide('slow',function(){
     $('#'+curr_div_id).next().show('slow',function(){
      $('#'+curr_div_id).next().children().focus(); //focus on child of div that is the sibling of current div
      });
   })

}

    $(function () {  //insertion call 
        $('#reg-form').on('click','#submit', function(e){ //on clicking on submit
            e.preventDefault(); //prevent default action 
            $('#4').fadeOut('slow');
            $.ajax({
                type: "POST",
                url: "../lib/insert-reg-data.php",
                data: $('#reg-form').serialize(),
                success: function(data) {
                  $('#submit').hide();
                  $('#result').html(data);
                  
                } //end success
            });
            return false;
        });
    });

</script>
</head>

<body>

<form id="reg-form" action="" method="post" autocomplete="off">
  <div id="reg_form" align="center">
  <div id="1">Hi there!<br/> What is your name?<br/>  
     <input type="text" name="name" id="name" placeholder="My name is" onfocus="check(this.id)" autofocus/>
  </div>
  
  <div id='2' style="display: none;"> Can we have your e-mail please?<br/>
    <input type="text" name="email" id="email" placeholder="My Email" onfocus="check(this.id) " />
  </div>
  
  <div id="3" style="display: none;">  Set a strong password:<br/>
    <input type="password" name="pass" id="pass" placeholder="My Password" onfocus="check(this.id)"/>
    </div>

    <div id="4" style="display: none;">Almost done!<br>Just confirming your password once<br/>
    <input type="password" name="cpass" id="cpass" placeholder="Confirm Password" onfocus="check(this.id)"/>
    </div>
    <span id="result"></span>
    </div>
</form>
</body>
<style type="text/css"> /* Why the f**k is it not working from forms.css :( ?*/
    #submit{
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
  }
  #submit:hover {
    background-color: #4CAF50;
    color: white;
}
</style>
</html>