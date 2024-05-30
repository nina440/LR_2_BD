;<?php 
// блок инициализации
try {
	$pdoSet = new PDO('mysql:host=localhost', 'root', '');
	$pdoSet->query('SET NAMES utf8;');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

// код для "неубиваемой" базы данных
$sqlTM = "CREATE DATABASE IF NOT EXISTS astr_db;";
$stmt = $pdoSet->query($sqlTM);
$sqlTM = "USE astr_db;";
$stmt = $pdoSet->query($sqlTM);

$sqlTM = "CREATE TABLE IF NOT EXISTS NaturalObjects (id int(11) NOT NULL auto_increment, text text NOT NULL, description text NOT NULL, keywords text NOT NULL, PRIMARY KEY (id)) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;";
$stmt = $pdoSet->query($sqlTM);
$sqlTM = "CREATE TABLE IF NOT EXISTS files (id_file int(11) NOT NULL auto_increment, id_my int(11) NOT NULL, description text NOT NULL, name_origin text NOT NULL, path text NOT NULL, date_upload text NOT NULL, PRIMARY KEY (id_file), FOREIGN KEY (id_my) REFERENCES myarttable(id)) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;";
$stmt = $pdoSet->query($sqlTM);
// конец кода для "неубиваемой" базы данных
if (isset($_POST['bt1'])) { // Изменение проверки на POST
    $type = $_POST["type"];
    $galaxy = $_POST["galaxy"];
    $accuracy = $_POST["accuracy"];
    $lightFlow = $_POST["lightFlow"];
    $associated = $_POST["associated"];
    $notes = $_POST["notes"];

    try {
        $sqlTM = "INSERT INTO NaturalObjects (type, galaxy, accuracy, lightFlow, associated, notes) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdoSet->prepare($sqlTM);

        // Привязка параметров
        $stmt->bindParam(1, $type);
        $stmt->bindParam(2, $galaxy);
        $stmt->bindParam(3, $accuracy);
        $stmt->bindParam(4, $lightFlow);
        $stmt->bindParam(5, $associated);
        $stmt->bindParam(6, $notes);

        
		$result = $stmt->execute(); 

		if ($result === false) { 
			$errorInfo = $stmt->errorInfo(); 
			echo "Ошибка базы данных: " . $errorInfo[2]; 
		} else {
			echo "Новая сущность успешно добавлена!";
		}
        
    } catch (PDOException $e) {
		if ($e->errorInfo[1] == 1062) { 
			echo "Ошибка: Эта запись уже существует.";
		} else {
			echo "Ошибка базы данных: " . $e->getMessage();
		}
	}
}


// начало вставки для UPDATE
if (isset($_POST['id'])) {
    $textId = $_POST['id'];
    $type = $_POST['type'];
    $galaxy = $_POST['galaxy'];
    $accuracy = $_POST['accuracy'];
    $lightFlow = $_POST['lightFlow'];
    $associated = $_POST['associated'];
    $notes = $_POST['notes'];

    try {
        // Вызов процедуры для обновления записи в таблице NaturalObject
        $stmt = $pdoSet->prepare("CALL UpdateNaturalObjects(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $textId, PDO::PARAM_INT);
        $stmt->bindParam(2, $type, PDO::PARAM_STR);
        $stmt->bindParam(3, $galaxy, PDO::PARAM_STR);
        $stmt->bindParam(4, $accuracy, PDO::PARAM_STR);
        $stmt->bindParam(5, $lightFlow, PDO::PARAM_STR);
        $stmt->bindParam(6, $associated, PDO::PARAM_STR);
        $stmt->bindParam(7, $notes, PDO::PARAM_STR);
		$result = $stmt->execute(); 

		if ($result === false) { 
			$errorInfo = $stmt->errorInfo(); 
			echo "Ошибка базы данных: " . $errorInfo[2]; 
		} else {
			echo "Сущность успешно обновлена!";
		}
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
// конец вставки для UPDATE

// начало вставки для DELETE
if (isset($_GET['delid'])) {
	$sqlTM = "DELETE FROM files WHERE id_my = " . $_GET["delid"];
	$stmt = $pdoSet->query($sqlTM);
	$sqlTM = "DELETE FROM NaturalObjects WHERE id = " . $_GET["delid"];
	$stmt = $pdoSet->query($sqlTM);
}
// конец вставки для DELETE


	$sqlTM="SELECT * FROM NaturalObjects WHERE id>0 ORDER BY id DESC";  // ASC - по возрастанию; DESC - по убыванию.
//echo $sqlTM;
	$stmt = $pdoSet->query($sqlTM);
	$resultMF = $stmt->fetchAll();
	
//var_dump($resultMF);
?>
