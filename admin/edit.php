<?php 
    include("../class/users.php");
    $cat=new users;
    $category = $cat->cat_shows();
    $conn=$cat->conn;
    $msg = "";
    if(isset($_POST['save'])){
        $catName = $_POST['catName'];
        $nameNow = $_GET['cat'];
        if($_POST['catName']!=null){
            $sql = "UPDATE category SET category ='$catName' WHERE id='$nameNow'";
            if($conn->query($sql)){
                $msg = "Category successfully updated";
            }
        }else {
            $msg = "Please enter a category name";
        }
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="icon" href="../7489484.png">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="..//css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  </head>
  <body>
    <nav class=" fixed-top  navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="col-11 container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">My Quiz</a>
            </div>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-right">
                <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="add_quiz.php">Quest-bank</a>
                </li>
                <li class="nav-item ">    
                <a class="nav-link" href="report.php">Rankings</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profile</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item " href="crud_cat.php">Settings</a></li>
                    <li>
                    <form action="logout.php" method="post">
                        <input type="submit" class="dropdown-item" href="#" name="logout" value="logout">
                    </form>
                    </li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    <div class="text-center"><h2 class="">Edit Category</h2><br></div>
    
    <div>
        <form action="" method="post">
            <div class="d-flex justify-content-center">
                <div class="form-group col-sm-6">
                    <input type="text" placeholder="Enter new category name" name="catName" class="form-control">
                </div>
                <div class="form-group col-sm-1">
                    <input type="submit" name="save" value="Save" class="btn-primary form-control">
                </div>
                <div class="form-group col-sm-1">
                    <input type="button" name="back" value="Back" class="btn-secondary form-control" onclick ="window.location.href='crud_cat.php'">
                </div>
            </div>
            <h5 class="text-center"><?php echo $msg; ?></h5>
            <div class="d-flex justify-content-center">
                   
            </div> 
        </form>
    </div>

  </body>
  </html>