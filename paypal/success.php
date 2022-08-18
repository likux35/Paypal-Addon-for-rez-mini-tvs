<?php
session_start();

include('../config/db_connect.php');

$clientIp = $_SESSION['info'];
$orderPrice = (($_REQUEST['mc_gross'])*100);
$clientPassword = $_SESSION['password'];
$orderid = $_REQUEST['transaction_subject'];


if(!($_REQUEST['payer_status']))
{
	
        echo 'Kreiptasi ne is Paypal, arba įvyko netikėta klaida. Susisiekite su administracija per skype : likux35';
        break;

 
}

switch($orderPrice)
{
	case '100':
        {
        	$clientPrivileges = 'VIP';
                break;
        }
        case '150':
        {
        	$clientPrivileges = 'VIP';               
                break;

        }
        case '200':
        {
        	$clientPrivileges = 'ADMIN';
                break;

        }
        case '300':
        {
        	$clientPrivileges = 'ADMIN';
                break;

        }
        case '250':
        {
        	$clientPrivileges = 'SUPERADMIN';
                break;

        }
        case '350':
        {
        	$clientPrivileges = 'SUPERADMIN';                
                break;

        }
        case '450':
        {
        	$clientPrivileges = 'SUPERADMIN';
                break;

        }
}


if(filter_var($clientIp, FILTER_VALIDATE_IP))
{
	$flags = 'de';
}
else
{
        $flags = 'a';
}

	
$result = $mysqli->query("SELECT * FROM `unban_makro_types` WHERE `priv_type` = '".$clientPrivileges."' AND `price` = '".$orderPrice."'");
		
if($result->num_rows)
{
	$result2 = $mysqli_amx->query("SELECT * FROM `".$amxbans_prefix."_amxadmins` WHERE `username` = '".$clientIp."'");
	$ftc = $result->fetch_object();
		
	$expired = strtotime("+".$ftc->lenght." day");
		
	if($result2->num_rows)
	{
		$mysqli_amx->query("UPDATE `".$amxbans_prefix."_amxadmins` SET `access` = '".get_acces_makro($mysqli, $clientPrivileges)."', `created` = '".time()."', `expired` = '".$expired."', `days` = '".$ftc->lenght."' WHERE `username` = '".$clientIp."'");
			
		echo 'Jūsų privilegijos sėkmingai pratęstos. Prašome palaukti, grįžtama pas pardavėją ...';
         	header('refresh:5;url=http://saimon.lt/sms/index.php?p=uzs-paypal');
        	exit;
	}
	else
	{
		$mysqli_amx->query("INSERT INTO ".$amxbans_prefix."_amxadmins (`username`, `password`, `access`, `flags`, `nickname`, `ashow`, `created`, `expired`, `days`, `steamid`, `nr`) VALUES ('".$clientIp."', '".$clientPassword."', '".get_acces_makro($mysqli, $clientPrivileges)."', '".$flags."', '".$clientIp."', '0', '".time()."', '".$expired."', '".$ftc->lenght."', '".$clientIp."', 'Paypal (".$orderid.")') ");
		$lastid = $mysqli_amx->insert_id;
			
		echo 'Jūsų privilegijos sėkmingai aktyvuotos. Prašome palaukti, grįžtama pas pardavėją ...';
		header('refresh:5;url=http://saimon.lt/sms/index.php?p=uzs-paypal');
			
		if($mysqli_amx->query("SELECT * FROM `".$amxbans_prefix."_admins_servers`"))
		{	
			while($row = $servers_lst->fetch_object())
			{						
				$local_ips = gethostbyname($row->ip).":".$row->port;
					
				$result = $mysqli_amx->query("SELECT * FROM `amx_serverinfo` WHERE `address` = '".$local_ips."' LIMIT 1");
					
				if($result->num_rows)
				{
					$ftch = $result->fetch_object();
						
					$mysqli_amx->query("INSERT INTO `".$amxbans_prefix."_admins_servers` (`admin_id`, `server_id`, `use_static_bantime`) VALUES ('".$lastid."', '".$ftch->id."', 'no')");
				}
			}
		}
			
	}
}
else
	echo 'Ivyko netikėta klaida. Nepavyko aktyvuoti privilegijų. Susisiekite su administracija per skype : likux35 arba el. paštu : info@saimon.lt';