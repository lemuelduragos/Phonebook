<?php

class Contact {

	function selectContact($variable) {
		$sql = "Select * FROM Contacts ORDER BY name";
		$stmt = $variable->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	function selectLastID($variable)
	{
		$sql = "Select id FROM Contacts ORDER BY id DESC LIMIT 1";
		$stmt = $variable->prepare($sql);
		$stmt->execute();
		$cou = $stmt->rowCount();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	function addContact($conn, $name, $number) {

		$sqlInsert = "INSERT INTO Contacts(name, number)
    	VALUES('$name', '$number')";
   		$conn->exec($sqlInsert);
	}

	function deleteContact($conn, $id) {
		$sqlDelete = "DELETE FROM Contacts WHERE id= '$id'";
		$conn->exec($sqlDelete);
	}

	function updateContact($conn, $name, $number, $id) {
		$sqlUpdate = "UPDATE Contacts SET name='$name', `number`='$number' WHERE id=$id";
	    $stmt = $conn->prepare($sqlUpdate);
	    $stmt->execute();
	}

	function searchContact($pdo, $search) {
		$sqlsearch = "Select * FROM Contacts WHERE name LIKE '%$search%' OR number LIKE '%$search%' ORDER BY name";
		$stmts = $pdo->prepare($sqlsearch);
		$stmts->execute();
		$cou = $stmts->rowCount();
		$results = $stmts->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
}

?>