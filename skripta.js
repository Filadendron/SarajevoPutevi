function Racunaj(){
	var x = document.querySelectorAll("p.ObjavljenoPrije");
	var y = document.querySelectorAll("p.Kontrola");

	for (var i = 0; i < x.length; i++) {

		var trenutno = new Date();
		var VrijemeNovosti = new Date(x[i].innerHTML);

		var razlika = trenutno- VrijemeNovosti;
		razlika=parseInt(razlika/1000);
		if(razlika<60)
		{
			//U sekundama
			x[i].innerHTML="Novost je objavljena prije par sekundi";
			y[i].innerHTML="1";
		}
		else
		{
			razlika=parseInt(razlika/60);

			if(razlika<60)
			{	
				//U minutama
				if(razlika==1){
					x[i].innerHTML="Novost je objavljena prije "+razlika+" minut";
					y[i].innerHTML="1";
				}
				else{
					x[i].innerHTML="Novost je objavljena prije "+razlika+" minuta";
					y[i].innerHTML="1";
				}
			}
			else
			{
				razlika=parseInt(razlika/60);
				//U satima
				if(razlika<24)
				{
					if(razlika==1 || razlika==21){
						x[i].innerHTML="Novost je objavljena prije "+razlika+" sat";
						y[i].innerHTML="1";
					}
					else if((razlika>1 && razlika<5) || (razlika>21 && razlika<24)){
						x[i].innerHTML="Novost je objavljena prije "+razlika+" sata";
						y[i].innerHTML="1";
					}
					else{
						x[i].innerHTML="Novost je objavljena prije "+razlika+" sati";
						y[i].innerHTML="1";
					}
				}
				else
				{
					razlika=parseInt(razlika/24);
					//U danima
					if(razlika<7)
					{
						if(razlika==1){
							x[i].innerHTML="Novost je objavljena prije "+razlika+" dan";
							y[i].innerHTML="2";
						}
						else{
							x[i].innerHTML="Novost je objavljena prije "+razlika+" dana";
							y[i].innerHTML="2";
						}
					}
					else if(razlika>31)
					{
						x[i].innerHTML="Datum objave novosti: "+ VrijemeNovosti;
						y[i].innerHTML="4";
					}
					else
					{
						razlika=parseInt(razlika/7);
						//U sedmicama
						if(razlika==1){
							x[i].innerHTML="Novost je objavljena prije "+razlika+" sedmicu";
							y[i].innerHTML="3";
						}
						else{
							x[i].innerHTML="Novost je objavljena prije "+razlika+" sedmice";
							y[i].innerHTML="3";
						}

					}
				}	
			}
		}
	}
}

function OdabirNovosti(control){

	var x = document.querySelectorAll("p.Kontrola");

	for (var i = 0; i < x.length; i++) {
		if(control==0){
			x[i].parentElement.style.display="block";
		}
		else if(control==1)
		{
			if(x[i].innerHTML=="1")
			{
				x[i].parentElement.style.display="block";
			}
			else
			{
				x[i].parentElement.style.display="none";	
			}
		}
		else if(control==2)
		{
			if(x[i].innerHTML=="1" || x[i].innerHTML=="2")
			{
				x[i].parentElement.style.display="block";
			}
			else
			{
				x[i].parentElement.style.display="none";
			}
		}
		else if(control==3)
		{
			if(x[i].innerHTML=="1" || x[i].innerHTML=="2"  || x[i].innerHTML=="3")
			{
				x[i].parentElement.style.display="block";	
			}
			else
			{
				x[i].parentElement.style.display="none";
			}
		}

	}

}

function ValidirajMail(mail){
	if(mail.value!="")
	{
		mail.style="background-color:white; border: 2px solid lightblue;";
		return true;
	}
	else
	{
		mail.style="background-color:#ff8566; border:2px solid #ff0000;";
		return false;
	}
}

function ValidirajTelefon(tel){
	if(tel.value!="")
	{
		tel.style="background-color:white; border: 2px solid lightblue;";
		return true;
	}
	else
	{
		tel.style="background-color:#ff8566; border:2px solid #ff0000;";
		return false;
	}
}

function Validiraj(ulaz){

	if(ulaz.id=="Ime")
	{
		if(ulaz.value!="")
		{
			ulaz.style="background-color:white; border: 2px solid lightblue;";
			if(document.getElementById("Poruka").value=="")
			{
				document.getElementById("Poruka").style="background-color:#ff8566; border:2px solid #ff0000;";
				return false;
			}
			else
			{
				document.getElementById("Poruka").style="background-color:white; border: 2px solid lightblue;";
				return true;
			}
			
		}
		else
		{
			ulaz.style="background-color:#ff8566; border:2px solid #ff0000;";
			return false;
		}
	}
	else if(ulaz.id=="Mail")
	{
		return ValidirajMail(ulaz);
	}
	else if(ulaz.id=="Telefon")
	{
		return ValidirajTelefon(ulaz);
	}
	else if(ulaz.id="Poruka")
	{
		if(ulaz.value!="")
		{
			ulaz.style="background-color:white; border: 2px solid lightblue;";
			if(document.getElementById("Ime").value=="")
			{		
				document.getElementById("Ime").style="background-color:#ff8566; border:2px solid #ff0000;";
				return false;
			}
			else
			{
				document.getElementById("Ime").style="background-color:white; border: 2px solid lightblue;";
				return true;
			}
		}
		else
		{
			ulaz.style="background-color:#ff8566; border:2px solid #ff0000;";
			return false;
		}
	}
}

function ValidirajDugme(){
	if(Validiraj(document.getElementById("Ime"))==false )
		alert("Niste unijeli sva polja ili vam unesena polja nemaju odgovarajuci format");
	else if(Validiraj(document.getElementById("Mail"))==false)
		alert("Niste unijeli sva polja ili vam unesena polja nemaju odgovarajuci format");
	else if(Validiraj(document.getElementById("Telefon"))==false)
		alert("Niste unijeli sva polja ili vam unesena polja nemaju odgovarajuci format");
	else if(Validiraj(document.getElementById("Poruka"))==false)
		alert("Niste unijeli sva polja ili vam unesena polja nemaju odgovarajuci format");
}
