<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body >
    <h1>Team-Mates Leave History</h1>
    



<?php
                    // Include config file
                    require_once "config.php";
                    session_start(); 
      $res=$ans=$_SESSION['name'];
      
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM leaveform";
                    if($result = mysqli_query($link, $sql)){
                      
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>TYPE OF LEAVE</th>";
                                        echo "<th>STARTING DATE</th>";
                                        echo "<th>ENDING DATE</th>";
                                        echo "<th>NO OF DAYS</th>";
                                        echo "<th>REASON</th>";
                                        echo "<th>STATUS</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                 
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['leavetype'] . "</td>";
                                        echo "<td>" . $row['Startingdate'] . "</td>";
                                        echo "<td>" . $row['Endingdate'] . "</td>";
                                        echo "<td>" . $row['Noofdays'] . "</td>";
                                        echo "<td>" . $row['Reason'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="leaveformread.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>

</body>
</html>