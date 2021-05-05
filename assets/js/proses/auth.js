  function showhide_login() {
    var x = document.getElementById("password");
    if (x.type === "password") { 
        x.type = "text";
    } else {
        x.type = "password";
    }
  } 

  function showhide_regist() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }  

	function showhide_reset() {
    	var x = document.getElementById("password");
    	var y = document.getElementById("confirm");
    	if (x.type === "password" && y.type === "password") { 
      		x.type = "text";
      		y.type = "text";
    	} else {
      		x.type = "password";
      		y.type = "password";
    	}
  	}  