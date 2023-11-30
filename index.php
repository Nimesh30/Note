<?php
$insert = false;
$conn = mysqli_connect("localhost", "root", "", "notes");

if (!$conn) {
  die("Failed to connect " . mysqli_connect_error());
}

// if ($_SERVER["REQUEST_METHOD"] == "POST")
if (isset($_POST["submit"])) {
  $title = $_POST["title"];
  $discription = $_POST["desc"];

  $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ( '$title', '$discription')";
  $result = mysqli_query($conn, $sql);

  if ($result) {

    $insert = true;
  } else {
    $insert = false;
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>


  <style>
    .form1 {
      padding-right: 100px;
      padding-left: 150px;
      /* padding-top: 50px;   */
    }

    .container1 {
      margin-left: 160px;
      margin-right: 160px;
    }

    h2 {
      margin-top: 30px;
      margin-bottom: 30px;
    }

    .container {
      margin-left: 20px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PHP Notes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

  <?php

  if ($insert) {

    echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Note is inserted...</strong> .
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
  } else {
    echo " <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Note is not insert...</strong> You should check Again...
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
  }

  ?>

  <div class="container">

    <form class="form1" action="/notes/index.php" method="post">
      <h2>Hey Nimesh, Please add Note and continue your Work </h2>
      <div class="mb-3">
        <label for="title" id="title" name="title" class="form-label">Title </label>
        <input type="text" class="form-control" id="title" name="title">
      </div>

      <div class="form-group">
        <label for="desc">Description</label>
        <textarea class="form-control" id="desc" name="desc"></textarea>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Add Note </button>
    </form>
  </div>

  <div class="container1 my-4">
    <!-- <?php

    $sql = "SELECT * FROM `notes`";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
      echo $row['sno'] . ".  title  " . $row['title'] . ". description  is " . $row['description'];
      echo "<br>";
    }


    ?>  -->

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
                     <th scope='row'>" . $sno . "</th>
                     <td>" . $row['title'] . "</td>
                     <td>" . $row['description'] . "</td>
                     <td><a href='edit_member.php?id= ".$row['sno']."'><button type='submit' name='update'>update</button> </a>
                         <a href='delete_member.php?id= ".$row['sno']."'><button type='submit' name='delete'>Delete</button></a>
                     </td>
                   </tr>";

        }

        ?>


      </tbody>
    </table>
  </div>
  <hr>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script>
    let table = new DataTable('#myTable');
  </script>
</body>

</html>


<!-- 
<?php

$sql = "SELECT * FROM `notes`";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>
                     <th scope='row'>" . $row['sno'] . "</th>
                     <td>" . $row['title'] . "</td>
                     <td>" . $row['description'] . "</td>
                     <td>Actions</td>
                   </tr>";

}
?>
               -->







<!-- <a href='/edit'>Edit</a>         
                     <a href='/delete'>Delete</a> -->