<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/ktglogo.jpg">

    <title>Task Manager</title>
<!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
thead{
    color:black;
}
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
        .add-customer-btn {
            float: right;
            background: #007bff;
            color: white;
            font-size: 16px;
            padding: 8px 16px;
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .add-customer-btn i {
            margin-right: 5px;
        }

        .add-customer-btn:hover {
            background: #0056b3;
            transform: scale(1.1);
        }

    .table {
    border-radius: 15px;
    overflow: hidden; /* Ensures inner elements don't break the radius */
    border-collapse: separate; /* Required for border-radius to work properly */
    border-spacing: 0; /* Removes unwanted gaps */
}

/* Rounds top corners */
.table thead tr:first-child th:first-child {
    border-top-left-radius: 15px;
}
.table thead tr:first-child th:last-child {
    border-top-right-radius: 15px;
}

/* Rounds bottom corners */
.table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 15px;
}
.table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 15px;
}


#taskInput {
    width: 60%;
}

#taskButton {
    width: 30%;
    margin-left: 130px;
}
.acontainer{
    margin-left: 25px;
    margin-right: 25px;
    margin-top: 10px;
    margin-bottom: 10px;
}
/* Tablets and Medium screens */
@media (max-width: 992px) {
    #taskInput {
        width: 80%;
    }

    #taskButton {
        width: 50%;
        font-size: 14px;
        
    }
}

/* Small screens (Phones) */
@media (max-width: 768px) {
    #taskForm {
        flex-direction: column;
        align-items: stretch;
    }

    #taskInput {
        width: 100%;
        margin-bottom: 10px;
    }

    #taskButton {
        width: 100%;
        align-items: center;
    }
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
/* #dataTable thead {
    color: rgb(140, 147, 159);
    font-weight: 1; 
    font-style: normal;
    text-overflow: ellipsis;
    white-space: nowrap;
} */

/* Style for table data (td) */
/* #dataTable tbody td {
    font-style: normal;
    overflow: hidden;
    line-height: 1rem;
    text-overflow: ellipsis;
    color: rgb(23, 25, 28);
    font-size: 14px;
    font-weight: 400;
    padding: 10px;
} */

/* Style for icons in the status column */
/* #dataTable tbody td i {
    color: rgb(0, 148, 255);
} */
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
/* Apply custom width for container on larger screens */
@media (min-width: 992px) {
    .custom-container {
        max-width: 800px;  /* Adjust the width as needed */
        margin: 0 auto;    /* Center the container */
    }
}
@media (max-width: 768px) {
    .col-md-2 {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100px; /* Ensures the container has some height */
      width: 100%; /* Ensures the container takes up full width on smaller screens */
    }

    .fa-id-badge {
      font-size: 3rem; /* Adjust icon size if needed for smaller screens */
    }
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
    <div class="sidebar-brand-icon" style='font-size:19px'>KTG</div>
    <div class="sidebar-brand-text mx-2" style='font-size:19px'>DASHBOARD</div>
</a>
<hr class="sidebar-divider my-0">

<!-- Divider -->
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<!-- Nav Item - Dashboard -->
<li class="nav-item l ">
    <a class="nav-link k" href="index.php" style="color: white;">
        <i class="fas fa-fw fa-tachometer-alt" style="font-size:16px"></i>
        <span>Dashboard</span>
    </a>
</li>
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<li class="nav-item l " style="padding:0px;">
    <a class="nav-link k" href="followups.php" style="color: white;">
        <i class="fas fa-fw fa-comment-dots" style="font-size:16px"></i>
        <span>FollowUps</span>
    </a>
</li>
<!-- Divider -->
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<!-- Nav Item - Master -->
<li class="nav-item l active master">
    <a class="nav-link k collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo" style="color: white;">
        <i class="fas fa-fw fa-clipboard-list" style="font-size:16px"></i>
        <span>Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="z-index: 1000;">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="customer.php" style="color: black;">Customer</a>
            <a class="collapse-item " href="employee.php" style="color: black;">Employee</a>
            <a class="collapse-item" href="designation.php" style="color: black;">Designation</a>
            <a class="collapse-item active" href="projecttype.php" style="color: white;">Project Type</a>
            <a class="collapse-item" href="followuptype.php" style="color: black;">FollowUp Type</a>
        </div>
    </div>
</li> 
<!-- Divider -->
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<!-- Nav Item - Project Creation -->
<li class="nav-item l">
    <a class="nav-link k" href="projectcreation.php" style="color: black;">
        <i class="fas fa-fw fa-folder" style="font-size:16px"></i>
        <span>Project Creation</span>
    </a>
</li>
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<!-- Nav Item - Daily Updates -->
<li class="nav-item l">
    <a class="nav-link k" href="dailyupdates.php" style="color: black;">
        <i class="fas fa-fw fa-table" style="font-size:16px"></i>
        <span>Daily Update</span>
    </a>
</li>
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<!-- Nav Item - Work Reports -->
<li class="nav-item l">
    <a class="nav-link k" href="reports.php" style="color: black;">
        <i class="fas fa-fw fa-chart-area" style="font-size:16px"></i>
        <span>Work Reports</span>
    </a>
</li><br>
<!-- Divider -->
<div class="sidebar-divider d-none d-md-block"></div>
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
                   <!-- Header Section -->
<div class="mr-auto d-flex align-items-center pl-3 py-2">
    <h4 class="text-dark font-weight-bold mr-4" style="color: rgb(15,29,64);  margin-top: 5px;">
        Master > Project Type
    </h4>
</div>

<!-- Customer Modal (No header, reduced width) -->
<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">





                   

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

                <!-- Begin Page Content -->
                <!-- Begin Page Content -->
              <!-- Include Bootstrap -->

           <!-- Designation Cards Container -->
           <div class="container-fluid">
           <div class="container custom-container mb-4 mt-4" style="background: white; border-radius: 25px; border: 2px solid rgb(0, 148, 255);">
    <div class="row">
        <div class="col-12">
        <form class="row g-10" id="projecttypeForm">
    <div class="col-md-8 pt-2 d-flex align-items-center">
        <input type="text" class="form-control mb-2" id="projecttypeName" name="projecttypeName" placeholder="Enter Project Type" required>
    </div>
    <div class="col-md-4 pt-2 pb-2 d-flex justify-content-center align-items-center">
        <button type="submit" id="projecttypeBtn" class="btn" style="background: rgb(0, 148, 255); border-radius: 25px; color: white; width: 190px;">
            <i class="fas fa-project-diagram"></i>&nbsp; Add Project Type
        </button>
    </div>
</form>
        </div>
    </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <p class="m-0" style="font-size: 16px;color:rgb(23, 25, 28);font-style: normal;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    font-size: 16px;
    font-weight: 500;">
        <b>Project Type Details</b> 
        <span class="header-counter">0</span> <!-- Counter next to heading -->
    </p>
</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered text-center" style="font-size:14px;" id="dataTable" width="100%" cellspacing="0"> 
    <thead>
        <tr class="thead">
            <th>S.no</th>
            <th>Project Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="projecttype_table">
        <!-- Project Types will be loaded here dynamically -->
    </tbody>
</table>

        </div>
    </div>
</div>

</div>


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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
   <!-- jQuery (Must be loaded first) -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages -->
<script src="js/sb-admin-2.min.js"></script>

<!-- DataTables Plugin (Ensure it's loaded after jQuery) -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Initialize DataTable AFTER all dependencies are loaded -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

    <script>
$(document).ready(function () {
    let editId = null;
    let dataTable = $("#dataTable").DataTable(); // Initialize DataTable

    function fetchProjectTypes() {
        $.ajax({
            url: "projecttypeBackend.php",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Destroy DataTable ONLY if it exists AND the table has data
                if ($.fn.DataTable.isDataTable("#dataTable") && data.count > 0) {
                    dataTable.destroy();
                }

                if (data.count === 0) {
                    $("#projecttype_table").html("<tr><td colspan='3'>No project types found</td></tr>");
                } else {
                    $("#projecttype_table").html(data.tableData); // Insert new rows
                }

                $(".header-counter").text(data.count);

                // Reinitialize DataTable only when there are rows
                if (data.count > 0) {
                    dataTable = $("#dataTable").DataTable();
                }
            },
            error: function () {
                console.error("Error fetching data.");
            }
        });
    }

    fetchProjectTypes(); // Fetch data on page load

    $("#projecttypeForm").submit(function (e) {
        e.preventDefault();
        var projecttype = $("#projecttypeName").val().trim();
        if (projecttype === "") {
            Swal.fire({
                title: "Error!",
                text: "Please enter a project type!",
                icon: "error",
                confirmButtonColor: "rgb(0, 148, 255)"
            });
            return;
        }

        let requestData = editId
            ? { edit_id: editId, projecttypeName: projecttype }
            : { projecttypeName: projecttype };

        $.ajax({
            url: "projecttypeBackend.php",
            type: "POST",
            data: requestData,
            dataType: "json",
            success: function (response) {
                Swal.fire({
                    title: editId ? "Updated!" : "Success!",
                    text: editId
                        ? "Project Type Successfully Edited"
                        : "Project Type Added Successfully",
                    icon: "success",
                    confirmButtonColor: "rgb(0, 148, 255)"
                }).then(() => {
                    $("#projecttypeName").val("");
                    $("#projecttypeBtn").html('<i class="fas fa-project-diagram"></i>&nbsp; Add Project Type');
                    editId = null;
                    fetchProjectTypes();
                });
            },
            error: function () {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong!",
                    icon: "error",
                    confirmButtonColor: "rgb(0, 148, 255)"
                });
            }
        });
    });

    $(document).on("click", ".btn-delete", function () {
    var id = $(this).data("id");

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete this project type?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "No, Don't Delete",
        confirmButtonText: "Yes, Delete it",
        confirmButtonColor: "rgb(0, 148, 255)",
        cancelButtonColor: "#d33"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "projecttypeBackend.php",
                type: "POST",
                data: { delete_id: id },
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "The entry has been deleted.",
                        icon: "success",
                        confirmButtonColor: "rgb(0, 148, 255)"
                    }).then(() => {
                        location.reload();  // ✅ Reload the page after confirmation
                    });
                },
                error: function () {
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong!",
                        icon: "error",
                        confirmButtonColor: "rgb(0, 148, 255)"
                    });
                }
            });
        }
    });
});


    $(document).on("click", ".btn-edit", function () {
        editId = $(this).data("id");
        var currentName = $(this).closest("tr").find("td:nth-child(2)").text();
        $("#projecttypeName").val(currentName);
        $("#projecttypeBtn").html('<i class="fas fa-edit"></i>&nbsp; Update');
    });
});

</script>


</body>

</html>