<?php
//Code for 'Register' panel starts.

    include 'dbconnect.php';

    //Initializing variables
    $email_err = $pws_err = $success = $error = "";

    if( isset($_POST['submit']) ) {     //'submit' is the name of the REGISTER button.
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        /*  Passwords in database should be encrypted and not visible in original characters. For security.
            If you open the database and view the data in 'password' and 'cpassword' rows, it will be encrypted(There will be
            various random letters/characters instead of actual password.)
        */
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

        /* If a user has already registered with an email, we will have to stop him from registering
           again.'register' is the table name.
        */
        $query = "select * from register where email = '$email' ";
        $run = mysqli_query($conn,$query);  // $conn is defined in dbconnect.php . 
        $row = mysqli_num_rows($run);

        if($row>0) {
            $email_err ="Email ID already exists. Please register with another email";
        }

        //Data entered in 'Password' and 'Confirm Password' on Register panel must be same.
        else if($password !== $cpassword){
            $pws_err = "Your password does not match.";
        }

        else{   //If user registers with a new email and the password matches, proceed with registering the user.
            /*name, email etc are names of table rows.   $fname, $email are above declared variables. Here, encrypted variables of 'Password'
             and 'Confirm Password' is sent. */
            $sql = "insert into register(fname, email, password, cpassword) values( '$fname' , '$email' , '$pass' , '$cpass' )";
            $run = mysqli_query($conn, $sql);

            if($run){
                $success="Registered successfully.";
            }
            else{
                $error="Registration failed. Please try again.";
            }
        }

    }

//Code for 'Register' panel ends.

//Code for 'Login' panel is at the bottom
?>




<!DOCTYPE html>
<html>
<head>
     
    <title> STUDENT MANAGEMENT SYSTEM </title>


    <!-- For ensuring proper rendering and touch zooming in mobile devices, add below Bootstrap4 line -->
    <!-- Below Bootstrap line enables the page to automatically adapt to different device sizes -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Including Bootstrap4 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Linking CSS File-->
    <link rel="stylesheet" type="text/css" href="style.css"> 

    <!-- content1() is linked with register button, it displays all the elements inside "div1" ie the register form and doesnt display  the elements div2 ie login form-->
    <!-- content2() is linked with login button, it displays all the elements inside "div2" ie the login form and doesnt display  the elements div2 ie register form-->
    <script>
        function content1(){
            document.getElementById("div1").style.display="block";
            document.getElementById("div2").style.display="none";
        }
                    
        function content2(){
            document.getElementById("div1").style.display="none";
            document.getElementById("div2").style.display="block";
        }
    </script> 

</head>


<body>
    <section>   
        <h2 class="text-center text-danger font-weight-bold pt-3 pb-4"> STUDENT MANAGEMENT SYSTEM </h2>

        <!-- The below line will show a message at the top if the login details are incorrect -->
        <p class="text-center text-danger font-weight-bold"><?php echo @$_GET['error']?> </p>

        <div class="container bg-danger mt-3" id= "formsetting"> <!--container starts here. This div will contain the Login Panel.-->
            <h3 class="text-white text-center py-3"> ADMIN LOGIN | REGISTER PANEL</h3>
            <div class="row">  <!--row starts here-->
                <!-- col attribute is used to make the page responsive/ make the page adapt automatically  to differnt device sizes-->
                <div class="col-md-7  col-sm-7 col-12">
                    <img src="images/sms.jpg" class="img-fluid pb-3 pl-3 ">
                </div>

                <div class="col-md-5  col-sm-5 col-12"> <!--start of column div-->

                    <button class="btn btn-info px-5" onclick="content1()"> Register </button>
                    <button class="btn btn-info ml-2 px-5" onclick="content2()"> Login </button>

                    <div id="div1" style="display:block" class="mt-4"> <!-- REGISTER div - div1 starts -->
                        <form method="post" action="">

                            <div class="form-group">
                                <label class="text-white">Full Name</label>
                                <!-- form-control pushes the input box to the next line--> 
                                <input type="text" name="fname" placeholder="Enter your name" class="form-control" required="required"> 
                            </div>

                            <div class="form-group">
                                <label class="text-white">Email</label>
                                <!-- span will show error messages below the email area box -->
                                <span class="float-right text-white font-weight-bold"> <?php echo $email_err; ?> </span> 
                                <!-- form-control pushes the input box to the next line--> 
                                <input type="email" name="email" placeholder="Enter your email" class="form-control" required="required"> 
                            </div>

                            <div class="form-group">
                                <label class="text-white">Password</label>
                                <!-- form-control pushes the input box to the next line--> 
                                <input type="password" name="password" placeholder="Enter your password" class="form-control" required="required"> 
                            </div>

                            <div class="form-group">
                                <label class="text-white">Confirm Password</label>
                                <span class="float-right text-white font-weight-bold"> <?php echo $pws_err; ?> </span>
                                <!-- form-control pushes the input box to the next line--> 
                                <input type="password" name="cpassword" placeholder="Re-enter your password" class="form-control" required="required"> 
                            </div>

                            <input type="submit" name="submit" value="Register" class="btn btn-success px-5">
                            <span class="float-right text-white font-weight-bold"> <?php echo $success; echo $error; ?> </span>

                        </form>
                    </div> <!-- REGISTER div - div1 ends -->

                    <div id="div2" style="display:none;" class="mt-4"> <!-- LOGIN div- div2 starts -->
                        <form method="post" action="">

                            <div class="form-group">
                                <label class="text-white">Email</label> 
                                <input type="email" name="email" placeholder="Enter your email" class="form-control"> 
                            </div>

                            <div class="form-group">
                                <label class="text-white">Password</label> 
                                <input type="password" name="password" placeholder="Enter your password" class="form-control"> 
                            </div>

                            <input type="submit" name="submit1" value="Login" class="btn btn-success px-5">

                        </form>
                    

                    </div> <!-- LOGIN div- div2 ends -->


                </div> <!-- End of column div-->

            </div> <!-- Row ends here -->

        </div> <!-- Container ends here -->

                        


    </section>

</body>

</html>




<?php
//Code for 'Login' panel starts.

if( isset($_POST['submit1']) ) {

    $email = $_POST['email'];
    $pwd = $_POST['password'];

    $sql = "select * from register where email= '$email' ";  //email(without quotes) im this line is a row in the table.
    $run = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($run);

    $pwd_fetch = $row['password'];
    $pwd_decode = password_verify($pwd, $pwd_fetch);

    if($pwd_decode) {
        //If login is successful, we'll be redirected to main.php and a success message will be given.
        echo "<script>window.open('main.php?success=Logged in successfully as an administrator' , '_self')</script> "; 
    }
    else{
        //If login is unsuccessful, we'll be kept at same page(index.php) and an error message will be given at the top.
        echo "<script>window.open('index.php?error=Username or password is incorrect' , '_self')</script> ";
        
    }

} //End of if

?>