<div id="mySidenav" class="sidenav" style="">
	<form class="form-inline">
	    <div class="input-group">
	      <div class="input-group-prepend">
	        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
	      </div>
	      <input type="text" class="form-control" placeholder="ค้นหา" aria-label="Username" aria-describedby="basic-addon1">
	    </div>
	</form>
	<hr style="background-color: #fff"/>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>
<nav style="background-color: #49647e" class="navbar navbar-expand-md bg-cyan navbar-dark fixed-top">

	<button class="cv_ico-toggle" type="button" onclick="openNav()" >
		<i style="color:#fff" class="fas fa-align-justify"></i>
  	</button>
	<a class="navbar-brand" href="#"><i class="fas fa-dolly-flatbed"></i> Shopa</a>
	<ul class="navbar-nav mr-auto">
	</ul>
  
</nav>
<script>
let stg=0;
function openNav() {
    stg++;
    if(stg%2==1){
    	document.getElementById("mySidenav").style.width = "250px";
    }else{
    	document.getElementById("mySidenav").style.width = "0";
    }
  
}

</script>