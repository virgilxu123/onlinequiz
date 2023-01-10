<?php 
include("../class/users.php");
$cat=new users;
$category=$cat->cat_shows();
//print_r($category);

$conn = $cat->conn;
$today = Date('Y-m-d');
$sql = "SELECT * FROM quiz_takers WHERE date='$today'";
$result = $conn->query($sql);
$numberOfQuizAnsweredToday = $result->num_rows;
$row = $result->fetch_assoc();

$result2 = $conn->query("SELECT COUNT(DISTINCT taker_id) AS num_rows FROM quiz_takers WHERE date='$today'");
$row2 = $result2->fetch_assoc();
$numberOfTakersToday = $row2['num_rows'];

$result3 = $conn->query("SELECT COUNT(DISTINCT taker_id) AS num_rows FROM quiz_takers");
$row3 = $result3->fetch_assoc();
$totalNumberOfTakers = $row3['num_rows'];

$average ="";
$numberOfTakes="";
if (isset($_POST['category'])) {
  $score = 0;
  $selected_category = $_POST['category'];
  $result4 = $conn->query(" SELECT quiz_takers.score, category.category
                            FROM quiz_takers 
                            INNER JOIN category ON quiz_takers.category_id = category.id 
                            WHERE category.category='$selected_category'");
  while ($row4 = $result4->fetch_assoc()) {
    $score += $row4['score'];
  }
  $numberOfTakes = mysqli_num_rows($result4);
  if($numberOfTakes!=0){
    $average = $score / $numberOfTakes;
    $average =  number_format($average, 2);
  }else {
    $average = 0;
  }
  
}
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
              <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_quiz.php">Quest-bank</a>
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
    <div  class="dashboard">
      <div class="text-center my-5">
        <h2 class="ms-5">DASHBOARD</h2>
      </div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-4">
            <div class="card text-center card1">
              <?php 
                $date = date("Y-m-d");
                $formatted_date = strftime("%B %d, %Y", strtotime($date));
                $formatted_date = ucwords($formatted_date);
                echo '<h6>'.$formatted_date.'<br>'.'</h6>';
                echo '<h1>'.$numberOfQuizAnsweredToday.'<br>'.'</h1>';
                echo '<h4>Number of Answered Quizes Today</h4>';
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center card2">
              <?php 
                $date = date("Y-m-d");
                $formatted_date = strftime("%B %d, %Y", strtotime($date));
                $formatted_date = ucwords($formatted_date);
                echo '<h6>'.$formatted_date.'<br>'.'</h6>';
                echo '<h1>'.$numberOfTakersToday.'<br>'.'</h1>';
                echo '<h4>Number of Takers Today</h4>';
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center card3">
              <?php 
                $date = date("Y-m-d");
                $formatted_date = strftime("%B %d, %Y", strtotime($date));
                $formatted_date = ucwords($formatted_date);
                echo '<h6>'.$formatted_date.'<br>'.'</h6>';
                echo '<h1>'.$totalNumberOfTakers.'<br>'.'</h1>';
                echo '<h4>Total Number of Participants</h4>';
              ?>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-12 card4">
            <div class=" text-start d-flex align-items-center">
              <div class="col-sm-6">
                <h3 class="my-5"><?php echo "Quiz Overview";?></h3>
              </div>
              <div class="col-sm-6 d-flex align-items-center my-5 justify-content-end">
                <form method="post" action="">
                  <select class="form-select form-select-lg" aria-label="Default select example" name="category" onchange="this.form.submit()">
                    <option >select category</option>
                    <?php 
                      foreach($cat->cat as $category1)
                      {?>
                    <option value="<?php echo $category1['category']; ?>" 
                      <?php if (isset($_POST['category']) && $_POST['category'] == $category1['category']) echo 'selected'; ?>>
                      <?php echo $category1['category']; ?>
                    </option>
                    <?php	 } ?>
				          </select><br>
								</form>
              </div>
            </div>
            <div class="mb-5">
              <div class="col-sm-6">
                <h4 class="d-inline" ><i class='fas fa-user-friends' style='font-size:24px;color:blue'></i> Number of Takers:</h4>
                <h1 class="d-inline" >&nbsp&nbsp<?php echo $numberOfTakes;?></h1>
              </div>
              <div class="col-sm-6">
                <h4 class="d-inline"><i class='fas fa-calculator' style='font-size:24px;color:orange'></i> Average Score:</h4>
                <h1 class="d-inline">&nbsp&nbsp<?php echo $average;?></h1>
                <br><br><br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages will load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>

    <script>
      $('.nav-link').click(function() {
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
      });
    </script>
  </body>
</html>
