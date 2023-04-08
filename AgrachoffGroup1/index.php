

<!DOCTYPE html>
<head>
    <title>tz1</title>
    <meta charset="utf-8">
    <style type="text/css">
	   body {
	   	margin-top: 7%;
	   	text-align: center 
	   }
	   table {
	   	text-align: center 
	    width: 300px; /* Ширина таблицы */
	    border-collapse: collapse; /* Убираем двойные линии между ячейками */
	    
	   }
	   TD, TH,TR {
	    padding: 3px; /* Поля вокруг содержимого таблицы */
	    border: 1px solid black; /* Параметры рамки */
	  
	   }
  </style>
</head>
<body>

           <form action="" method="post">
             <p>Введите артикул: <input type="text" name="article" /></p>
             <p><input type="submit" /></p>
           </form>



<?php

if(empty($_POST['article'])){

    exit('Поле не заполнено');
}

else{


	echo "<table align='center' >
			<tr ><th colspan='12'>Данные по артикулу:".$_POST['article']."</th></tr>
			  <tr>
			  	<th></th>
			    <th>gid</th>
			    <th>brand</th>
			    <th>art</th>
			    <th>name</th>
			    <th>d_deliv</th>
			    <th>h_deliv</th>
			    <th>kr</th>
			    <th>num</th>
			    <th>price</th>
			    <th>whse</th>
			    <th>is_returnable</th>
			  </tr>";

	// Инициализация SOAP-клиента

	$client = new SoapClient('https://api.forum-auto.ru/wsdl', ["exceptions" => true]);

	try{

	    // Выполнение запроса к серверу API Форум-Авто
	    $login='493358_stroyzar';
	    $pass='sAVDkrEbqd';
	    $art=$_POST['article'];
	    $cross=0;
	    $br='';
	    $gid='';
	    
	    $result = $client->listGoods($login, $pass, $art, $cross, $br, $gid);
	    
	    for($i=0;$i<count($result);$i++)
	    {
	    	echo '<tr>';
	    	echo "<td>$i</td>";
	        foreach ($result[$i] as  $column) 
		    {
		     
		        echo "<td>$column</td>";

		    }
		    echo '</tr>';
	        
	    }

	    echo '</table>';

	} 

	catch (SoapFault $e) {

	    echo "Exception: (faultcode: {$e->faultcode}, faultstring: {$e->faultstring}, detail: {$e->detail})";

	}
}

?>
</body>