<html>
	<head>
    <link rel="stylesheet" type="text/css" href="./centroprenotazioni_files/style.css" media="all"> 
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	
    <script>
	arrayValori= new Array();
	$(document).ready(function()
	{
		<?php
			foreach($_POST as $key=>$val)
			{
				echo "arrayValori['$key']='$val';\r\n";
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
	
	
	function Cliccato()
	{
		var nome=$("#Nome").val();
		var cognome=$("#Cognome").val();
		var datanascita=$("#DataNascita").val();
		var codfisc=$("#CodiceFiscale").val();
        AddValoreArray({Nome:nome,Cognome:cognome,DataNascita:datanascita,CodiceFiscale:codfisc});
        SendArray("conferma.php");
	}
    
    function Controllo()
    {
        
        var controllo=5;
        
        var codice = new RegExp ("[A-Z]{6}\\d{2}[A-EHLMPR-T]\\d{2}[A-Z]\\d{3}[A-Z]");
        
        var data = new RegExp ("(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\\d\\d");	
        
        if (($("#CodiceFiscale").val()).trim()=="")
		{
            alert("Inserisci Il Codice Fiscale!");
            controllo--;
		}
      
        else if (!codice.test($("#CodiceFiscale").val()))
		{
            alert("Codice Fiscale Eratto!");
            controllo--;
		}
 
        if (($("#Cognome").val()).trim()=="")
		{
            alert("Inserisci Il Cognome!");
            controllo--;
		}
        
        if (($("#Nome").val()).trim()=="")
		{
            alert("Inserisci Il Nome!");
            controllo--;
		}
        
        if (($("#DataNascita").val()).trim()=="")
		{
            alert("Inserisci La Data Di Nascita!");
            controllo--;
		}
        
        else if (!data.test($("#DataNascita").val()))
		{
            alert("Data Inesistente o Scritta In Formato Errato!");
            controllo--;
		}
        
        privacy = document.getElementById("chkPrivacy");
        
        if (!privacy.checked)
        {
            alert("Devi Accettare L'Informativa Per Il Trattamento Dei Dati Personali!");
            controllo--;
        }
        
        if(controllo==5)
        	Cliccato();
           	
    }
</script>
  
    <style type="text/css">
        .style1
        {
            font-size: xx-small;
            font-weight: 800;
            color: #000099;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            width: 21%;
        }
    </style>
  
</head>

<body>
   
    <div id="sitecontainer">
  	        <div id="content">
 		        <div id="BloccoSotto" style="background-repeat:no-repeat">	
                    <div id="colCalendario4">
                     
                        <br>
        <table border="0" cellspacing="0" cellpadding="0">
										
                                        <tbody><tr>
                                            <td colspan="2" align="center">
                                        
                                                <span class="TitoloOrari">Inserire i propri dati e premere <b>"PRENOTA"</b> per prenotare<br>una donazione di <b>SANGUE</b> per il <br><b><?php 
							 
							 				$arr=array(1=>"Gennaio",2=>"Febbraio",3=>"Marzo",4=>"Aprile",5=>"Maggio",6=>"Giugno",7=>"Luglio",8=>"Agosto",9=>"Settembre",10=>"Ottorbe",11=>"Novembre",12=>"Dicembre");
							 				if(isset($_POST["giorno"]) && isset($_POST["mese"]) && isset($_POST["anno"]))
											echo $_POST["giorno"]." ".$arr[$_POST["mese"]]." ".$_POST["anno"];
							 				
                                            ?></b> alle ore <b><?php 
                                            
                                            echo ($_POST["ora"]<10?"0".$_POST["ora"]:$_POST["ora"]).":".($_POST["minuti"]<10?"0".$_POST["minuti"]:$_POST["minuti"]);?></b>
                                                
                                         </span><br><br>
                                        
                                            </td> 
                                        </tr>
                                        
                                        <tr>
                                        
											<td align="left" class="style1"><b>Codice Fiscale</b></td>
											<td><input name="CodiceFiscale" type="text" maxlength="16" id="CodiceFiscale">*</td>
										  </tr>
                                          <td style="height: 10px"></td>
										  <tr>
											<td align="left" class="style1"><b>Cognome</b></td>
											<td width="68%"><input name="Cognome" type="text" id="Cognome" style="width:173px;">*</td>
										  </tr>
                                          <td style="height: 10px"></td>
										  <tr>
											<td align="left" class="style1"><b>Nome</b></td>
                                            <td width="68%"><input name="Nome" type="text" id="Nome" style="width:173px;">*</td>
										  </tr>
                                          <td style="height: 10px"></td>
										  <tr>
											<td align="left" class="style1"><b>Data Nascita (gg/mm/aaaa)</b></td>
											<td><input name="DataNascita" type="text" id="DataNascita">*</td>
										  </tr> 
                                          <td style="height: 10px"></td>								  
										  <tr>
											<td height="44" colspan="2" class="LabelPrivacy" align="justify"><p><strong>I campi contrassegnati con "*" sono obbligatori. </strong><br><br>
											      
											      <input id="chkPrivacy" type="checkbox" name="chkPrivacy" checked="checked"><a href="http://www.thatsweb.it/privacy/" target="_blank">Il Donatore e' tenuto a leggere l'informativa relativa al  trattamento dei dati personali ai sensi della Legge 196/2003 e a darne opportuna presa visione per adesione(*)</a></p>
										    </td>
										  </tr>
										  <tr>
                                               	<td colspan="2" align="center" valign="middle">
                                                  <input type="submit" onclick="Controllo();" name="cmdPrenota" value="Prenota" id="cmdPrenota"><a href="inserimento.php"></a>
                                                </td>
										  </tr>
                                       </form>   
									</tbody>
                             </table>
                    </div>
		        </div>
	        </div>
        </div>
        
</body></html>