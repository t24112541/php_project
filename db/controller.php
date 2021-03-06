<?php 
ob_start();
class controller{
	private $conn;
	function __construct($host,$user,$pass,$db){
		error_reporting(0);
		$con;
		$con=new mysqli($host,$user,$pass,$db);
		if(!$con){echo "connect error: ".$con->connect_error;}
		else{$con->set_charset("utf8");$this->conn=$con;date_default_timezone_set("Asia/Bangkok");}

	}
	function chk_session(){
		if(isset($_SESSION['u_id'])){
			$res=[
				"status"=>1,
			];
		}else{
			$res=[
				"status"=>0,
				"msg"=>"not login",
			];
		}
		return json_encode($res);
	}
	function get_mac(){
		$ipAddress=$_SERVER['REMOTE_ADDR'];
		$macAddr=false;
		$arp=`arp -a $ipAddress`;  // external command important
		$lines=explode("\n", $arp);
		foreach($lines as $line)
		{
		   $cols=preg_split('/\s+/', trim($line));
		   if ($cols[0]==$ipAddress)
		   {
		       $macAddr=$cols[1];
		   }
		}
		return $macAddr;
	}
	function rand_token(){
		return md5(rand(10,100));
	}
	function chk_connect(){
		if($this->conn->connect_error){
			$res=[
				"status"=>0,
				"msg"=>"connect error: ".$this->conn->connect_error,
			];
		}else{
			$res=[
				"status"=>1
			];
		}
		return json_encode($res);
	}
	function login($user,$pass){
		$token_id=$this->rand_token();
		$token=(isset($_COOKIE['token'])&&$_COOKIE['token']!=""?"&& p_log.log_mac=='{$_COOKIE['token']}'":"&& p_log.log_mac!='{$token_id}'");

		$que_admin=$this->conn->query("select * from p_admin where p_admin.a_username='{$user}' && p_admin.a_password='{$pass}'");
		if($que_admin->num_rows>0){
			$sh=$que_admin->fetch_assoc();
			$field_log="u_id,log_status,log_mac";
			$val_log="'{$sh['a_id']}','1','{$token_id}'";

			$que_log=json_decode(($this->insert("p_log",$field_log,$val_log)));	
			// setcookie("token",$token_id);
			$res=[
				"status"=>1,
				"id"=>$sh['a_id'],
				"name"=>$sh['a_name'],
				"lname"=>$sh['a_lname'],
				"u_status"=>"admin",
				"log_id"=>$que_log->last_id
			];
		}else{
			$que=$this->conn->query("select * from p_user where u_email='{$user}' && u_password='{$pass}' && u_status!=0");
			if($que->num_rows==1){
				$sh=$que->fetch_assoc();
				$field_log="u_id,log_status,log_mac";
				$val_log="'{$sh['u_id']}','1','{$token_id}'";

				$que_log=json_decode(($this->insert("p_log",$field_log,$val_log)));	
				$res=[
					"status"=>1,
					"id"=>$sh['u_id'],
					"name"=>$sh['u_name'],
					"lname"=>$sh['u_lname'],
					"u_status"=>$sh['u_status'],
					"log_id"=>$que_log->last_id
				];
			}else{$res=[
					"status"=>0,
					"msg"=>"ไม่พบ username password ดังกล่าว"
				];
			}		
		}
		$json=json_encode($res);
		return $json;
	}
	function regist($data){
		$field="";$i=0;$val="";

		foreach ($data as $key => $value) {
			$field.=$key;
			if($key=="u_password"){
				$val.="'".$this->re_encode($value)."'";
			}else{
				$val.="'".$value."'";
			}
			if($i!=count($data)-1){$field.=",";$val.=",";}
			$i++;
		}

		return $this->insert("p_user",$field,$val);
	}
	function insert($table,$field,$val){
		$que=$this->conn->query("insert into $table ({$field}) values ({$val})");
		if(!$que){
			$res=[
				"msg"=>"error : ".$this->conn->error,
				"status"=>0
			];
		}else{
			$res=[
				"msg"=>"success",
				"status"=>1,
				"last_id"=>$this->conn->insert_id
			];
		}return json_encode($res);

	}
	function update($table,$val,$where){
		$que=$this->conn->query("update $table set $val where $where");
		if(!$que){
			$res=[
				"msg"=>"error : ".$this->conn->error,
				"status"=>0
			];
		}else{
			$res=[
				"msg"=>"success",
				"status"=>1
			];
		}return json_encode($res);

	}
	function delete($table,$where){
		$que=$this->conn->query("delete from $table where $where");
		if(!$que){
			$res=[
				"msg"=>"error : ".$this->conn->error,
				"status"=>0
			];
		}else{
			$res=[
				"msg"=>"success",
				"status"=>1
			];
		}return json_encode($res);

	}
	function select($table,$select,$where){
		$data=[];

		$que=$this->conn->query("select $select from $table $where");
		if($que->num_rows!=0){
			foreach ($que as $key => $value) {
				$data[$key]=$value;
			}
		}else{
			$data['msg']="null";
		}
		
		return json_encode($data);
	}
	function re_encode($pass){
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
	function get_arr($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}
	// $db=new controller("localhost","root","","project_php");
	// echo $db->rand_token();
?>