<?php
include("config.php");
function create($port, $slots)
{
$ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{
	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
                $data['virtualserver_name'] = "Teamspeak3Server";
                $data['virtualserver_port'] = $port;
                $data['virtualserver_maxclients'] = "$slots";
			$server = $ts3->serverCreate($data);
return $server['data']['token'];
}
}


function delete($port)
{
$ts3 = new ts3admin($allg['ts3ip'], $allg['ts3qport']);
if ($ts3->getElement('success', $ts3->connect()))
{
	$ts3->login($allg['ts3user'], $allg['ts3passwort']);
		$getsid = $ts3->serverIdGetByPort($port);
			$sid = $getsid['data']['server_id'];
				$ts3->serverDelete($sid);
}
}

function checkEmail($email2) {
$regex = '/^[\w][\w-.]+@[\w-.]+\.[a-z]{2,4}$/U';
$adresse = $email2;

if (preg_match($regex, $adresse, $found))
{
    return true;
}
else
{
return false;;
} 
}

    function codegen($length=8)
    {
     
    $dummy	= array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'), array('.', ','));
     
    // shuffle array
     
    mt_srand((double)microtime()*1000000);
    for ($i = 1; $i <= (count($dummy)*2); $i++)
    {
    $swap	= mt_rand(0,count($dummy)-1);
    $tmp	= $dummy[$swap];
    $dummy[$swap]	= $dummy[0];
    $dummy[0]	= $tmp;
    }
     
    // get password
     
    return substr(implode('',$dummy),0,$length);
     
    }




function checkwegwerf($find2){
$e = explode("@", $find2);
$find = $e[1];
 $exists = FALSE;
 if(!is_array($allg['no_mail'])){
   return;
}
foreach ($allg['no_mail'] as $key => $value) {
  if($find == $value){
       $exists = TRUE;
  }
}
  return $exists;
}

function temp_header($name){
echo '		<article class="module width_full">
			<header><h3>'.$name.'</h3></header>
			<div class="module_content">';
}

function temp_footer()
{
echo '			  <div class="clear"></div>
		  </div>
		</article><!-- end of stats article -->';
}

function is_admin()
{
if($_SESSION["adminstats"] == 1)
{ 
return true;
}else{
return false;
}
}
?>