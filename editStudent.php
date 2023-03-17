<?php
    //Connecting with database.
    include 'dbconnect.php';
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
        


            <!-- Code for main form/section -->
            <section id="main-form">

                

                <h2 class="text-center text-danger font-weight-bold"> Student Management System </h2>
                <div class="container bg-danger pt-2" id="formsetting">
                    <h3 class="text-center text-white pb-4 pt-2 font-weight-bold">Edit Student Details</h3>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-12 m-auto">
                            <table class="table table-bordered  text-white table-responsive text-dark bg-white">
                                <thead class="bg-dark text-warning">
                                    <tr>
                                        <th>Serial.No</th> 
                                        <th>Action</th> 
                                        <th>First name</th>
                                        <th>Last Name</th>
                                        <th>Father Name</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Birthday</th>
                                        <th>Mobile</th>
                                        <th>City</th>
                                        <th>District</th>
                                        <th>State</th>
                                        <th>Nationality</th>
                                        <th>Photo</th>        
                                    </tr>
                                </thead>


                                <!-- fetching data from mysql using php code -->
                                <?php 
                                    $sql = "select * from student_detail";
                                    $run = mysqli_query($conn , $sql);

                                    // $i is a variable which will keep track of the serial number.
                                    /* If you don't use this variable, the serial number will be displayed acc. to the id's in the database (Database IDs are non-consecutive if you have deleted some fields.) */
                                    $i=1;

                                    // we need to use a loop to fetch all the data entries entered into the database.
                                    while($row = mysqli_fetch_assoc($run))
                                    {  //Closing tag is placed after Table body.


                                ?>


                                <!-- Table body. -->
                                <tbody class="text-center">
                                    <tr>
                                        <!-- fname, lname, photo etc are names of database fields. -->
                                        <td class="bg-dark text-warning text-center"> <?php echo $i++; ?></td>  <!-- for ID -->

                                        <!-- Editing and deleting students. -->
                                        <!-- edit_student n delete_student are variables. st_id is the field name in DB. -->
                                        <td>
                                            <a href="edit_student_detail.php?edit_student=<?php echo $row['st_id']; ?>">Edit</a> | 
                                            <a href="delete_student_detail.php?delete_student=<?php echo $row['st_id']; ?>">Delete</a> 
                                        </td>

                                        <td><?php echo $row['fname']; ?></td>
                                        <td><?php echo $row['lname']; ?></td>
                                        <td><?php echo $row['father_name']; ?></td>
                                        <td><?php echo $row['gender']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['birthdate']; ?></td>
                                        <td><?php echo $row['mobile']; ?></td>
                                        <td><?php echo $row['city']; ?></td>
                                        <td><?php echo $row['district']; ?></td>
                                        <td><?php echo $row['state']; ?></td>
                                        <td><?php echo $row['nation']; ?></td> 

                                        <!-- Displaying images. upLoadedImages is the folder name.  -->
                                        <td>
                                            <a href="uploadedImages/<?php echo $row['photo']; ?>">
                                                <img src="uploadedImages/<?php echo $row['photo']; ?>" width="80" height="80">
                                            </a>
                                        </td>           
                                
                                    </tr>
                                </tbody>

                                <?php } ?>  <!-- this closing brace won't be recognised until put inside a php tag. -->


                            </table>
                        </div>
                        

                    </div>





                </div>

            </section>

        </div>
    </div>

</body>
 
</html>