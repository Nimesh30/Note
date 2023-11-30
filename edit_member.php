<?php

$conn = mysqli_connect("localhost", "root", "", "notes");

if (!$conn) {
    die("Failed to connect " . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "SELECT * FROM `notes` WHERE sno = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);



if (isset($_POST["update"])) {
    $title = $_POST["title"];
    $discription = $_POST["desc"];
    $sno = $row['sno'];

    echo $title, '', $discription, '', $sno, '';

    $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$discription' WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    header("location:index.php");

    // if ($result) {
    //     echo "insert";
    //     $sql = "SELECT * FROM `notes` WHERE sno = '$id'";
    //     $result = mysqli_query($conn, $sql);
    //     $row = mysqli_fetch_array($result);
    //     $insert = true;

    // } else {
    //     echo "asnkdfjhkjhdfjfkakfsaskafshajak";
    //     $insert = false;
    // }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <style>
    .form1{
        margin:20px 70% 150px 50px;
    }
 </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP Notes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <form class="form1 " action="/notes/index.php" method="post">
        <div class="mb-3">
            <label for="title" id="title" name="title" class="form-label">Title </label>
            <input type="text" class="form-control" id="title" name="title"
                value="<?php echo (isset($row["title"])) ? $row["title"] : 'qqqqq'; ?>">
        </div>

        <div class="form-group">
            <label for="desc">Description</label>
            <input type="text" name="desc" id="" class="form-control"
                value="<?php echo (isset($row["description"])) ? $row["description"] : 'ppppppp'; ?>"><br>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add Note </button>
  
    </form>

    <!-- <a href="test.php">Back</a>
     -->


</body>

</html>