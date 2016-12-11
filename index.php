<html>
<head>
        <!-- 
            Create on: 03/11/2016 21:05
            Author: Danilo da Silva Pereira Mat: 201611250
            Description: Projeto Telegram / Php.  
        -->
	<title>Api PHP</title>
	<meta charset="UTF-8">
</head>
<body>
    <?php
    require 'DAOFiltro.php';
    $DAOFiltro = new DAOFiltro();
    //Token
    include './token.txt';

    //Puxando json da url da api
	$url = "https://api.telegram.org/bot." . $token . "/getUpdates";
    $content = file_get_contents($url);
    $to = json_decode($content,true);
    //Count
    $run = count($to["result"]);

	//laco para buscar campos especificos e pô-los numa array
	for($i = 0; $i < $run; $i++){

		$id = $to["result"][$i]["message"]["chat"]["id"];
        $update_id = $to["result"][$i]["update_id"];

        if(isset($to["result"][$i]["message"]["text"])){
     	
     		$text = $to["result"][$i]["message"]["text"];
			//Arquivo de texto
	    	$arquivo ='storage.txt';  
			$str = file_get_contents($arquivo);
			$array_updateId = explode(',',$str);
			
                
                //Condicao para responder à msg "/MEGASENA" e guardar dados no banco
                if(!in_array($update_id, $array_updateId)){
                    if($text == '/megasena'){
                        
                        $numMegasena = array();
                         // Gerar numeros da megasena
                        for($j = 1; $j <=6;$j++) {
                            $numMegasena[] = rand(1,60); 
                        }
                        sort($numMegasena);
                        $sena = implode(" - ", $numMegasena); print "<br>";
  
                        $new_url = 'https://api.telegram.org/bot242158604:AAHsZgkHuWC4ZBP3eBNTvuX7_eITmIdunys/sendMessage?chat_id='. $id ."&text=$sena";
                        file_get_contents($new_url);
                        file_put_contents($arquivo, $update_id.",", FILE_APPEND);
                        
                    
                       	$DAOFiltro->inserir($update_id,$text,$sena);
                   	}
                }
            }    
            
    }	

    
?>
</body>
</html>