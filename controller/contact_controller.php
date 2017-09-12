<?php

if(isset($_POST['action']) && !isset($_POST['search']))
{

	$id = $_POST['inputIDC'];
	$name = $_POST['inputName'];
	$number = $_POST['inputNumber'];
	$numcheck = ctype_digit((string)$number);

	if($_POST['action'] == 'delete')
	{
		$id = $_POST['inputIDC'];
		$action = $_POST['action'];
	}
	else if(trim($name, " ")!="" && trim($number, " ")!="" && $numcheck == 'true')
	{
			$action = $_POST['action'];

	}
	else
	{
		$action = '';
	}

}
else if(isset($_POST['search']))
{
	$search = $_POST['search'];
	$action = $_POST['action'];
}
else
{
	$action = 'select';
}

include '../model/contact.php';



switch ($action) {
	case 'add':
		$add = new Contact();
        $add->addContact($name, $number);
        echo $action;
        break;
    case 'select':
    	$select = new Contact();
        $arrayContact = $select->selectContact();
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
    	$edit = new Contact();
        $edit->updateContact($name, $number, $id);
        break;
    case 'delete':
    	$delete = new Contact();
        $delete->deleteContact($id);
        break;
    case 'search':
    	$searchq = new Contact();
        $Searchresults = $searchq->searchContact($search);  
        $tables ="<tr>ID<th>Name</th><th>Number</th></tr>";
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