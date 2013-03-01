<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if IE]><meta http-equiv="content-type" content="text/html; charset=UTF-8" /><![endif]-->
    <meta http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
<title>
<?php echo $site_title?>
</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript">
    function check_data()
    {
        var frm=document.frmLogin;
        var user_name=frm.User_name.value;
        var password=frm.Password.value;
        var email_reg="^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$";
        var is_valid_frm=true;
        if(user_name=="")
        {
            document.getElementById("User_name_error").innerHTML="Please provide Username for Login.";
            document.getElementById("User_name_error").style.display='';
            is_valid_frm=false;
        }
        else if(!user_name.match(email_reg) && user_name!='')
        {
                document.getElementById('User_name_error').innerHTML="<span>The input for Username should be a valid email address.</span>";
                document.getElementById('User_name_error').style.display='';                
                is_valid_frm=false;
        }
        else        
            document.getElementById("User_name_error").style.display='none';
        
        if(password=="")
        {
            document.getElementById("Password_error").innerHTML="Please provide Password for Login.";
            document.getElementById("Password_error").style.display='';
            is_valid_frm=false;
        }
        else        
            document.getElementById("Password_error").style.display='none';
        if(is_valid_frm)
        {
            var frm=document.frmLogin;
            frm.action="check_login.php";
            frm.submit();
        }
        else
            return false;
    }
    function enter_pressed(e){
         var keycode;
         if (window.event) keycode = window.event.keyCode;
         else if (e) keycode = e.which;
         else return false;
         return (keycode == 13);
        }

</script>    
</head>
<body onload="document.getElementById('User_name').focus();">
<div id="container">
  <?php 
            require_once("header.php");
        ?>
  <div id="content">
    <h1>Login</h1>
    <form name="frmLogin" id="frmLogin" action="#" method="post">
      <table width="50%" border="0" cellpadding="2" cellspacing="0">
        <?php
            if(isset($_GET["msg"]) && $_GET["msg"]=="error")
            {    
                echo "<tr>";
                    echo "<td>&nbsp;</td>
                        <td><div class='alert'>Invalid Username or Password...</div></td>";
                echo "</tr>";
            }
            if(isset($_GET["msg"]) && $_GET["msg"]=="nolib")
            {
                echo "<tr>";
                    echo "<td>&nbsp;</td>
                        <td><div class='alert'>You do not have the permission to sign in with this user role. Please sign in with a Librarian user account.</div></td>";
                echo "</tr>";
            }
            if(isset($_GET["msg"]) && $_GET["msg"]=="try_later")
            {
                echo "<tr>";
                    echo "<td>&nbsp;</td>
                        <td><div class='alert'>We are currently performing maintenance. Please try to login again later.</div></td>";
                echo "</tr>";
            }
         ?>
        <tr>
          <td class="td-left">Username</td>
          <td ><input type="text" name="User_name" id="User_name" value="" size="50" maxlength="128"></input>
              <div id="User_name_error" class="alert" style="display: none;"></div>
          </td>          
        </tr>
        <tr>
          <td class="td-left">Password</td>
          <td ><input type="password" name="Password" id="Password" value="" size="50" maxlength="128" onKeyPress="if(enter_pressed(event)){ check_data() }">
            </input>
            <div id="Password_error" class="alert" style="display: none;"></div>
          </td>
        </tr>
        <tr>
          <td >&nbsp;</td>
          <td align="left"><input class="grey_button" type="button" name="Submit" value="Login" onclick="javascript:check_data()">
            </input>
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td >&nbsp;</td>
          <td colspan="2"><a href="forgot_password.php">I forgot my password</a> </td>
        </tr>  
      </table>
    </form>
  </div>
  <?php require_once("footer.php"); ?>
</div>
</body>
</html>
