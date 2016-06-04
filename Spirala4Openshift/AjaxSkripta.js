function provjeriDvoslovniKod(el)
{
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function () {


	    if (ajax.readyState == 4 && ajax.status == 200) {
	        var servis = JSON.parse(ajax.response);
	        if(ajax.response=="[null]"){
	        	document.getElementById("dkd").style="background-color:#ff8566; border:2px solid #ff0000;";
				document.getElementById("Dugme").disabled=true;
	        }
	        else{
		        document.getElementById("tbroj").value="+" + servis[0].callingCodes[0];
		        document.getElementById("dkd").style="background-color:white; border: 2px solid lightblue;";
				document.getElementById("Dugme").disabled=false;
	   		}

	    }
	    if (ajax.readyState == 4 && ajax.status == 404) {
	        alert("Pogrešan URL za web servis!");
	    }

	}

	    ajax.open("GET", "https://restcountries.eu/rest/v1/alpha?codes=" + el.value, true);
	    ajax.send();
	    return false;
}

function provjeriBroj(el)
{
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function () {


	    if (ajax.readyState == 4 && ajax.status == 200) {
	        var servis = JSON.parse(ajax.response);
	        var broj=el.value.substring(1, 4);
	        var test=true;
	        for(var i=0;i<servis.length;i++){
	        	if(broj==servis[i].callingCodes[0]){
	        		document.getElementById("dkd").value=servis[i].alpha2Code;
	        		document.getElementById("tbroj").style="background-color:white; border: 2px solid lightblue;";
					document.getElementById("Dugme").disabled=false;
					test=false;
	        		break;
	        	}
	        }
	        if(test){
	        	document.getElementById("tbroj").style="background-color:#ff8566; border:2px solid #ff0000;";
				document.getElementById("Dugme").disabled=true;
	        }
	    }
	    if (ajax.readyState == 4 && ajax.status == 404) {
	        alert("Pogrešan URL za web servis!");
	    }

	}

	    ajax.open("GET", "https://restcountries.eu/rest/v1/", true);
	    ajax.send();
	    return false;
}