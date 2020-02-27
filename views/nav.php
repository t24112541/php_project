<div id="mySidenav" class="sidenav" style="">
	<form class="form-inline">
	    <!-- <div class="input-group">
	      <div class="input-group-prepend">
	        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
	      </div>
	      <input type="text" class="form-control" placeholder="ค้นหา" aria-label="Username" aria-describedby="basic-addon1">
	    </div> -->
	</form>
	<hr style="background-color: #fff"/>
	
	  	<div id="default_menu_box">
		</div>
	  	<div id="mng_menu_box">
		</div>
</div>
<nav style="background-color: #49647e" class="navbar navbar-expand-md bg-cyan navbar-dark fixed-top">

	<button class="cv_ico-toggle" type="button" onclick="openNav()" >
		<i style="color:#fff" class="fas fa-align-justify"></i>
  	</button>
	<a class="navbar-brand" href="#"><i class="fas fa-dolly-flatbed"></i> Shopa</a>
	<ul class="navbar-nav mr-auto">
	</ul>
  	<a class="navbar-brand" href="?logout"><i class="fas fa-sign-out-alt"></i> logout</a>
</nav>
<script>
let stg=0;
let weblink="http://localhost/php_project/";
let link="http://localhost/php_project/call_controller/api.php";
load_menu();
function openNav() {
    stg++;
    if(stg%2==1){
    	document.getElementById("mySidenav").style.width = "250px";
    }else{
    	document.getElementById("mySidenav").style.width = "0";
    }
  
}
function load_menu(){
	let default_menu="<i/>";
	$.ajax({
		type:"POST",
		data:"load_p_type",
		url:link
	}).done((res)=>{
		let data=JSON.parse(res);
		$.each(data,(i, item)=>{
		default_menu+=`<a href="?filter=${item.t_id}"><i class="fas fa-store-alt"></i> ${item.t_name}</a>`;
		});
		
		$("#default_menu_box").html(default_menu);
	});
	let txt=`<hr style="background-color: #fff"/>`;
	if(sessionStorage.getItem("u_status")=="admin"){
		txt+=`	<a href="?p_product"><i class="fab fa-product-hunt"></i> จัดการสินค้า</a>
				<a href="?store_type"><i class="fas fa-folder"></i> จัดการประเภทร้านค้า</a>
				<a href="?p_store"><i class="fas fa-store"></i> จัดการร้านค้า</a>
				<a href="?p_type"><i class="fas fa-folder"></i> จัดการประเภทสินค้า</a>
				<a href="?p_users"><i class="fas fa-users"></i> จัดการผู้คน</a>
			`;
	}
	$("#mng_menu_box").html(txt);
}

</script>