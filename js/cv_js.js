function title(){
	return "shopa";
} 
function upload(target){
	$(target).trigger("click");
}
function img_preview(img,target){
	var reader=new FileReader();
	reader.onload=function(){
		document.getElementById(target).src=reader.result;
	}
	reader.readAsDataURL(img.files[0]);
}
$(document).ready(function(){

	let weblink="http://localhost/php_project/";
	let link="http://localhost/php_project/call_controller/api.php";
	function chk_sess(){
		$.post(link,{
			chk_sess:true,
		},function(res){
			$("#modal_login").html(res);
			$("#myModal").modal();
		});
	}
	
	$("#btn_login").click(function(){
		$.get("./call_controller/api.php",{
			login:true,
			u_username:$("#u_username").val(),
			u_password:$("#u_password").val()
		},function(res){
			$("#modal_login").html(res);
			$("#myModal").modal();
		});
	});
	$("#btn_regist").click(function(){
		window.location.href="./views/regist.html";
	});

	$("#btn_regist_frm").click(()=>{
		let sta=0;
		// console.log($("#u_img").val());
		if($("#u_email").val()===""){sta++;}
		if($("#u_password").val()===""){sta++;}
		if($("#Confirm_Password").val()===""){sta++;}
		if($("#u_name").val()===""){sta++;}
		if($("#u_lname").val()===""){sta++;}
		if($("#u_tel").val()===""){sta++;}
		if($("#u_password").val()!=$("#Confirm_Password").val()){sta++;
			$("#sh_msg").html("<div style='color:#dc3545'>ยืนยัน password ไม่ถูกต้อง</div>");
		}

		if(sta!=0){$("#frm_regist").addClass("was-validated");return false;}
		else{
			var f_data=new FormData();
			var data = $("#frm_regist").serializeArray();
			var files = $('#u_img')[0].files[0]; 
			$.each(data,(key,val)=>{
				f_data.append(val.name,val.value);
			});
			f_data.append("regist",true);
			f_data.append("u_img",files);
			event.preventDefault();
			$.ajax({
				type: "POST",
 				url: link,
 				data: f_data,
				contentType: false,
				processData: false,
			}).done((res)=> {
				let resa=JSON.parse(res);
				console.log(resa);
				if(resa.status==1){
					window.location.replace(weblink);
				}else{
					let txt="<div style='color:red'>"+resa.msg;+"</div>";
					$("#msg").html(txt);
					
				}
				
 				
 			});
		}
		
	});
});
