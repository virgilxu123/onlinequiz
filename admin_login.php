    <?php

        $conn = new mysqli("localhost", "root", "", "quiz_oops");

        $login_err="";
        if(isset($_POST['signin'])) {
            $sql = 'SELECT name,password FROM admin WHERE name=?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $param_name);
            if(empty($_POST['name']) || empty($_POST['p'])) {
                $login_err="Please enter username and password";
            }else {
                $param_name = trim($_POST["name"]);
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows() == 1){
                    $stmt->bind_result($name, $password);
                    $stmt->fetch();
                    if($_POST["p"]==$password){
                        $_SESSION["loggedin"] = true;
                        $_SESSION["name"] = $name;

                        header("location: admin/index.php");
                    }else {
                        $login_err = "Incorrect password";
                    }
                }else {
                    $login_err = "Username does not exist";
                }
            }
        }
    
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Admin Login</title>
        <script type="text/javascript">
  
  $(document).ready(function() {

    $(document)[0].oncontextmenu = function() { return false; }

    $(document).mousedown(function(e) {
        if( e.button == 2 ) {
            alert('Sorry, this functionality is disabled!');
            return false;
        } else {
            return true;
        }
    });
});
  </script>
    </head>
    <body>
        
        <div class="row justify-content-md-center my-5">
            <div class="panel col-sm-4 my-5 px-0 rounded-3" style="border-color: #bce8f1;">
                <div class="panel-heading mx-0" style="background-color:#d9edf7;">
                    <h2 class="mt-0 mx-0">Admin Login</h2>
                </div>
                <div class="panel-body">
                    <p class="text-danger"><?php echo $login_err;?></p>
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="email">Username:</label>
                            <input type="text" class="form-control" name="name" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" name="p" id="pwd">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox"> Remember me</label>
                        </div>
                        <input type="submit" value="Login" class="btn btn-primary " name="signin" >
                    </form>
                </div>   
            </div>
            <center><a href="index.php" class="btn btn-default ">Back</a></center>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="js/bootstrap.min.js"></script>
    </body>
    </html>
    
    
    