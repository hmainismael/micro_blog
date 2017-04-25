<?php
include('includes/connexion.inc.php');

	if(isset($_POST['id']) && !empty($_POST['id']) && 
		isset($_POST['votes']) && !empty($_POST['votes']) &&
		 isset($_POST['ip']) && !empty($_POST['ip']) )
	{
		$query ='UPDATE messages SET votes= :votes , lastIp=:ip WHERE messages.id=:id';   
				$prep = $pdo->prepare($query);
				$prep->bindValue(':votes', $_POST['votes']);
				$prep->bindValue(':id', $_POST['id']);
				$prep->bindValue(':ip', $_POST['ip']);
				$prep->execute();

		header('Content-type: application/json');
		echo json_encode(array(
				'success' => 'insertion effectuée'
			));
	}
	else
	{
		$query ='SELECT votes, lastIp FROM messages WHERE messages.id=:id';   
				$prep = $pdo->prepare($query);
				$prep->bindValue(':id', $_POST['id']);
				$prep->execute();

		$result = $prep->fetchAll();

		header('Content-type: application/json');
		echo json_encode($result);
	}
	
