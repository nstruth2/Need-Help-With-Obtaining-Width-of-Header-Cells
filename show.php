<style>
.mycssquote{
    color: blue;
    border:1px solid red;
    padding: 5px;
}

tr:nth-child(odd) { background: #00FFFF; 
} 

td {
border: 1px solid black; 
} 
table {
color: white; background-color: black; display:block; overflow-x: scroll; max-width: 300px; white-space: nowrap;
}
</style>
<?php
include 'database.php';
// Check connection

$query = "SELECT name, email, phone, city, language, sList, timeControl, dateControl FROM crud";

$result = $conn->query($query);

if ($result->rowCount() > 0) {
  // output data of each row

echo "<table id=\"myTable\">";
echo "<thead> <tr style=\"position: fixed; top: 0;\"><th>Name</th><th>EMail</th><th>Phone</th><th>City</th><th>Language</th><th>Checkboxes</th><th>Date</th><th>Time</th></tr></thead>";            
echo "<tbody>";         
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
 echo "<tr><td>" . htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8'). "</td><td>" . htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8') . "</td><td>" . htmlspecialchars($row["phone"], ENT_QUOTES, 'UTF-8') . "</td><td>" . htmlspecialchars($row["city"], ENT_QUOTES, 'UTF-8') . "</td><td>" . htmlspecialchars($row["language"], ENT_QUOTES, 'UTF-8') .  "</td><td>" . htmlspecialchars($row["sList"], ENT_QUOTES, 'UTF-8') . "</td>";

        if ($row["dateControl"] =="0000-00-00") {

        echo "<td>" . "nothing" . "</td>";

    }

    else {
    $date = new DateTime($row["dateControl"]);
echo "<td>" . htmlspecialchars($date->format('n/j/Y'), ENT_QUOTES, 'UTF-8') . "</td>";
}

if ($row['timeControl'] == NULL) {
    echo "<td>" . "nothing" . "</td>";
}
else {
$time = new DateTime($row["timeControl"]);
echo "<td>" . htmlspecialchars($time->format('g:i:s A'), ENT_QUOTES, 'UTF-8') . "</td>";
}
echo "</tr>";
}
echo "</tbody>";
echo "</table>";
} else {
  echo "0 results";
}
$title = "The title of my email";
$body = "This email will contain this";
$email = <<<heredocEmail
<div >
    <div >
        <h1>{$title}</h1>
        <p>{$body}</p>
    </div>
    <div id="right">What we offer</div>
</div>
heredocEmail;
echo $email;
echo "<p class=\"mycssquote\">This is a text in PHP echo.</p>";
?>