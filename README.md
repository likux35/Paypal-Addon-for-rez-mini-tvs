# Paypal įskiepis REZ MINI TVS sistemai ( https://github.com/Psychical/MINI-TVS )

## Instaliacija

Rekomenduojama naudoti naujausią REZ MINI TVS versiją.
- Atsidarome jūsų sms folderį einame į index.php ir randame:

```sh
switch($sPage[0])
{
	case 's': include('includes/oserv.php'); break;
	case 'l': include('includes/olist.php'); break;
	case 'b': include('includes/oback.php'); break;
	case 'o': include('includes/order.php'); break;
	default: include('includes/main.php'); break;
}						}
```
Keičiame į :

```sh
switch($sPage[0])
{
	case 's': include('includes/oserv.php'); break;
	case 'l': include('includes/olist.php'); break;
	case 'b': include('includes/oback.php'); break;
	case 'o': include('includes/order.php'); break;
	case 'u': include('includes/paypal.php'); break;
	default: include('includes/main.php'); break;
}						}
```
- Įkeliame paypal.php į includes aplankalą.
- Atsidarome paypal.php ir pasikeičiam duomenis:
```sh
switch($_POST['privs']) // nieko neikeiciam
{
	case '0': // eilutes numeris  (eilutes skaiciojasi nuo 0).
        {
                $price = "1"; // kaina      
                break;	
        }
        case '1':
        {
    		$price = "1.50"; 
                break;	
        }
	// 2 eilute yra bruksnys, todel ja praleidziame
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
}						}
```
- Eilutes (pasikeiciam kainas ir menesius):

```sh
<option value="0" selected> VIP - 1€ / 2 months</option> // eilute pirma
<option value="1" > VIP - 1.50€ / 3 months</option>
<option disabled>---</option>
<option value="3" > ADMIN - 2€ / 2 months</option>
<option value="4" > ADMIN - 3€ / 3 months</option>
<option disabled>---</option>
<option value="6" > SADMIN - 2.50€ / 1 month</option>
<option value="7" > SADMIN - 3.50€ / 2 months</option>
<option value="8" > SADMIN - 4.50€ / 3 months</option>
```
- Grįžtam atgal ir įkeliame paypal aplanką.
- Atsidarom success.php (ipn.php keisti nereikia)
- Keičiam:

```sh
switch($orderPrice) // nieko nekeiciam
{
	case '100': // SMS kaina centais
        {
        	$clientPrivileges = 'VIP'; // privilegiju tipas, turi sutapti su jusu duomenimis
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

```

- Pasikeičiam nuorodas kur yra saimon.lt į savo puslapio.
- Dėmesio ! Privilegijų trukmė imama iš jūsų bazės nustatytos su MINI TVS.
- Paypal nuoroda : http://jusupuslapis.lt/sms/index.php?p=uzs-paypal



