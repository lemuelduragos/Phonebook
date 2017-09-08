<?php
if(isset($_POST['action']))
{
	$id = $_POST['inputIDC'];
	$action = $_POST['action'];
	$name = $_POST['inputName'];
	$number = $_POST['inputNumber'];
}
else
{
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
        $table ="<tr>ID<th>Name</th><th>Number</th></tr>";
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
    
/*    default:
        code to be executed if n is different from all labels;*/
}

?>