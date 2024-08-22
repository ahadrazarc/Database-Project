<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        h2 {
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .btn-sm {
            margin: 2px;
        }

        .btn-new-client {
            margin-top: 20px;
            background-color: #28a745;
            border-color: #28a745;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-new-client:hover {
            background-color: #218838;
        }

        .btn-edit {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #343a40;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            border-color: #e0a800;
            color: #343a40;
        }

        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        
    </style>
</head>

<body>
    <div class="container my-5">
        <h2>Client List</h2>
        <a class="btn btn-primary btn-new-client" href="/myshop/create.php" role="button">Add New Client</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "myshop";

                // create connection
                $connection = mysqli_connect($servername, $username, $password, $database);
                // check connection
                if($connection->connect_error)
                {
                    die("Connection Failed:" . $connection->connect_error);
                }
                // read all row from database table
                $sql="SELECT * FROM clients";
                $result = $connection->query($sql);
                if(!$result)
                {
                    die("Invalid Query:".$connection->error);
                }

                // read data of each row
                while($row = $result->fetch_assoc())
                {
                    echo"
                <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/myshop/edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/myshop/delete.php?id=$row[id] '>Delete</a>
                    </td>
                </tr>
                    ";
                }
                ?>
               
            </tbody>
        </table>
    </div> 
</body>
</html>
