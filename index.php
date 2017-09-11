<html>
<head>
<script type="text/javascript" src="view/jquery.min.js"></script>
<title>Phonebook</title>
</head>
<body>
<form type="POST" id='add'>
<input type='text' id='action' name='action' value='add' hidden><br>
<b><label id='notification' style="color: red;"></label></b>
<input type='text' id='inputID' name='inputIDC' hidden><br>
<label>Name:</label><br><input type='text' id='inputN' name='inputName'><br>
<label>Number:</label><br><input type='text' id='inputNum' name='inputNumber'><br><br>
<input type='submit' id='button' value='Add'>
</form>
<form type="POST" id='searchf'>
<label>Search: </label><input id='search'>
</form>
<table id='result'>
</table>
</body>
<script type="text/javascript" src="view/query.js"></script>
</html>

