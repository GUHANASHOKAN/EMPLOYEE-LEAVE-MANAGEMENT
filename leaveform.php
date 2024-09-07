<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$empname=$name = $email = $email1= $contact =$reason= "";
$empname_err=$name_err = $email_err = $email1_err= $contact_err = $reason_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    $input_empname = trim($_POST["empname"]);
    if(empty($input_empname)){
        $empname_err = "Please enter a name.";
    } elseif(!filter_var($input_empname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $empname_err = "Please enter a valid name.";
    } else{
        $empname = $input_empname;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an date.";     
    } else{
        $email = $input_email;
    }
    $input_email1 = trim($_POST["email1"]);
    if(empty($input_email1)){
        $email1_err = "Please enter an date.";     
    } else{
        $email1 = $input_email1;
    }
    
    // Validate contact
    $input_contact = trim($_POST["contact"]);
    if(empty($input_contact)){
        $contact_err = "Please enter the contact number.";     
    } elseif(!ctype_digit($input_contact)){
        $contact_err = "Please enter a value.";
    } else{
        $contact = $input_contact;
    }
    $input_reason = trim($_POST["reason"]);
    if(empty($input_reason)){
        $reason_err = "Please enter the reason for leave.";     
    } elseif(empty($input_reason)){
        $reason_err = "Please enter  value.";
    } else{
        $reason = $input_reason;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($contact_err) && empty($reason_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO leaveform (leavetype, Startingdate, Endingdate , Noofdays,Reason,empname) VALUES (?, ?, ? ,? ,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssiss", $param_name, $param_email, $param_email1, $param_contact,$param_reason,$param_empname);
            
            // Set parameters
            $param_empname = $empname;
            $param_name = $name;
            $param_email = $email;
            $param_email1 = $email1;
            $param_contact = $contact;
            $param_reason = $reason;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: home.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        body{
            background: linear-gradient(white,#cceef1,#b1ecf0);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Leave Forn</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                            <label>NAME</label>
                            <input type="text" name="empname" class="form-control <?php echo (!empty($empname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $empname; ?>">
                            <span class="invalid-feedback"><?php echo $empname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>TYPE OF LEAVE</label>
                            <select id="country" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                    <option disabled hidden selected>Select One</option>
                                    <option value="Annual" name="name">Annual</option>
                                    <option value="Medical"  name="name">Medical</option>
                                    <option value="Hospitalisation"  name="name">Hospitalisation</option>
                                    <option value="Compassionate"  name="name">Compassionate</option>
                                    <option value="Marriage"  name="name">Marriage</option>
                                    <option value="Maternity"  name="name">Maternity</option>
                                    <option value="Replacement"  name="name">Replacement</option>
            </select>

                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>STARTING DATE</label>
                            <input type="date" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"><?php echo $email; ?></input>
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>ENDING DATE</label>
                            <input type="date" name="email1" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"><?php echo $email1; ?></input>
                            <span class="invalid-feedback"><?php echo $email1_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>NO OF DAYS</label>
                            <input type="number" name="contact" class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>">
                            <span class="invalid-feedback"><?php echo $contact_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>REASON</label>
                            <textarea type="text" name="reason" class="form-control <?php echo (!empty($reason_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $reason; ?>"></textarea>
                            <span class="invalid-feedback"><?php echo $reason_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="home.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

