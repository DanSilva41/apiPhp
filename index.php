<html>
<head>
        <!-- 
            Create on: 03/11/2016 21:05
            Author: Danilo da Silva Pereira Mat: 201611250
            Description: Commit inicial.  
        -->
    <title>Api PHP</title>
    <meta charset="UTF-8">
</head>
<body>
    <?php
    $arquivo = 'storage.txt';
                
        // Gerar numeros aleatorios da megasena
    for($j = 1; $j <=6;$j++) {
            $numMegasena[] = rand(1,60);
            
    }
    sort($numMegasena);
    $str = implode(" - ", $numMegasena);
                
    function sendMessage($chatId,$text){
        file_get_contents("https://api.telegram.org/bot242158604:AAHsZgkHuWC4ZBP3eBNTvuX7_eITmIdunys/sendMessage?chat_id=".$chatId."&text=".$text);
    }
    $url = "https://api.telegram.org/bot242158604:AAHsZgkHuWC4ZBP3eBNTvuX7_eITmIdunys/getUpdates";
    $content = file_get_contents($url);
    $to = json_decode($content,true);
    //Count
    $run = count($to["result"]);
    for($i = 0; $i < $run; $i++){
        $id = $to["result"][$i]["message"]["chat"]["id"];
        $text = $to["result"][$i]["message"]["text"];
        $idText = $to["result"][$i]["update_id"];
            
        $ids[$i] = $id;
        $texts[$i] = $text; 
    }
        
    $ids = array_unique($ids);
    $ids = array_values($ids);
    $end = count($ids);
    //Contando a quantidade de texto
    $msg = count($texts);
        
    for ($i=0; $i < $end ; $i++) { 
            for($m = 0; $m < $msg; $m++){
        if($texts[$m] == "/megasena"){
                    sendMessage($ids[$i],"NÃºmeros da MegaSena:     ".$str);
                        file_put_contents($arquivo, $idText." , " , FILE_APPEND);
        }
        else {
                    sendMessage($ids[$i],"Ola");
        }
            }
        }   
    ?>
</body>
</html>










