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
        $str = file_get_contents($arquivo);
        $array_updateId = explode( ',' , $str);
                
    $url = "https://api.telegram.org/bot242158604:AAHsZgkHuWC4ZBP3eBNTvuX7_eITmIdunys/getUpdates";
    $content = file_get_contents($url);
    $to = json_decode($content,true);
    //Count
    $run = count($to["result"]);

    for($i = 0; $i < $run; $i++){
        $id = $to["result"][$i]["message"]["chat"]["id"];
        $text = $to["result"][$i]["message"]["text"];
        $update_id = $to["result"][$i]["update_id"];
            
        $ids[$i] = $id;
        $texts[$i] = $text; 
                $updateIds[$i] = $update_id; 
                
                if(!in_array($updateIds[$i], $array_updateId)){
                    if($texts[$i] == '/megasena'){
                        
                        $numMegasena = array();
                         // Gerar numeros da megasena
                        for($j = 1; $j <=6;$j++) {
                            $numMegasena[] = rand(1,60);
                        }
                        sort($numMegasena);
                        $sena = implode(" - ", $numMegasena);
  
                        $new_url = 'https://api.te'
                                . 'legram.org/bot242158604:AAHsZgkHuWC4ZBP3eBNTvuX7_eITmIdunys/sendMessage?chat_id='.$ids[$i]."&text=$sena";
                        file_get_contents($new_url);
                        file_put_contents($arquivo, $updateIds[$i].",", FILE_APPEND);   
                    }
                }
        }   
    ?>
</body>
</html>