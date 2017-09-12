<?php
require_once('connection.php');

class Contact {

	private $conn = null;

	public function __construct()
	{
		$this->conn = new DatabaseConnection();
	}

	function selectContact() {
		$sql = "Select * FROM Contacts ORDER BY name";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	function selectLastID()
	{
		$sql = "Select id FROM Contacts ORDER BY id DESC LIMIT 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$cou = $stmt->rowCount();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	function addContact($name, $number) {

		$sqlInsert = "INSERT INTO Contacts(name, number)
    	VALUES('$name', '$number')";
   		$this->conn->exec($sqlInsert);
	}

	function deleteContact($id) {
		$sqlDelete = "DELETE FROM Contacts WHERE id= '$id'";
		$this->conn->exec($sqlDelete);
	}

	function updateContact($name, $number, $id) {
		$sqlUpdate = "UPDATE Contacts SET name='$name', `number`='$number' WHERE id=$id";
	    $stmt = $this->conn->prepare($sqlUpdate);
	    $stmt->execute();
	}

	function searchContact($search) {
		$sqlsearch = "Select * FROM Contacts WHERE name LIKE '%$search%' OR number LIKE '%$search%' ORDER BY name";
		$stmts = $this->conn->prepare($sqlsearch);
		$stmts->execute();
		$cou = $stmts->rowCount();
		$results = $stmts->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
}

?>