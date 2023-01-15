<?php 
include("../class/users.php");
$rank=new users;
$rank->cat_shows();


$conn = $rank->conn;

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
              <a class="nav-link " aria-current="page" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_quiz.php">Quest-bank</a>
            </li>
            <li class="nav-item ">    
              <a class="nav-link active" href="#">Rankings</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profile</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="crud_cat.php">Categories</a></li>
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
    <div class="d-flex justify-content-center">
    <div class="col-sm-10">
        <div class="d-flex justify-content-end">
            <form method="post" action="" class="col-sm-4">
                <br>
                <select class="form-select form-select-lg" aria-label="Default select example" name="category" onchange="this.form.submit()">
                    <option >select category</option>
                    <?php 
                    foreach($rank->cat as $category1)
                    {?>
                        <option value="<?php echo $category1['category']; ?>" 
                        <?php if (isset($_POST['category']) && $_POST['category'] == $category1['category']) echo 'selected'; ?>>
                        <?php echo $category1['category']; ?>
                        </option>
                    <?php	 } ?>
                </select><br>
            </form>
        </div>
        <table class="table table-striped">
        
            <thead>
                <tr>
                    <th scope="col" class="col-sm-2 text-center">Ranking</th>
                    <th scope="col" class="col-sm-4 text-center">Name</th>
                    <th scope="col" class="col-sm-3 text-center">Score</th>
                    <th scope="col" class="col-sm-3 text-center">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if (isset($_POST['category'])) {
                        $selected_category = $_POST['category'];
                        $result = $conn->query(" SELECT quiz_takers.score, quiz_takers.date, category.category, signup.name
                                                FROM quiz_takers 
                                                JOIN category ON quiz_takers.category_id = category.id 
                                                JOIN signup ON quiz_takers.taker_id = signup.id
                                                WHERE category.category='$selected_category'
                                                ORDER BY quiz_takers.score DESC");
                        $file = 0;
                        $prev = 0;
                        while($row = $result->fetch_assoc()){
                            if($file==0){
                                $file += 1;
                                echo '  <tr>
                                            <th scope="row" class="text-center">'.$file.'</th>
                                            <td class="text-center">'.$row["name"].'</td>
                                            <td class="text-center">'.$row["score"].'</td>
                                            <td class="text-center">'.$row["date"].'</td>
                                        </tr>';
                                $prev = $row['score'];
                            }else {
                                if($prev==$row['score']){
                                    echo '  <tr>
                                                <th scope="row" class="text-center">'.$file.'</th>
                                                <td class="text-center">'.$row["name"].'</td>
                                                <td class="text-center">'.$row["score"].'</td>
                                                <td class="text-center">'.$row["date"].'</td>
                                            </tr>';
                                    $prev = $row['score'];
                                }else {
                                    $file += 1;
                                    echo '  <tr>
                                                <th scope="row" class="text-center">'.$file.'</th>
                                                <td class="text-center">'.$row["name"].'</td>
                                                <td class="text-center">'.$row["score"].'</td>
                                                <td class="text-center">'.$row["date"].'</td>
                                            </tr>';
                                    $prev = $row['score'];
                                }
                            } 
                        }
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    </div>           
</body>
</html>