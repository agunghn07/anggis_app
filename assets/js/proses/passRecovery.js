function showhide_login() {
    var x = document.getElementById("password");//"password" adalah id dari <input type="password" id="password">;
    if (x.type === "password") { //"password" adalah type dari <input type="password"
        x.type = "text";
    } else {
        x.type = "password";
    }
  } 

  function showhide_regist() {
    var x = document.getElementById("password");//"password" adalah id dari <input type="password" id="password">;
    if (x.type === "password") { //"password" adalah type dari <input type="password"
        x.type = "text";
    } else {
        x.type = "password";
    }
  }  

	function showhide_reset() {
    	var x = document.getElementById("password");//"password" adalah id dari <input type="password" id="password">;
    	var y = document.getElementById("confirm");
    	if (x.type === "password" && y.type === "password") { //"password" adalah type dari <input type="password"
      		x.type = "text";
      		y.type = "text";
    	} else {
      		x.type = "password";
      		y.type = "password";
    	}
  	}  