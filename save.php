<?php
	include 'database.php';
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	$name=trim($_POST['name']);
	$email=trim($_POST['email']);
	$phone=trim($_POST['phone']);
	$city=trim($_POST['city']);
	$language=trim($_POST['language']);
	$sList=trim($_POST['sList']);
	$timeControl=trim($_POST['timeControl']);
	if ($timeControl=='00:00:00')
	{
		$timeControl = NULL;
	}

	$dateControl=trim($_POST['dateControl']);

  $query = "INSERT INTO `crud`(name, email, phone, city, language, sList, timeControl, dateControl) VALUES (:name, :email, :phone, :city, :language, :sList, :timeControl, :dateControl)";
  $stmt = $conn->prepare($query);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$stmt->bindValue(':city', $city, PDO::PARAM_STR);
$stmt->bindValue(':language', $language, PDO::PARAM_STR);
$stmt->bindValue(':sList', $sList, PDO::PARAM_STR);
$stmt->bindValue(':timeControl', $timeControl, PDO::PARAM_STR);
$stmt->bindValue(':dateControl', $dateControl, PDO::PARAM_STR);
$rc = $stmt->execute();

    if (true===$rc) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
      //connection closed.

?>