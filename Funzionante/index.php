<html>
<head>
	<meta charset="utf-8"> 
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
				echo "arrayValori['$key']='$val';\r\n";   //setta eventuali valori che vengono passati dalla pagina precedente
			}
			
			include("conn.php"); 
			$res = mysql_query("SELECT IDDonazioniAttive,Donazioni.DataDonazione, 
										IF(count is null,0,count) as count
												from (select Donazioni.ID as IDDonazioniAttive from  Donazioni where Donazioni.Attivo=1 ) as t1 LEFT  JOIN 
                                                (SELECT count(*) as count, Donazioni.ID as IDDonazioniJOin from Donazione_Ora INNER JOIN Utente on ( Utente.IDDonazione_ora = Donazione_Ora.ID) INNER JOIN Donazioni on ( Donazioni.ID = Donazione_Ora.IDDonazione) GROUP BY Donazioni.ID,Donazioni.DataDonazione) as t2 on ( IDDonazioniAttive = IDDonazioniJOin) INNER JOIN Donazioni on ( Donazioni.ID = IDDonazioniAttive)");
			                                               //numero persone già iscritte
			while($row=mysql_fetch_array($res))
			{
				$occorrenze=$row["count"];  //numero di prenotazioni
				$data=date_create($row["DataDonazione"]);  //data della prenotazione
				$idDonazione=$row["IDDonazioniAttive"]; 
				
				$aa= date_format($data, 'Y');
				$mm= date_format($data, 'n');
				$gg= date_format($data, 'j');

				$stato="true";
				if($occorrenze>60)
					$stato="false";
				
				echo "AddData($gg,$mm,$aa,$stato,$idDonazione);\r\n";
			}
        ?>
		
		/*AddData(25,5,2014,true);
		AddData(13,7,2014,false);
		AddData(31,8,2014,true);
		AddData(12,10,2014,false);
		AddData(30,11,2014,true);*/

	});
	
	function AddValoreArray(arr)
	{
		for (var k in arr)
		{
			arrayValori[k]=arr[k];   //concatena i valori
		}
	}
	function SendArray(PaginaDiSend)
	{
		var v1=document.createElement('FORM');  //crea un form temporaneo
		$(v1).attr('method','post');
		$(v1).attr('action',PaginaDiSend);
		for (var k in arrayValori)
		{
			$(v1).append($(document.createElement('INPUT')).attr('type','hidden').attr('name',k).attr('value',arrayValori[k]));
		}
		$(v1).submit();
	}
    
	function AddData(gg,mm,aa,show,id)
	{
		var arr={1:"Gennaio",2:"Febbraio",3:"Marzo",4:"Aprile",5:"Maggio",6:"Giugno",7:"Luglio",8:"Agosto",9:"Settembre",10:"Ottobre",11:"Novembre",12:"Dicembre"};
		var v1=document.createElement('TR');
		var v2=document.createElement('TD');
		$(v2).attr('colspan','3');
		$(v2).attr('align','center');
		$(v2).attr('class','TitoloMese');
		$(v2).append('Domenica '+gg+' '+arr[mm]+' '+aa);
		$(v1).append(v2);
		var v3=document.createElement('TD');
		$(v3).attr('style','width: 15px');
		$(v3).append('');
		$(v1).append(v3);
		var v4=document.createElement('TD');
		$(v4).attr('align','center');
		$(v4).attr('style','padding-bottom: 3px; padding-top: 3px;');
		var v5=document.createElement('IMG');
		$(v5).append('');
		$(v4).append(v5);
		$(v1).append(v4);
		
		if(show)
		{
            $(v5).attr('src','./centroprenotazioni_files/'+gg+'a.png');
			$(v5).attr('onclick','Cliccato('+gg+','+mm+','+aa+','+id+');');
		}
		else
		{
			$(v5).attr('src','./centroprenotazioni_files/'+gg+'n.png');
			$(v5).css("cursor", "default");
			$(v2).addClass("Full");
			
		}
		
		$("#colCalendario1 > table > tbody").append(v1);
	}
	function Cliccato(gg,mm,aa,res)
	{
		AddValoreArray({giorno:gg,mese:mm,anno:aa,result:res});
        
       // var insieme;
        
       // insieme=(arrayValori["anno"])+"/"+(arrayValori["mese"])+"/"+(arrayValori["giorno"]);
        
        SendArray("dettaglio_giorno.php");
	}
    
</script>
	<style>
		table td img
		{
			cursor:pointer;
		}
		.TitoloMese.Full
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
				
				<div id="colCalendario1">

				<tbody>
				<table border="0" cellpadding="1" cellspacing="2">	
                
					<tr></tr>
			  </tbody>
	 
			  </div>
			  
			</div>
		</div>
		
	</div>

</body>
</html>