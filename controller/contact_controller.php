<?php

if(isset($_POST['action']) && !isset($_POST['search']))
{

	$id = $_POST['inputIDC'];
	$name = $_POST['inputName'];
	$number = $_POST['inputNumber'];
	$numcheck = ctype_digit((string)$number);

	if($_POST['action'] == 'delete') {
		$id = $_POST['inputIDC'];
		$action = $_POST['action'];
	}
	else if(trim($name, " ")!="" && trim($number, " ")!="" && $numcheck == 'true') {
		$action = $_POST['action'];
	}
	else {
		$action = '';
	}

}
else if(isset($_POST['search']) {
	$search = $_POST['search'];
	$action = $_POST['action'];
} else {
	$action = 'select';
}


include '../model/connection.php';
$pdo = new DatabaseConnection();
include '../model/contact.php';



switch ($action) {
	case 'add':
        Contact::addContact($pdo, $name, $number);
        break;
    case 'select':
        $arrayContact = Contact::selectContact($pdo);
        $table ="<tr><th>Name</th><th>Number</th></tr>";
		foreach($arrayContact as $row) {
			$idc = $row['id'];
			$table .= "<tr><td id='rid' hidden>".$row['id']."</td>";
			$table .= "<td id = 'rname'>".$row['name']."</td>";
			$table .= "<td id='rnum'>".$row['number']."</td>";
			$table .= "<td><button id='edit'>Edit</button></td>";
			$table .= "<td><button id='delete'>Delete</button></td></tr>";
			$id = $row['id'];
		}
		$id = $id+1;
		echo json_encode(array("separate" => $id, "table" => $table));
        break;
    case 'edit':
        Contact::updateContact($pdo, $name, $number, $id);
        break;
    case 'delete':
        Contact::deleteContact($pdo, $id);
        break;
    case 'search':
        $Searchresults = Contact::searchContact($pdo, $search);  
        $tables ="<tr><th>Name</th><th>Number</th></tr>";
		foreach($Searchresults as $rows) {
			$tables .= "<tr><td id='rid' hidden>".$rows['id']."</td>";
			$tables .= "<td id = 'rname'>".$rows['name']."</td>";
			$tables .= "<td id='rnum'>".$rows['number']."</td>";
			$tables .= "<td><button id='edit'>Edit</button></td>";
			$tables .= "<td><button id='delete'>Delete</button></td></tr>";
		}
		echo $tables;
        break;
    
    default:
        echo "Check input";

}

?>