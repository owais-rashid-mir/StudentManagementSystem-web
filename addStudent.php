<?php 

    //Connecting with database.
    include 'dbconnect.php';

    // 'submit' is the button name.
    if( isset( $_POST['submit']) ) {
        $fname = mysqli_real_escape_string($conn , $_POST['fname']);
        $lname = mysqli_real_escape_string($conn , $_POST['lname']);
        $email = mysqli_real_escape_string($conn , $_POST['email']);
        $fathername = mysqli_real_escape_string($conn , $_POST['fathername']);
        $birthdate = mysqli_real_escape_string($conn , $_POST['birthdate']);
        $gender = mysqli_real_escape_string($conn , $_POST['gender']);
        $city = mysqli_real_escape_string($conn , $_POST['city']);
        $district = mysqli_real_escape_string($conn , $_POST['district']);
        $nationality = mysqli_real_escape_string($conn , $_POST['nationality']);
        $state = mysqli_real_escape_string($conn , $_POST['state']);
        $mobile = mysqli_real_escape_string($conn , $_POST['mobile']);
        $image = $_FILES['image']['name'];

        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_tmp = $_FILES['image']['tmp_name'];

            //Validating image.
            if(!$image_type == 'image/jpg' or !$image_type == 'image/png') {
                $match_err = "Either you have not selected a file or the image format is invalid (Please upload the image in jpg or png format).";
            }

            else if($image_size <= 2000) {   //2000 = 2 MB
                $size_error = "Image size is larger. Image size should be less than or equal to 2 MB.";
            }

            else{
                // 'uploadedImages' is the folder name. Images will be moved to this folder after being uploaded.
                move_uploaded_file($image_tmp, "uploadedImages/$image");
                

                /* student_detail is the table name. fname, lname etc are the fields in this table. $fname, $lname etc are the variable names. */
                $sql = "insert into student_detail(fname, lname, father_name, email, mobile, birthdate, gender, district, city, state, nation, photo) values('$fname' , '$lname' , '$fathername' , '$email' , '$mobile' , '$birthdate' , '$gender' , '$district' , '$city' , '$state' , '$nationality' , '$image')";

                $run = mysqli_query($conn , $sql);
                if($run){
                    $success = "Student data submitted successfully.";
                }

                else{
                    $error = "Unable to submit data. Please try again.";
                }
            }
    } //end of first 'if'
    
?>




<!DOCTYPE html>

<html>

<head>

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

    <!-- 'Font Awesome' icons - Copy the link from w3schools.com-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

    <!-- Linking CSS File -->
    <link rel="stylesheet" type="text/css" href="styleForMain.css">

    <!-- For expanding and hiding the sidebar on clicling the hamburger icon. -->
    <script>

        jQuery(document).ready(function($) {
            $('#toggler').click(function(event) {
                event.preventDefault();
                $('#wrap').toggleClass('toggled');
             });
        });

    </script>

</head>


<body>

    <!-- Creating a sidebar with hamburger icon. -->
    <div class="d-flex" id="wrap">

        <div class="sidebar bg-light border-light">
            <div class="sidebar-heading">
                <p class="text-center text-dark">Manage Students</p>
            </div>

            <ul class="list-group list-group-flush">
                <a href="main.php" class="list-group-item list-group-item-action">
                    <!-- Using 'Font Awesome' icons -->
                    <i class="fa fa-vcard-o text-danger mr-2"></i>DashBoard
                </a>

                <a href="addStudent.php" class="list-group-item list-group-item-action">
                    <!-- fa-user is the icon name - Defined in FONT AWESOME.  -->
                    <i class="fa fa-user text-danger mr-2"></i> Add Student
                </a>

                <a href="viewStudent.php" class="list-group-item list-group-item-action">
                    <!-- fa-eye is the icon name. Creates an eye icon - Defined in FONT AWESOME.  -->
                    <i class="fa fa-eye text-danger mr-2"></i>View Student
                </a>

                <a href="editStudent.php" class="list-group-item list-group-item-action">
                    <i class="fa fa-pencil text-danger mr-2"></i>Edit Student
                </a>

                <a href="logout.php" class="list-group-item list-group-item-action">
                    <i class="fa fa-sign-out text-danger mr-2"></i>Logout
                </a>

            </ul>

        </div>

        <!-- Code for Hamburger icon button-->
        <div class="main-body">
            <button class="btn btn-outline-light bg-danger mt-3" id="toggler"> 
                <i class="fa fa-bars"> </i>
            </button>
        


            <!-- Code for main form/screen -->
            <section id="main-form">

                <!-- For displaying error messages (related to images) .-->
                <span class="text-center text-success font-weight-bold"><?php echo @$size_error; echo @$match_err ?> </span>

                <h2 class="text-center text-danger font-weight-bold"> Student Management System </h2>
                <div class="container bg-danger pt-2" id="formsetting">
                    <h3 class="text-center text-white pb-4 pt-2 font-weight-bold">Add Student Detail</h3>

                    <!-- enctype - for uploading photos to the database. -->
                    <form method="post" action="" enctype="multipart/form-data">

                        <div class="row">

                            <!--grid system is 12 units long, we will use 2 units of lenghth 5 each(for large and medium devices), and spare the 2 units left for better padding-->
                            <!-- m-auto will bring the div to center -->
                            <div class="col-md-5 col-sm-5 col-12 m-auto">

                                <div class="form-group">
                                    <label class="text-white">First Name</label>
                                    <input type="text" name="fname" placeholder="Enter the first name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="text-white">Father's Name</label>
                                    <input type="text" name="fathername" placeholder="Enter the father's name" class="form-control">
                                </div>

                                <div class="form-group pt-2">
                                    <label class="text-white">Gender</label>
                                    <input type="radio" name="gender" value="male" checked="checked" class="form-check-input ml-2">
                                    <label class="form-check-label text-white pl-4">Male</label>
                                      
                                    <input type="radio" name="gender" value="female" class="form-check-input ml-2">
                                    <label class="form-check-label text-white pl-4">Female
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="text-white">Email</label>
                                    <input type="text" name="email" placeholder="Enter the E-mail" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="text-white">City</label>
                                    <input type="text" name="city" placeholder="Enter the City" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="text-white">Nationality</label>
                                    <input type="text" name="nationality" placeholder="Enter the Nationality" class="form-control">
                                </div>

                            </div>


                            <div class="col-md-5 col-sm-5 col-12 m-auto">
                            

                                <div class="form-group">
                                    <label class="text-white">Last Name</label>
                                    <input type="text" name="lname" placeholder="Enter the last name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="text-white">Date Of Birth</label>
                                    <input type="date" name="birthdate" placeholder="Enter the D.O.B" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="text-white">Contact Number</label>
                                    <input type="Number" name="mobile" placeholder="Enter the Number" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="text-white">District</label>
                                    <input type="text" name="district" placeholder="Enter the district" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="text-white">State</label>
                                    <input type="text" name="state" placeholder="Enter the state" class="form-control">
                                </div>


                                <!-- Inserting an image into the database.-->
                                <div class="input-group pt-4">
                                    <label class="text-white pt-1 pr-1">Image</label> 
                                    <div class="input-group-prepend"> <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div> 
                                         
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                                        <label class="custom-file-label" for="inputGroupFile01"> Choose File
                                        </label>
                                    </div>                             
                                             
                                </div>

                                <input type="submit" name="submit" value="Add Detail" class="btn btn-success px-5 mt-4 mx-auto">

                                
                                <!-- For displaying error and success messages at the bottom.-->
                                <span class="text-center text-success font-weight-bold"><?php echo @$success; echo @$error?> </span>

                            </div>


                        </div> 

                    </form>


                </div>

            </section>

        </div>
    </div>

</body>
 
</html>



<script>
	//Solution for - error or success messages remains on the page even after reloading the page.
	if(window.history.replaceState) {
		window.history.replaceState(null ,null, window.location.href);
	}
</script>





