<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Task Manager</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="icon" type="image/png" href="img/ktglogo.jpg">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css"> -->
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        
       

        /* Center align action buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        /* Styling for buttons */
        .btn-action {
            border: none;
            background: transparent;
            font-size: 18px;
            transition: transform 0.2s ease-in-out;
        }

        .btn-action:hover {
            transform: scale(1.2);
        }

        .btn-edit {
            color: #28a745;
        }

        .btn-delete {
            color: #dc3545;
        }

        /* Add Customer Button */
        .add-employee-btn {
            float: right;
            background: #007bff;
            color: white;
            font-size: 16px;
            padding: 8px 16px;
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .add-employee-btn i {
            margin-right: 5px;
        }

        .add-employee-btn:hover {
            background: #0056b3;
            transform: scale(1.1);
        }

         /* Modal Header Gradient Background */
    .modal-header {
        background: linear-gradient(to right, #4568dc, #b06ab3);
        color: white;
    }

    /* Adjust close button color */
    .modal-header .close {
        color: white;
        opacity: 1;
    }

    .modal-header .close:hover {
        color: #f8f9fa;
    }


    .upload-icon {
    transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
}

.upload-label:hover .upload-icon {
    transform: scale(1.2);
    color: #007bff;
}

.upload-icon.bounce {
    animation: bounce 0.5s ease-in-out;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

/* Icon Styling */
.photo-icon{
    color: #5796d8;
}
.aadhar-icon{
    color: rgb(212, 212, 69);
}
.pan-icon{
    color:rgb(250, 148, 65);
}
.photo-icon, .aadhar-icon, .pan-icon {
    font-size: 24px;
    transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
}

/* Hover Animation */
.photo-icon:hover, .aadhar-icon:hover, .pan-icon:hover {
    transform: scale(1.3);
    color: #007bff;
}

/* Bounce Effect on File Icon */
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.photo-icon:hover, .aadhar-icon:hover, .pan-icon:hover {
    animation: bounce 0.5s ease-in-out;
}

    </style>
<style>
           .sidebar-brand-icon, .sidebar-brand-text {
        font-size: large;
        background: white;
        -webkit-background-clip: text; /* Clip background to text */
        -webkit-text-fill-color: transparent; /* Make text color transparent to show gradient */
        font-weight: bold; /* Optional: Makes text more prominent */
    }
    /* Sidebar background */
    .sidebar {
        background-color: rgb(15,29,64) !important;
        width: 250px; /* Adjust according to sidebar width */
    }

    /* Sidebar link styles */
    .l a.k{
        color: white !important; /* Dark text */
        border-radius: 8px; /* Rounded corners */
        transition: all 0.3s ease-in-out;
        padding: 12px 15px;
        font-size: 16px; /* Increased font size */
        display: flex;
        align-items: center;
        gap: 10px; /* Space between icon and text */
        width: 85%; /* Ensure links don’t take full width */
        margin: 0 auto; /* Center align */
    }

    /* Ensure icons are black */
    .l a.k i {
        color: white !important;
        font-size: 18px; /* Slightly larger icons */
        transition: color 0.3s ease-in-out;
    }


    /* Hover effect (only for non-active items) */
    .l:not(.active)  a.k:hover {
        background-color: rgb(45, 64, 113) !important; /* Light grey */
        color: white !important; /* Dark text */
        border-radius: 8px;
        width: 90%; /* Keep it smaller than the sidebar */
        margin: 0 auto; /* Center align */
    }

    /* Keep icons black on hover for non-active items */
    .l:not(.active) a.k:hover i {
        color: white !important;
    }

    /* Active item style */
    .l.active {
        background-color: rgb(45, 64, 113) !important; /* Light grey */
        color: white !important; /* Dark text */
        border-radius: 8px;
        width: 90%; /* Keep it smaller than the sidebar */
        margin: 0 auto; /* Center align */
        padding:1px;
    }
    .collapse-item.active{
        width: 90%;
        background:white;
        color:white;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transform: scale(1.02); /* Slight lift effect */
        margin: 0 auto; /* Center align */
    }
    /* Active item text & icon color */
    .l.active a.k{
        color: white !important;
    }

    /* Ensure icons turn white inside active links */
    .l.active a.k i {
        color:white !important;
    }
    footer {
    background: white;
    color: rgb(15,29,64);
    padding: 15px;
    box-shadow: 0px -4px 6px rgba(0, 0, 0, 0.1); /* Negative Y value for top shadow */
}

    .master.active{
        width: 90%;
        color:white;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transform: scale(1.02); /* Slight lift effect */
        margin: 0 auto; /* Center align */
    }
    .master.active.collapse{
        background:white;
        border-radius: 8px;

    }
    .collapse{
        background:#F8F8F8;
        border-radius: 10px;
        color:white;
    }
    .collapse-item.active{
        width: 90%;
        background: rgb(45, 64, 113);
        color:white;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transform: scale(1.02); /* Slight lift effect */
        margin: 0 auto; /* Center align */
    }
    .action-buttons button {
      margin: 0 5px;
    }
    /* Optional: Change cursor for clickable rows */
    #dataTable tbody tr {
      cursor: pointer;
    }
    .sidebar-dark .nav-item .nav-link[data-toggle="collapse"]:hover::after {
    color: white;
}
/* Style for the table header (thead) */
#dataTable thead {
    color: rgb(140, 147, 159);
    font-weight: 1; 
    font-style: normal;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Style for table data (td) */
#dataTable tbody td {
    font-style: normal;
    overflow: hidden;
    line-height: 1rem;
    text-overflow: ellipsis;
    color: rgb(23, 25, 28);
    font-size: 14px;
    font-weight: 400;
    padding: 10px; /* Adds spacing inside cells */
}

/* Style for icons in the status column */
#dataTable tbody td i {
    color: rgb(0, 148, 255);
}
/* Counter styling similar to .bpKSTa .header-counter */
.header-counter {
    margin-left: 2px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgb(0, 148, 255);
    padding: 2px 5px;
    font-size: 13px;
    min-width: 20px;
    min-height: 20px;
    font-weight: 500;
    color: white;
    border-radius: 100px;
}

/* Styling for the card header */
.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between; /* Adjust spacing */
    padding: 12px 16px;
    background-color: #f8f9fc;
}
.page-item.active .page-link {
    background: rgb(0, 148, 255);
}
@media (max-width:600px) {
    h4{
        font-size: small;
    }
}
@media (min-width:600px) {
    h4{
        font-size: medium;
    }
}
</style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: white;">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon" style='font-size:20px'><b>KTG</b></div>
    <div class="sidebar-brand-text mx-2" style='font-size:20px'><b>DASHBOARD</b></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item l ">
    <a class="nav-link k" href="index.php" style="color: white;">
        <i class="fas fa-fw fa-tachometer-alt" style="font-size:20px"></i>
        <span><b>Dashboard</b></span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider" style="margin-bottom: 0px; color:#4568dc">

<!-- Nav Item - Master -->
<li class="nav-item l master active">
    <a class="nav-link k collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo" style="color: white;">
        <i class="fas fa-fw fa-clipboard-list" style="font-size:20px"></i>
        <span><b>Master</b></span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="customer.php" style="color: black;"><b>Customer</b></a>
            <a class="collapse-item active" href="employee.php" style="color: white;"><b>Employee</b></a>
            <a class="collapse-item" href="designation.php" style="color: black;"><b>Designation</b></a>
            <a class="collapse-item" href="projecttype.php" style="color: black;"><b>Project Type</b></a>
        </div>
    </div>
</li> 

<!-- Divider -->
<hr class="sidebar-divider" style="margin-bottom: 0px;">

<!-- Nav Item - Project Creation -->
<li class="nav-item l">
    <a class="nav-link k" href="projectcreation.php" style="color: black;">
        <i class="fas fa-fw fa-folder" style="font-size:20px"></i>
        <span><b>Project Creation</b></span>
    </a>
</li>

<hr class="sidebar-divider" style="margin-bottom: 0px;">

<!-- Nav Item - Daily Updates -->
<li class="nav-item l">
    <a class="nav-link k" href="dailyupdates.php" style="color: black;">
        <i class="fas fa-fw fa-table" style="font-size:20px"></i>
        <span><b>Daily Updates</b></span>
    </a>
</li>

<hr class="sidebar-divider" style="margin-bottom: 0px;">

<!-- Nav Item - Work Reports -->
<li class="nav-item l">
    <a class="nav-link k" href="reports.php" style="color: black;">
        <i class="fas fa-fw fa-chart-area" style="font-size:20px"></i>
        <span><b>Work Reports</b></span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle side border-0" id="sidebarToggle"></button>
</div>

</ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style=" background:white;">
                    
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
                <div class="mr-auto d-flex align-items-center pl-3 py-2">
    <h4 class="text-dark font-weight-bold mr-3" 
        style="color: rgb(15,29,64); margin-top: 5px;">
        Master &gt; Employee Details
    </h4>

    <button class="btn" style="border-radius:25px;background: rgb(0, 148, 255);color:white;" onclick="window.location.href='add_employee.php'">
    <i class="fas fa-users"></i>  <!-- Represents a group or team of employees -->

        &nbsp;Add Employee
    </button>
</div>




<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">


    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-profile rounded-circle"
                src="img/p.png" style="width: 2rem;height: 2rem;">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            
            
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
                    <h4>Add Employee</h4>
                    <form action="employee.php" method="GET">
                        <div class="row">
                            <!-- Left Side -->
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="employeeName"><b>Name:</b></label>
                                    <input type="text" class="form-control form-control-sm" id="employeeName" placeholder="Enter name">
                                </div>
                                <div class="row">
                                <div class="form-group col-6">
                                    <label for="designation"><b>Designation:</b></label>
                                    <select class="form-control form-control-sm" id="designation">
                                        <option value="">Select Designation</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Team Lead">Team Lead</option>
                                        <option value="Software Engineer">Software Engineer</option>
                                        <option value="HR">HR</option>
                                        <option value="Intern">Intern</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="phoneNumber"><b>Phone Number:</b></label>
                                    <input type="text" class="form-control form-control-sm" id="phoneNumber" placeholder="Enter phone number">
                                </div></div>
                                <div class="form-group">
                                    <label for="employeeAddress"><b>Address:</b></label>
                                    <textarea class="form-control form-control-sm" id="employeeAddress" rows="4" placeholder="Enter address"></textarea>
                                </div>
                                <div class="row">
                                <div class="form-group col-6">
                                <label for="username"><b>Username:</b></label>
                                <input type="text" class="form-control form-control-sm" id="username" placeholder="Enter Username">
                                </div>
                                <div class="form-group col-6">
                                    <label for="password"><b>Password:</b></label>
                                    <input type="text" class="form-control form-control-sm" id="password" placeholder="Enter Password">
                                </div></div>
                            </div>
                
                            <!-- Right Side -->
                            <div class="col-md-5">
                                <div class="card p-2 shadow-sm text-center">
                                    <div class="form-group">
                                        <label for="employeePhoto" class="upload-label d-block font-weight-bold">
                                            <i class="fas fa-camera-retro fa-lg text-primary"></i>
                                            <p class="mt-1">Upload Photo</p>
                                        </label>
                                        <input type="file" class="form-control-file d-none" id="employeePhoto" onchange="updateFileName(this, 'photoFileName')">
                                        <p class="file-name text-muted" id="photoFileName">No file chosen</p>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="aadharCard" class="upload-label d-block font-weight-bold">
                                            <i class="fas fa-id-card fa-lg text-success"></i>
                                            <p class="mt-1">Upload Aadhar Card</p>
                                        </label>
                                        <input type="file" class="form-control-file d-none" id="aadharCard" onchange="updateFileName(this, 'aadharFileName')">
                                        <p class="file-name text-muted" id="aadharFileName">No file chosen</p>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="panCard" class="upload-label d-block font-weight-bold">
                                            <i class="fas fa-id-badge fa-lg text-danger"></i>
                                            <p class="mt-1">Upload Pan Card</p>
                                        </label>
                                        <input type="file" class="form-control-file d-none" id="panCard" onchange="updateFileName(this, 'panFileName')">
                                        <p class="file-name text-muted" id="panFileName">No file chosen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient btn-lg mt-3">Submit</button>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>




            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                       <h6> <b>Copyright &copy; Knock the Globe Technologies 2025</b></h6>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
<!-- Bootstrap 4.6.0 JavaScript -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script> -->
<script>
    function updateFileName(input, fileNameId) {
        const fileInput = input.files[0];
        
        // Ensure the input has a file
        const fileNameElement = document.getElementById(fileNameId);
        
        if (fileInput) {
            fileNameElement.textContent = fileInput.name;
            // Change the color to red when a file is uploaded
            fileNameElement.style.color = 'red';
        } else {
            fileNameElement.textContent = "No file chosen";
            // Reset the color if no file is selected
            fileNameElement.style.color = 'initial';
        }

        // Add bounce animation to the icon
        const icon = input.previousElementSibling.querySelector(".upload-icon");
        icon.classList.add("bounce");

        // Remove animation after it plays once
        setTimeout(() => {
            icon.classList.remove("bounce");
        }, 500);
    }
</script>
</body>

</html>