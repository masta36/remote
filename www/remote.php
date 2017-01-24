<?php
include_once('mysql/db.php');
if (!isset($_SERVER))
{  $_GET    = &$HTTP_GET_VARS;
   $_POST    = &$HTTP_POST_VARS;
   $_ENV    = &$HTTP_ENV_VARS;
   $_SERVER  = &$HTTP_SERVER_VARS;
   $_COOKIE  = &$HTTP_COOKIE_VARS;
   $_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
}

function sleepNow(){ 
  //switch off receiver:
  irsend("SEND_ONCE","SKY", "KEY_POWER");	
  usleep(2000000);
  //switch off TV:
  irsend("SEND_ONCE","TV", "KEY_POWER");	
  usleep(2000000);
  
   //switch off Lights and TV power:
  power("1","0");	
  usleep(500000);
   power("2","0");	
  usleep(500000);
   power("3","0");		
  usleep(500000);
   power("4","1");
   usleep(500000);
  //turn on power sleeping room:
   power("5","1");
   //set TV sleep 60 min: 
   usleep(2000000);  
   $mydb = new DB_MySQL('localhost','myclock','root','root');
   $min = "60";
   $device = "5";
   $sql = "INSERT INTO myclock_listener (`device` ,`down`) VALUES ('" . $device . "', DATE_ADD(NOW(), INTERVAL " . $min . " MINUTE)) ";

   $mydb->query($sql);

   $mydb->disconnect();

   usleep(30000000);
   power("4","0");
  
}

function power($device,$command){ 
  $path = "sudo /home/pi/wiringPi/rc/rcswitch-pi/send 11111 " . $device . " " . $command . " 1 2>&1";
  if(!$handle=popen($path,"r")){
  echo ("Could not fork irsend");
  }
  $output="";
 while(!feof($handle))
 {$output = $output . fgets($handle, 1024);
 }
 pclose($handle);
 
}

function irsend($command,$remote,$key) 
{ echo $command ." - " . $remote . " - " . $key; 
if(!$handle=popen("/usr/bin/irsend $command \"$remote\" \"$key\" 2>&1","r"))
 {echo ("Could not fork irsend");
 }
 $output="";
 while(!feof($handle))
 {$output = $output . fgets($handle, 1024);
 }
 pclose($handle);
 return split("\n",str_replace("/usr/bin/irsend: ","",$output));
}

function keys($remote)
{print($remote. "<br>\n");
 $keys=irsend("list",$remote,"");
 for ($i = 0; $i < count($keys);$i++)
 {list($label,$code,$keyname)=split(" ",$keys[$i]);
  print("<a href=?remote=" . $remote .  "&key=" . $keyname . ">" . $keyname . "<br>\n");
 }
 print("<a href=remote.php>return</a>");
}

if($_GET)
{
 $remote=$_GET['remote'];
 keys($remote);
 if($_GET['key'])
 {$success=irsend("SEND_ONCE",$remote,$_GET['key']);
  for ($i = 0; $i < count($success);$i++)
  {print("<br> sent key " . $success[$i] . "<br>\n");
}}

if($_GET['device'])
 {
   power($_GET['device'], $_GET['command']);
}
if($_GET['sleep'])
 { 
   sleepNow();
}
  if($_GET['channel']){
    $channel = $_GET['channel'];
	$c = split("~",$channel);
	
	echo sizeof($c);
	for($i = 0; $i < sizeof($c); $i++){
	  $success=irsend("SEND_ONCE","SKY", $c[$i]);	
	  usleep(200000);
	}
  }
}
else
{$remotes=irsend("list","","");
 for ($i = 0; $i < count($remotes);$i++)
 {list($irsend,$remotename)=split(" ",$remotes[$i]);
  print("<a href=?remote=" . $remotename . ">" . $remotename . "<br>\n");
 }
}
?>
