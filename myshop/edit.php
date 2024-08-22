<?php
$username = "localhost";
$servername = "root";
$password = "";
$database = "myshop";
$connection = mysqli_connect($username, $servername, $password, $database);

$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET METHOD: SHOW THE DATA OF THE CLIENTS

    if (!isset($_GET["id"])) {
        header("location: /myshop/index.php");
        exit;
    }

    $id = $_GET["id"];
    // read the row of the selected clients from the database table
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /myshop/index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
} else {
    // post method: update the data of the clients
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }
        $sql = "UPDATE clients SET name= '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = '$id'";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query:" . $connection->error;
            break;
        }

        $successMessage = "Clients updated correctly";
        header("location:/myshop/index.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container my-5">
    <h2>Edit Client</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        </div>
        ";
    }
    ?>

    <form method="post" action='/myshop/edit.php'>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="address" class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            ";
        }
        ?>
 <div class="form-group row">
        <div class="offset-sm-3 col-sm-6">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary ml-2" href="/myshop/index.php" role="button">Cancel</a>
        </div>
    </div>
    </form>
</div>
</body>
</html>
