<html>

<head>
	<link rel="stylesheet" type="text/css" href="./centroprenotazioni_files/style.css" media="all"> 
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css">
    
    <script>
	arrayValori= new Array();
	$(document).ready(function()
	{
		<?php
			foreach($_POST as $key=>$val)
			{
				echo "arrayValori['$key']='$val';\r\n";
			}
           
            include("conn.php"); 
			$result = mysql_query("SELECT t1.ID,t1.ora,IF(count is null,0,count) as count  from (SELECT Orari.ID, Orari.ora from Donazione_Ora INNER JOIN Orari on (Orari.ID=Donazione_Ora.IDOra)  where Donazione_Ora.IDDonazione=$_POST[result] ) as t1 left join(SELECT count(Donazione_Ora.IDOra) as count,Donazione_Ora.IDOra as IDOra, Orari.ora as Ora from Utente INNER JOIN Donazione_Ora on ( Utente.IDDonazione_ora= Donazione_Ora.ID)INNER JOIN Orari on (Orari.ID=Donazione_Ora.IDOra) where Donazione_Ora.IDDonazione=$_POST[result] GROUP BY Donazione_Ora.IDOra, Orari.ora) as t2 on ( t2.IDOra=t1.ID)");
			                                               //numero persone già iscritte
											   
			while($row=mysql_fetch_array($result))
			{
				$occorrenze=$row["count"];  //numero di prenotazioni
				$orario=date_create($row["ora"]);  //ora della prenotazione
				$idOrario=$row["ID"];
				
				$o=date_format($orario, 'H');
				$m=date_format($orario, 'i');

				$stato="true";
				if($occorrenze>=6)
					$stato="false";
					 
				echo "AddOra($m,$o,$stato,$idOrario);\r\n";
			}
		?>

	});
	
	function AddValoreArray(arr)
	{
		for (var k in arr)
		{
			arrayValori[k]=arr[k];
		}
	}
	function SendArray(PaginaDiSend)
	{
		var v1=document.createElement('FORM');
		$(v1).attr('method','post');
		$(v1).attr('action',PaginaDiSend);
		for (var k in arrayValori)
		{
			$(v1).append($(document.createElement('INPUT')).attr('type','hidden').attr('name',k).attr('value',arrayValori[k]));
		}
		$(v1).submit();
	}
	
	
	function Cliccato(o,m,id)
	{
		AddValoreArray({ora:o,minuti:m,IDOrario:id});
		SendArray("riepilogo.php");
	}
	
	
	function AddOra(m,o,show,id)
	{

		if(m<10)
			m="0"+m;
		if(o<10)
			o="0"+o;	
			
		var v1=document.createElement('TR');
		var v2=document.createElement('TD');
		$(v2).attr('align','center');
		var v3=document.createElement('DIV');
		$(v3).attr('class','TitoloOrari3');
		$(v3).append(o+":"+m);
		$(v2).append(v3);
		$(v1).append(v2);
		var v4=document.createElement('TD');
		$(v4).attr('align','center');
		$(v4).append(' ');
		$(v1).append(v4);
		var v5=document.createElement('TD');
		$(v5).attr('align','center');
		var v6=document.createElement('IMG');
		
		$(v6).attr('border','0');
		$(v6).append('');
		$(v5).append(v6);
		$(v1).append(v5);
		var v7=document.createElement('TD');
		$(v7).attr('align','center');
		$(v7).append(' ');
		$(v1).append(v7);
		
		if(show)http:
		{
			$(v6).attr('src','./centroprenotazioni_files/prenota.png');
			$(v6).attr('onclick','Cliccato('+o+','+m+','+id+');');
		}
		else
		{
			$(v6).attr('src','./centroprenotazioni_files/completo.png');
			$(v6).css("cursor", "default");
			$(v3).addClass("Full");
			
		}
		$("#colCalendario > table > tbody").append(v1);
	}
</script>
	<style>
		table td img
		{
			cursor:pointer;
		}
		.TitoloOrari3.Full
		{
			color: red;
			text-decoration: line-through;
		}
	</style>
</head>

<body>

        <div id="sitecontainer">
  	        <div id="content">
 		        <div id="BloccoSotto" style="background-repeat:no-repeat">	
                
                	<div id="data">
	                         	 	                          	 	 
                             <span class="TitoloOrari"><div align="center">Prenotazioni per <br><b>Domenica <?php 
							 
							 $arr=array(mese=>"Gennaio",2=>"Febbraio",3=>"Marzo",4=>"Aprile",5=>"Maggio",6=>"Giugno",7=>"Luglio",8=>"Agosto",9=>"Settembre",10=>"Ottorbe",11=>"Novembre",12=>"Dicembre");
							 if(isset($_POST["giorno"]) && isset($_POST["mese"]) && isset($_POST["anno"]))
								echo $_POST["giorno"]." ".$arr[$_POST["mese"]]." ".$_POST["anno"];
							 
							 
							 
							 ?> </b><br>Cliccare su <b>"Prenota"</b><br> relativamente all'orario desiderato <br> per inserire la propria prenotazione</div></span><br><br>
                             
                        <div id="colCalendario">
                             
                             <table width="100%" border="0" cellspacing="5" bordercolor="#0000FF">
                             
                             <td width="40%"><div align="center"><img src="./centroprenotazioni_files/orario.png" style="cursor:default;"></div></td>
                             <td colspan="2" width="20%"><div align="center"><img src="./centroprenotazioni_files/sangue.png" style="cursor:default;"></div></td>
                             
                             </tr><tr>
                             
                            
                    
                    </div>
		        </div>
	        </div>
        </div>
        

</body>
</html>