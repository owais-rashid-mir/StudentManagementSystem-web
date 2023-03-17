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

                <h2 class="text-center text-danger font-weight-bold mb-5 mt-3"> Student Management System </h2>
                <div class="container bg-danger pt-5 pb-5" id="formsetting">
                    <h3 class="text-center text-white pb-4 pt-2 font-weight-bold mb-4">Welcome To Dashboard</h3>

                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-12 m-auto icon pb-3">
                            <a href="addStudent.php" class="text-white text-center"><i class="fa fa-user"></i>
                                <h3>Add Student Details </h3>
                            </a>
                        </div>

                        <div class="col-md-4 col-sm-4 col-12 m-auto icon pb-3">
                            <a href="viewStudent.php" class="text-white text-center"><i class="fa fa-eye"></i>
                                <h3>View Student Details </h3>
                            </a>
                        </div>

                        <div class="col-md-4 col-sm-4 col-12 m-auto icon pb-3">
                            <a href="editStudent.php" class="text-white text-center"><i class="fa fa-pencil"></i>
                                <h3>Edit Student Details </h3>
                            </a>
                        </div>

                    </div>





                </div>

            </section>

        </div>
    </div>

</body>
 
</html>