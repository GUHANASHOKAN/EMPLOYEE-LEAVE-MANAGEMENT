<?php

// Create connection
$con = new mysqli("localhost", "root"," ","reg");

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
$name = $_POST['myname'];
$sql = "INSERT INTO list(NAME) VALUES ('$name')";
$con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaveform</title>
    <link rel="stylesheet" href="leaveform.css">
</head>
<body>
  <form  method="post">
  <tr>
        <td><label>LEAVE TYPE</label></td>
        <td>
            <select id="country" name="myname">
              <option value="Annual" name="myname">Annual</option>
              <option value="Medical" name="myname">Medical</option>
              <option value="Hospitalisation" name="myname">Hospitalisation</option>
              <option value="Compassionate" name="myname">Compassionate</option>
              <option value="Marriage" name="myname">Marriage</option>
              <option value="Maternity" name="myname">Maternity</option>
              <option value="Replacement" name="myname">Replacement</option>
            </select>
          </td>
    </tr>
    <tr>
        <td><label>SELECT DATE</label></td>
        <td>
            <input type="datetime-local"
           id="Test_DatetimeLocal">
           <label class="range">To</label>
           <input type="datetime-local"
           id="Test_DatetimeLocal">
    </tr>
    <tr>
        <td><label>PERIOD OF LEAVE</label></td>
        <td>
            <input type="number" min="0">
          </td>
    </tr>
    <tr>
        <td><label>REASON</label></td>
        <td>
            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
          </td>
    </tr>
    <tr>
      <input type="submit"> 
    </tr>
  </form>
  
</body>
</html>