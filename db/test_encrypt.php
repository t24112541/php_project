
<form method="POST">
	<table>
		<tr>
			<td>password encode</td>
			<td><input type="text" name="password" placeholder="password encode here"></td>
		</tr>
		<tr>
			<td colspan="2"><button type="submit">encode!</button></td>
		</tr>
	</table>
</form>
<?php 
if(isset($_POST['password'])){
	echo encode($_POST['password']);
}

function encode($pass){
	error_reporting(0);
	$val=md5($pass);
	$sub=4;
	$txt=[];
	$count=0;
	$encode="";
	$submd5=(strlen($val)/$sub);

	for($i=0;$i<strlen($val);$i++){
		if($i%$submd5==0){$count++;}
		$txt[$count].=($val[$i]);

	}
	foreach ($txt as $key => $value) {
		// echo $key." ".md5($value)."<br>";
		$encode.=md5($value);
	}

	return $encode;
}


?>