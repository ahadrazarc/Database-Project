<?php
 $username = "localhost";
 $servername = "root";
 $password = "";
 $database = "myshop";


$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

$connection = mysqli_connect($username, $servername, $password, $database);

// check connection
if($connection->connect_error)
{
    die("Connection Failed:" . $connection->connect_error);
}
if( $_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do{
        if( empty($name) || empty($email) || empty($phone) || empty($address))
        {
            $errorMessage = "All the fields are required";
            break;
        }

        // add new clients to database
        $sql = "INSERT INTO clients(name, email, phone, address)" . "VALUES ('$name','$email','$phone','$address')";
        $result = $connection->query($sql);

        if(!$result)
        {
            $errorMessage = "Invalid Query:" . $connection->error;
            break;
        }
        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Client Added Successfully";
        header("location: /myshop/index.php");
        exit;
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h2>New Clients</h2>
    
    <?php
    if (!empty($errorMessage))
    {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
     ?>
    <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
        </div>
        
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone</label>
            <div class="col sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
            </div>
        </div>


        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>
        </div> 


        <?php
             if (!empty($successMessage))
             {
                 echo "
                 <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$sucessMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                 ";
              }
        ?>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</body>
</html> 