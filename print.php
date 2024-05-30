<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<title>Отчёт для печати</title>
	<meta name="description" content="Отчёт для печати" /> 
    <meta name="Keywords" content="ОТЧЁТ, ПЕЧАТЬ" />
  	<link rel="stylesheet" href="style/print.css" />
    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon" />
</head>
<body>
	<header>
		<h3>&nbsp;</h3>
	</header>
	<content>	
		<main>
					
			<form action="" method="get">
			<table class="c2" style="width:530px">
			<tr><td class="c2">Печать таблицы<br />naturalobject из MySQL<br /></td></tr>
			</table>
			
			<table>
			
			<tr class="cH">
				<td style="width:65px;">Ст. 1</td>
				<td style="width:120px;">Ст. 2</td>
				<td style="width:70px;">Ст. 3</td>
				<td style="width:180px;">Ст. 4</td>
			</tr>	

<?php 
// блок инициализации
try {
	$pdoSet = new PDO('mysql:dbname=astr_db;host=localhost', 'root', '');
	$pdoSet->query('SET NAMES utf8;');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

	$sqlTM="SELECT * FROM NaturalObjects ORDER BY id ASC";  // ASC - по возрастанию; DESC - по убыванию.
//echo $sqlTM;
	$stmt = $pdoSet->query($sqlTM);
	$resultMF = $stmt->fetchAll();
	
//var_dump($resultMF);
	for($iC=0; $iC<Count($resultMF); $iC++) {
		?><tr><?php
		for($iR=0; $iR<4; $iR++) {
			?><td><?php echo $resultMF[$iC][$iR];?></td><?php
		}
		?></tr><?php
	}
	
?>
				</table>
			</form>
		</main>
	</content>
	<footer>
		<div>&nbsp;</div> 
	</footer>	
</body>
</html>