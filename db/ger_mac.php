<?php 
$ipAddress=$_SERVER['REMOTE_ADDR'];

		var_dump($ipAddress);	
		$macAddr=false;
		$arp=`arp -a $ipAddress`;  // external command important

		echo $arp;

		$lines=explode("\n", $arp);

		var_dump($lines);

		foreach($lines as $line)
		{
		   $cols=preg_split('/\s+/', trim($line));
		   if ($cols[0]==$ipAddress)
		   {
		       $macAddr=$cols[1];
		   }
		}
		echo $macAddr;
?>