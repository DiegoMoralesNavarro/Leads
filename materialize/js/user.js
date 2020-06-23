


window.onload = function(){



	var btn_users = document.querySelector("#btn-users");

	var div_users = document.querySelector("#div-users");


	var xhttp = new XMLHttpRequest();



	btn_users.onclick = function(){




		xhttp.onreadystatechange = function(){

			if (this.readyState == 4 && this.status == 200) {

				console.log(this.responseText);
			}


		}
		
		xhttp.open('GET','http://localhost/leads/app/php-class/AjaxUser.php', true);

		xhttp.send();



	}



	
}
