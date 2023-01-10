<?php
extract($_POST);
include("../class/users.php");
$quiz=new users;
$quiz->cat_shows();
// $qus=htmlentities($qus);
// $option1=htmlentities($op1);
// $option2=htmlentities($op2);
// $option3=htmlentities($op3);
// $option4=htmlentities($op4);
// $array=[$option1,$option2,$option3,$option4];
// $answer=array_search($ans,$array);
// $query="insert into questions values ('','$qus','$option1','$option2','$option3','$option4','$answer','$cat')";
// if($quiz->add_quiz($query))
// {
// 	$quiz->url("index.php?msg=run");
// 	//echo "Data inserted successfully";
// }

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
              <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="add_quiz.php">Quest-bank</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Overview
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Reports</a></li>
                <li><a class="dropdown-item" href="#">Analytics</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Export</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profile</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Settings</a></li>
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
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main">
          <h1 class="page-header">Add Question</h1>
       
          <div class="table-responsive">
            <table class="table table-striped">
			<?php

             if(isset($_GET['msg']) && !empty($_GET['msg']))
			 {
				 echo  "<mark>Data inserted successfully</mark>" ;
			 }

			?>
         <form method="post" action="add_quiz.php">    
    <div class="form-group">
      <label for="text">Question</label>
      <input type="text" class="form-control" name="qus" placeholder="Enter Question">
    </div>
	  
	  <div class="form-group">
      <label for="text">Option-1</label>
      <input type="text" class="form-control" name="op1" placeholder="Enter Option-1 ">
    </div>
	
    <div class="form-group">
      <label for="text">Option-2</label>
      <input type="text" class="form-control" name="op2" placeholder="Enter Option-2">
    </div>
	
    <div class="form-group">
      <label for="text">Option-3</label>
      <input type="text" class="form-control" name="op3" placeholder="Enter Option-3">
    </div>
	
	<div class="form-group">
      <label for="text">Option-4</label>
      <input type="text" class="form-control" name="op4" placeholder="Enter Option-4">
    </div>
	
	<div class="form-group">
      <label for="text">answer</label>
      <input type="text" class="form-control"  name="ans"placeholder="Enter answer">
  </div>
  <select class="form-select form-select-lg" aria-label="Default select example" name="category" ">
                    <option >select category</option>
                    <?php 
                      foreach($quiz->cat as $category1)
                      {?>
                    <option value="<?php echo $category1['category']; ?>" 
                      <?php if (isset($_POST['category']) && $_POST['category'] == $category1['category']) echo 'selected'; ?>>
                      <?php echo $category1['category']; ?>
                    </option>
                    <?php	 } ?>
				          </select><br>
   <button type="submit" class="btn btn-default">Submit</button><br>
  </form>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>