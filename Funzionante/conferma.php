<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style type="text/css">
        .style1
        {
            width: 119px;
            height: 28px;
        }
    </style>
    
<link rel="stylesheet" type="text/css" href="./centroprenotazioni_files/style.css" media="all"></head>

<body>

        <div id="sitecontainer">
  	        <div id="content">
 		        <div id="BloccoSotto" style="background-repeat:no-repeat">	
                    <div id="colCalendario5">
                     <table width="100%" align="center">
					        <tbody><tr>
						        <td align="center"><div class="TitoloOrari3"><?php
                                
                               		 include("conn.php");
                                
									$arr=array(1=>"Gennaio",2=>"Febbraio",3=>"Marzo",4=>"Aprile",5=>"Maggio",6=>"Giugno",7=>"Luglio",8=>"Agosto",9=>"Settembre",10=>"Ottobre",11=>"Novembre",12=>"Dicembre");
										//if(isset($_POST["giorno"]) && isset($_POST["mese"]) && isset($_POST["anno"]))
                                      
									$Errori=false;
									
									$result = mysql_query("SELECT count(ID) as count from Utente INNER JOIN Donazione_Ora on ( Utente.IDDonazione_ora = Donazione_Ora.ID) WHERE IDDonazione=$_POST[result] and IDOra=$_POST[IDOrario]");

									if($row=mysql_fetch_array($result))
									{
										if($row["count"]>6)
										{
											echo "ERRORE! TROPPI USER X ORA";
											$Errori=true;
											
										}
									}
									else
									{
										echo "ERRORE! IMPOSSIBILE FARE LA QUERY1";
										$Errori=true;
									}

									$result_1 = mysql_query("SELECT count(ID) as count from Utente INNER JOIN Donazione_Ora on ( Utente.IDDonazione_ora = Donazione_Ora.ID) WHERE IDDonazione=$_POST[result]");
                                    
                                    if($row=mysql_fetch_array($result_1))
									{
										if($row["count"]>60)
										{
											echo "ERRORE! TROPPI USER X DATA";
											$Errori=true;
										}
									}
									else
									{
										echo "ERRORE! IMPOSSIBILE FARE LA QUERY2";
										$Errori=true;
									}

									
									$result_2 = mysql_query("SELECT count(ID) as count from Utente INNER JOIN Donazione_Ora on ( Utente.IDDonazione_ora = Donazione_Ora.ID) WHERE IDDonazione=$_POST[result] and CodiceFiscale like '$_POST[CodiceFiscale]'"); 
									 
                                    if($row=mysql_fetch_array($result_2))
									{
										if($row["count"]>0)
										{
											echo "ERRORE! HAI GIA' UNA PRENOTAZIONE";
											$Errori=true;
										}
									}
									else
									{
										echo "ERRORE! IMPOSSIBILE FARE LA QUERY";
										$Errori=true;
									} 
                                    
                                    $result_3 = mysql_query("SELECT ID as count from Donazione_Ora where IDDonazione=3 and IDOra=1");  //modificato iddonazione
                                    $temp=null;
									
									
                                    if($row=mysql_fetch_array($result_3))
									{
										 $temp=$row["count"];
										if($row["count"]==NULL )
										{
											echo "ERRORE! Impossibile trovare data e ora associate";
											$Errori=true;
										}
									}
									else
									{
										echo "ERRORE! IMPOSSIBILE FARE LA QUERY3";
										$Errori=true;
									} 
									
                                    $ora_Donazione=$_POST["ora"].":".$_POST["minuti"];
                                    $data_Donazione=$_POST["anno"]."/".$_POST["mese"]."/".$_POST["giorno"];
                                    
									if( !$Errori && $temp!=null)
									{
										if(mysql_query("INSERT INTO Utente (Cognome, Nome, DataNascita, CodiceFiscale, Ora_Donazione, Data_Donazione, IDDonazione_ora) VALUES ('$_POST[Cognome]','$_POST[Nome]','$_POST[DataNascita]','$_POST[CodiceFiscale]','$ora_Donazione','$data_Donazione','$temp')"))
										{
											echo "Si conferma la prenotazione di <b>";
											echo $_POST["Cognome"]." ".$_POST["Nome"];
											echo "</b><br>nato il <b>";
											echo $_POST["DataNascita"];
											echo " </b><br> per <b>una donazione di SANGUE</b><br>per il giorno <b>";
											echo $_POST["giorno"]." ".$arr[$_POST["mese"]]." ".$_POST["anno"];
											echo "</b> alle ore <b>";
											echo ($_POST["ora"]<10?"0".$_POST["ora"]:$_POST["ora"]).":".($_POST["minuti"]<10?"0".$_POST["minuti"]:$_POST["minuti"]);
											echo "</b><br><br>Grazie per la collaborazione";
										}
										else
											echo "errore nella query";
									}

                                ?>

                               </div>
						        </td>
					        </tr>
				     </tbody></table>
                  <table width="100%" align="center">
                                <tbody><tr>
						        <td align="center">
                                    &nbsp;</td>
                                <td align="center">&nbsp;</td>
					        </tr>
                            <tr>
						        <td align="center">
                                    &nbsp;</td>
                                <td align="center">&nbsp;</td>
					        </tr>
					        <tr>
						        <td align="center">
                                    <a href="http://perprova.altervista.org/index.php"> <img src="./centroprenotazioni_files/newpren.png"></a>
						        </td>
                                <td align="center"><a href="http://www.avislentate.it/"><img src="./centroprenotazioni_files/home.png"></a>
                                </td>
					        </tr>
				     </tbody></table>
                    
                    </div>



	                </div>
        </div>

     


</div></form></body></html>