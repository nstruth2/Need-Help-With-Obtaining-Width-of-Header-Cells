<!DOCTYPE html>
<html>
<head>
	<title>Insert data in MySQL database using Ajax</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="targetLegit"> </div>
<p id="target">
</p>    
<p id="demo"></p>
<script>

$(document).ready(function() {
$('#targetLegit').load('show.php');	
var x = document.getElementById("myTable").rows[0].cells[1].offsetWidth;
  document.getElementById("demo").innerHTML = "Found"  + x + "in the second th element";
$('#butsave').on('click', function() {
var name = $('#name').val();
var email = $('#email').val();
var phone = $('#phone').val();
var city = $('#city').val();
var language = $('input[name="language"]:checked').val();
var sList = $('input[name="vehicle"]:checked').val();
var timeControl = document.getElementById("timeInput").value;
var dateControl = document.getElementById("dateInput").value;
$('input[type=checkbox]').each(function () {
    sList += "(" + $(this).val() + "-" + (this.checked ? "checked" : "not checked") + ")";
});
	$.ajax({
		url: "save.php",
		type: "POST",
		data: {
			name: name,
			email: email,
			phone: phone,
			city: city,	
			language: language,
			sList: sList,
			timeControl: timeControl,
			dateControl: dateControl
		},
		cache: false,
		success: function(dataResult){
			dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				$("#butsave").removeAttr("disabled");
				$('#fupForm').find('input:text').val('');
				$("#success").show();
				$('#success').html('Data added successfully !'); 	
				$('#targetLegit').load('show.php');

			}
			else if(dataResult.statusCode==201){
				alert("Error occured !");
			}
			
		
	}

	});
});
});

</script>
<?php
session_start();
  if(!isset($_SESSION['user_id'])){
        echo "You're not logged in<br>";
        echo <<<EOT
<a href="login.php" class="btn btn-info btn-lg">
<span class="glyphicon glyphicon-log-in"></span> Log in
</a><br>
<a href="register.php"><img src="RegisterButton.png"></a>
</p>
EOT;
        exit;
    } else {
    	        echo <<<EOT
        <p> FORUM CODE HERE </p>
<div style="margin: auto;width: 60%;">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<form id="fupForm" name="form1" method="post">
		<div class="form-group">
			<label for="email">Name:</label>
			<input type="text" class="form-control" id="name" placeholder="Name" name="name">
		</div>
		<div class="form-group">
			<label for="pwd">Email:</label>
			<input type="email" class="form-control" id="email" placeholder="Email" name="email">
		</div>
		<div class="form-group">
			<label for="pwd">Phone:</label>
			<input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
		</div>
		<div class="form-group" >
			<label for="pwd">City:</label>
			<select name="city" id="city" class="form-control">
				<option value="">Select</option>
				<option value="Delhi">Delhi</option>
				<option value="Mumbai">Mumbai</option>
				<option value="Pune">Pune</option>
			</select>
		</div>
<div class="form-group">
  <p>Please select your favorite Web language:</p>
  <input type="radio" id="HTML" name="language" value="HTML">
  <label for="HTML">HTML</label><br>
  <input type="radio" id="CSS" name="language" value="CSS">
  <label for="CSS">CSS</label><br>
  <input type="radio" id="Javascript" name="language" value="JavaScript">
  <label for="Javascript">JavaScript</label><br>
  <input type="radio" id="None" name="language" value="None" checked>
  <label for="None">None</label>
</div>
<div class="form-group">
  <input type="checkbox" id="vehicle1" name="vehicle" value="Bike">
<label for="vehicle1"> I have a bike</label><br>
<input type="checkbox" id="vehicle2" name="vehicle" value="Car">
<label for="vehicle2"> I have a car</label><br>
<input type="checkbox" id="vehicle3" name="vehicle" value="Boat">
<label for="vehicle3"> I have a boat</label><br>
<div>
	<label for="timeInput">Choose a time for your meeting:</label>
	<input type=time id="timeInput" name="timeInput" step="1">
</div>
<div>
	<label for="dateInput">Choose a date for your meeting:</label>
	<input type=date id="dateInput" name="dateInput">
</div>
</div>
		<input type="button" name="save" class="btn btn-primary btn-lg" value="Save to database" id="butsave">
	</form>
</div>
</body>
EOT;
   echo "Yo you're logged in"; 
    }
?>
      <p>Log-out icon on a styled link button:
        <a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
      </p>

</html>