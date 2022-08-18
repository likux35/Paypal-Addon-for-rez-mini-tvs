<?php
session_start();

if (isset($_POST['submit'])) {

    $posted_data = $_POST['info'];

    $_SESSION['info'] = $posted_data;

    $posted_data_pw = $_POST['password'];

    $_SESSION['password'] = $posted_data_pw;


    switch($_POST['privs'])
    {
    	case '0':
        {
                $price = "1";      
                break;	
        }
        case '1':
        {
    		$price = "1.50"; 
                break;	
        }
        case '3':
        {
    		$price = "2"; 
                break;	
        }
        case '4':
        {
    		$price = "3"; 
                break;	
        }
        case '6':
        {
    		$price = "2.50"; 
                break;	
        }
        case '7':
        {
    		$price = "3.50"; 
                break;	
        }
        case '8':
        {
    		$price = "4.50"; 
                break;	
        }
    }

    if(!(filter_var($_POST["info"], FILTER_VALIDATE_IP)) && empty($_POST["password"])) 
    { 

        ?><html><html><div class="panel panel-default ">
        <div class="panel-body">
        <table class="table">
	<tbody>
        <tr>
        <div class="alert alert-danger" style="padding: 3px; margin-bottom: 5px;"><b>You selected privileges on NICKNAME. Please choose and type your password before your order!</b></div>
        </div>
        </table>
        </tbody>

          <div class="panel panel-default ">
	<div class="panel-heading">

		<b>Buy privileges using PayPal</b>
	</div>
	<div class="panel-body">
		
			<div class="alert alert-danger" style="padding: 3px; margin-bottom: 5px;">
			<div class="pull-left"><img src="http://saimon.lt/sms/img/important.png" style="width: 58px; height: 58px; margin-right: 5px;"></div>
			<b>*</b> For Your mistakes in FORM we are <b>NOT RESPONSIBLE</b>!<br />
			<b>*</b> Privileges activates <b>NEXT</b> map!<br />
			<b>*</b> Privileges purchase on <b>DYNAMIC IP</b> is Your <b>MISTAKE</b>, for which we are <b>NOT RESPONSIBLE</b>!<br />
		</div>

		<form id="form" method="post">
			<div class="pull-left" style="width: 48%;">
				<div class="form-group">
					<label>IP Address/Nickname<br />(<small>Your IP (maybe): <?php echo $_SERVER['REMOTE_ADDR']; ?></small>)</label>
					<input type="text" name="info" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" class="form-control" autocomplete="off" required> 
				</div>
			</div>

			<div class="pull-right" style="width: 48%;">
				<div class="form-group">
					<label>Password<br /> (<small>only FOR nickname</small>)</label>
					<input type="text" name="password" value="" class="form-control" autocomplete="off"> 
				</div>
			</div>
			<div style="clear: both;"></div>
		
			<div class="pull-left" style="width: 48%;">
				<div class="form-group">
					<label>Choose privileges</label>
					<select name="privs" class="form-control">
					<option value="0" selected> VIP - 1€ / 2 months</option>
					<option value="1" > VIP - 1.50€ / 3 months</option>
					<option disabled>---</option>
					<option value="3" > ADMIN - 2€ / 2 months</option>
					<option value="4" > ADMIN - 3€ / 3 months</option>
					<option disabled>---</option>
					<option value="6" > SADMIN - 2.50€ / 1 month</option>
					<option value="7" > SADMIN - 3.50€ / 2 months</option>
					<option value="8" > SADMIN - 4.50€ / 3 months</option>
			<select>
				</div>
			</div>
			<div style="clear: both;"></div>
			<input type="submit" name="submit" value="BUY" class="btn btn-success" style="width: 100%;" autocomplpete="off" /> 
		</form>
		</body> 
        </html>

        <?php

        break;

    }

    $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';

    $merchant_email = 'starkus.lukas@inbox.lt';

    $cancel_return = "https://".$_SERVER['HTTP_HOST'].'/sms/index.php?p=uzs-paypal';

    $success_return = "https://".$_SERVER['HTTP_HOST'].'/sms/paypal/success.php';

    $notify_url = "https://".$_SERVER['HTTP_HOST'].'/sms/paypal/ipn.php';

    ?>

    <center><img src="paypal/images/ajax-loader.gif"/><img src="paypal/images/processing_animation.gif"/></center>

    <form name="myform" action="<?php echo $paypal_url;?>" method="post">

        <input type="hidden" name="business" value="<?php echo $merchant_email;?>" />

        <input type="hidden" name="notify_url" value="<?php echo $notify_url;?>" />

        <input type="hidden" name="cancel_return" value="<?php echo $cancel_return;?>" />

        <input type="hidden" name="return" value="<?php echo $success_return;?>" />

        <input type="hidden" name="rm" value="2" />

        <input type="hidden" name="lc" value="" />

        <input type="hidden" name="no_shipping" value="1" />

        <input type="hidden" name="no_note" value="1" />

        <input type="hidden" name="currency_code" value="EUR" />

        <input type="hidden" name="page_style" value="paypal" />

        <input type="hidden" name="charset" value="utf-8" />

        <input type="hidden" name="item_name" value="Privilegiju Pirkimas" />

        <input type="hidden" name="cbt" value="Back to FormGet" /> 

        <input type="hidden" value="_xclick" name="cmd"/>

        <input type="hidden" name="amount" value="<?php echo $price ?>" />

        <script type="text/javascript">

            document.myform.submit();

        </script>

    <?php }
               
?> 
<html>
<div class="panel panel-default ">
	<div class="panel-heading">

		<b>Buy privileges using PayPal</b>
	</div>
	<div class="panel-body">
		
			<div class="alert alert-danger" style="padding: 3px; margin-bottom: 5px;">
			<div class="pull-left"><img src="http://saimon.lt/sms/img/important.png" style="width: 58px; height: 58px; margin-right: 5px;"></div>
			<b>*</b> For Your mistakes in FORM we are <b>NOT RESPONSIBLE</b>!<br />
			<b>*</b> Privileges activates <b>NEXT</b> map!<br />
			<b>*</b> Privileges purchase on <b>DYNAMIC IP</b> is Your <b>MISTAKE</b>, for which we are <b>NOT RESPONSIBLE</b>!<br />
		</div>

		<form id="form" method="post">
			<div class="pull-left" style="width: 48%;">
				<div class="form-group">
					<label>IP Address/Nickname<br />(<small>Your IP (maybe): <?php echo $_SERVER['REMOTE_ADDR']; ?></small>)</label>
					<input type="text" name="info" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" class="form-control" autocomplete="off" required> 
				</div>
			</div>

			<div class="pull-right" style="width: 48%;">
				<div class="form-group">
					<label>Password<br /> (<small>only FOR nickname</small>)</label>
					<input type="text" name="password" value="" class="form-control" autocomplete="off"> 
				</div>
			</div>
			<div style="clear: both;"></div>
		
			<div class="pull-left" style="width: 48%;">
				<div class="form-group">
					<label>Choose privileges</label>
					<select name="privs" class="form-control">
					<option value="0" selected> VIP - 1€ / 2 months</option>
					<option value="1" > VIP - 1.50€ / 3 months</option>
					<option disabled>---</option>
					<option value="3" > ADMIN - 2€ / 2 months</option>
					<option value="4" > ADMIN - 3€ / 3 months</option>
					<option disabled>---</option>
					<option value="6" > SADMIN - 2.50€ / 1 month</option>
					<option value="7" > SADMIN - 3.50€ / 2 months</option>
					<option value="8" > SADMIN - 4.50€ / 3 months</option>
			<select>
				</div>
			</div>
			<div style="clear: both;"></div>
			<input type="submit" name="submit" value="BUY" class="btn btn-success" style="width: 100%;" autocomplpete="off" /> 
		</form>
		</body>
</html>