<?php
session_start();
// $_SESSION['u_id']=1010101;
// session_destroy();
	require_once("../db/controller.php");
	$db=new controller("localhost","root","","project_php");
	if(isset($_GET['login'])){
		$con_chk=json_decode($db->chk_connect());
		if($con_chk->status==1){
			$res=($db->login($_GET['u_username'],$db->re_encode($_GET['u_password'])));
			// $db->get_arr($res);
			
				echo $res;
			
		}else{
			echo $con_chk->msg;
		}
	}else if(isset($_POST['chk_sess'])){
		$res=json_decode($db->chk_session());
		if($res->status==0){
			echo $res->msg;
		}
	}else if(isset($_POST['regist'])){
		$data=[];
		
		foreach ($_POST as $key => $value) {
			if($key!="Confirm_Password" && $key!="regist" && $key!="u_password_old"){
				$data[$key]=$value;
			}
		}
		if(isset($_FILES) && $_FILES['u_img']['name']!=''){
			$filename = "../img/".date("yy-m-d_His").".jpg";
			if(move_uploaded_file($_FILES['u_img']["tmp_name"], $filename)){
				$data["u_img"]=$filename;
				// $db->get_arr($data);
			}
		}else{
			$data["u_img"]="";
		}
		echo ($db->regist($data));
	}else if(isset($_POST['load_store_type'])){
		echo $db->select("p_store_type","*","where 1");
	}else if(isset($_POST['store_type_update'])){
		echo $db->update("p_store_type","st_name='".$_POST['st_name']."'","st_id='".$_POST['st_id']."'");
	}else if(isset($_POST['store_type_del'])){
		echo $db->delete("p_store_type","st_id='".$_POST['st_id']."'");
	}else if(isset($_POST['store_type_add'])){
		echo $db->insert("p_store_type","st_name","'{$_POST['st_name']}'");
	}else if(isset($_POST['load_p_type'])){
		echo $db->select("p_type","*","where 1");
	}else if(isset($_POST['p_type_update'])){
		echo $db->update("p_type","t_name='".$_POST['t_name']."'","t_id='".$_POST['t_id']."'");
	}else if(isset($_POST['p_type_del'])){
		echo $db->delete("p_type","t_id='".$_POST['t_id']."'");
	}else if(isset($_POST['p_type_add'])){
		echo $db->insert("p_type","t_name","'{$_POST['t_name']}'");
	}else if(isset($_POST['load_p_user'])){
		echo $db->select("p_user","*","where 1");
	}else if(isset($_POST['load_p_store'])){
		if(isset($_POST['filter'])){$where="where p_store.st_id=p_store_type.st_id && p_user.u_id=p_store.u_id && ".$_POST['filter'];}
		else{$where="where p_store.st_id=p_store_type.st_id && p_user.u_id=p_store.u_id";}
		echo $db->select("p_store,p_store_type,p_user","*",$where);
	}

	else if(isset($_POST['p_store_update'])){
		$field_update="s_name='{$_POST['s_name']}',st_id='{$_POST['st_id']}',u_id='{$_POST['u_id']}',s_status='{$_POST['s_status']}'";
		if(isset($_FILES['s_img']) && $_FILES['s_img']['name']!=""){
			$filename = "../img/".date("yy-m-d_His").".jpg";
			if(move_uploaded_file($_FILES['s_img']["tmp_name"], $filename)){
				$field_update.=",s_img='{$filename}'";
			}
		}
		// echo $field_update;
		echo $db->update("p_store",$field_update,"s_id='{$_POST['s_id']}'");
	}
	else if(isset($_POST['p_store_del'])){
		echo $db->delete("p_store","s_id='".$_POST['s_id']."'");
	}
	else if(isset($_POST['p_store_add'])){
		$data=[];
		if(isset($_FILES) && $_FILES['s_img']['name']!=''){
			$filename = "../img/".date("yy-m-d_His").".jpg";
			if(move_uploaded_file($_FILES['s_img']["tmp_name"], $filename)){
				$data["s_img"]=$filename;
			}
		}else{
			$data["s_img"]="";
		}

		echo $db->insert("p_store","s_name,st_id,u_id,s_img","'{$_POST['s_name']}','{$_POST['st_id']}','{$_POST['u_id']}','{$data['s_img']}'");
	}
	else if(isset($_POST['p_user_del'])){
		echo $db->delete("p_user","u_id='".$_POST['u_id']."'");
	}
	else if(isset($_POST['p_user_update'])){
		$field_update="u_email='{$_POST['u_email']}',u_name='{$_POST['u_name']}',u_lname='{$_POST['u_lname']}',u_status='{$_POST['u_status']}',u_tel='{$_POST['u_tel']}',u_address='{$_POST['u_address']}'";
		if(isset($_FILES['u_img']) && $_FILES['u_img']['name']!=""){
			$filename = "../img/".date("yy-m-d_His").".jpg";
			if(move_uploaded_file($_FILES['u_img']["tmp_name"], $filename)){
				$field_update.=",u_img='{$filename}'";
			}
		}
		if(isset($_POST['u_password']) && $_POST['u_password']!=""){
			$pass=$db->re_encode($_POST['u_password']);
			$field_update.=",u_password='{$pass}'";
		}
		// echo $field_update;
		echo $db->update("p_user",$field_update,"u_id='{$_POST['u_id']}'");
	}
	else if(isset($_POST['load_p_product'])){
		if(isset($_POST['filter'])){$where="where ".$_POST['filter'];}
		else{$where="where p_store.s_id = p_product.s_id && p_store.s_id = p_product.s_id ";}
		echo $db->select("p_product,p_store","*",$where);
	}
	else if(isset($_POST['p_product_update'])){
		$field_update="p_name='{$_POST['p_name']}',p_amount='{$_POST['p_amount']}',p_price='{$_POST['p_price']}',p_date_import='{$_POST['p_date_import']}',s_id='{$_POST['s_id']}'";
		if(isset($_FILES['p_img']) && $_FILES['p_img']['name']!=""){
			$filename = "../img/".date("yy-m-d_His").".jpg";
			if(move_uploaded_file($_FILES['p_img']["tmp_name"], $filename)){
				$field_update.=",p_img='{$filename}'";
			}
		}
		echo $db->update("p_product",$field_update,"p_id='{$_POST['p_id']}'");
	}
	else if(isset($_POST['p_product_del'])){
		echo $db->delete("p_product","p_id='".$_POST['p_id']."'");
	}
	else if(isset($_POST['p_product_add'])){
		$data=[];
		if(isset($_FILES) && $_FILES['p_img']['name']!=''){
			$filename = "../img/".date("yy-m-d_His").".jpg";
			if(move_uploaded_file($_FILES['p_img']["tmp_name"], $filename)){
				$data["p_img"]=$filename;
			}
		}else{
			$data["p_img"]="";
		}

		echo $db->insert("p_product","p_name,p_amount,p_price,p_date_import,s_id,p_img","'{$_POST['p_name']}','{$_POST['p_amount']}','{$_POST['p_price']}','{$_POST['p_date_import']}','{$_POST['s_id']}','{$data['p_img']}'");
	}
?>