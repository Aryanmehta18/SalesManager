<?php
    session_start();
    if(isset($_SESSION['user'])) header('location: dashboard.php');
     $error_message = '';
    if ($_POST) {
        include('database/connection.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = 'SELECT * FROM users WHERE users.email="' . $username . '" AND users.password="' . $password . '"';
        $stmt = $conn->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
           $stmt->setFetchMode(PDO::FETCH_ASSOC);
           $user = $stmt->fetchAll()[0]; // Assign fetched user data to $user
           $user['permissions']=explode(',',$user['permissions']);
           $_SESSION['user'] = $user; // Store user data in session
           header('Location: dashboard.php'); // Redirect to dashboard
           exit(); // Stop further execution
        } else {
            $error_message = 'Please make sure that username and password are correct';
        }
    }
?>




<!DOCTYPE html>
<html>

<head>
    <title>SMS Login-Sales Management System</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>


<body id="loginBody">
    <?php
        if(!empty($error_message)){ ?>
        <div id="errorMessage">
        <strong>ERROR:</strong></p> <?=$error_message?> </p>
</div> <?php
        }
    ?>
    
    
    <div class="container">
       
            <div class="loginHeader">
                <h1>SalesMate</h2>
                    <p>Sales Management System</p>


            </div>
            <div class="loginBody">
                <form action="login.php" method="POST">
                    <div class="loginInputsContainer">
                        <label for="">Username</label>
                        <input placeholder="username" name="username" type="text"/>
                        
                    </div>
                    <div class="loginInputsContainer">
                        <label for="">Password</label>
                        <input placeholder="password" name="password" type="text" />
                       
                    </div>
                    <div class="loginButtonContainer">
                        <button>
                            Login
                        </button>
                    </div>

                </form>
            </div>
        
    </div>

</body>

</html>