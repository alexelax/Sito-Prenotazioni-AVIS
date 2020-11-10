function Cliccato(gg,mm,aa)
	{
		AddValoreArray({giorno:gg,mese:mm,anno:aa});
        
       // var insieme;
        
       // insieme=(arrayValori["anno"])+"/"+(arrayValori["mese"])+"/"+(arrayValori["giorno"]);
        
         if (!isset($_SESSION)) session_start();
	
			include("conn.php");
            
        $result = mysql_query("SELECT COUNT(DataDonazione) as CONTEGGIO,DataDonazione as DATA FROM Utente group by DataDonazione");
    	
		while($row=mysql_fetch_array($result))
		{
			$occorrenze=$row["CONTEGGIO"];  //numero di prenotazioni
			$data=$row["DATA"];  //data della prenotazione
			
			if($occorrenze>=60)
				alert ("La giornata selezionata è gia al completo di donazioni!");
			else 
					SendArray("dettaglio_giorno.php");  
		}
	}
		
		
		
   
   		if ($quanti == 0)
    	{
        	echo "Nessun record!";
   		}
    	else
    	{
			$cont=0;
	
        for($x=0; $x<$quanti; $x++)
        {
            $rs = mysql_fetch_row($query); //array con tutte le date delle donazioni
            
            if($rs[$x]==insieme)
				$cont++;   
        }
		
		if($cont>=60)
			alert ("La giornata selezionata è gia al completo di donazioni!");
        else    
        	SendArray("dettaglio_giorno.php");
    	}
	}