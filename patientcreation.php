<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}?>
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
        .table {
    border-radius: 15px;
    overflow: hidden; /* Ensures inner elements don't break the radius */
    border-collapse: separate; /* Required for border-radius to work properly */
    border-spacing: 0; /* Removes unwanted gaps */
}
thead{
    color:black;
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
        background: linear-gradient(to right, #4568dc, #b06ab3);
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

#selectedEmployeesDisplay div {
    margin-bottom: 5px;
    font-size: 14px;
}

#selectedEmployeesDisplay i {
    margin-right: 8px;
    font-size: 16px; /* Adjust size of the icon */
}
#dropdownContainer {
    max-width: 100%; /* Prevents overflow */
    overflow-x: hidden; /* Prevents horizontal overflow */
    box-sizing: border-box; /* Ensures padding is included in width calculation */
}

#employeeDropdown {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

#employeeDropdown div {
    flex: 1 1 100%; /* Ensures the elements wrap on smaller screens */
    margin-bottom: 10px; /* Adds spacing between items */
}

/* Prevent overflow on very small screens */
@media (max-width: 576px) {
    #dropdownContainer {
        min-width: 100%; /* Ensure it fills the screen */
        max-width: 100%;
    }
}
/* Styling the individual employee name elements */
.employee-name {
    line-height: 1;  /* Adjust this value as needed for more or less spacing */
    padding-bottom: 8px; /* Adds space between items */
}
.employee-name i {
    color:rgb(58, 166, 174);
}

  /* Modal Responsiveness */
  .modal-dialog {
    max-width: 35%;
  }

  @media (max-width: 992px) { /* Tablets */
    .modal-dialog {
      max-width: 60%;
    }
  }

  @media (max-width: 768px) { /* Mobile */
    .modal-dialog {
        max-width: 70%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto; /* Ensures it's centered */
    }
    .custom-radio {
        font-size: 12px;
        width:100%;
    }
    .submit-btn {
        font-size: 10px;
        padding: 4px 8px;
        margin-top: 5px;
    }
}


  /* Styling */
  .modal-content {
    border-radius: 15px;
  }

  .custom-radio {
    font-size: 14px;
    margin-right: 10px;
  }

  .submit-btn {
    background-color: rgb(15,29,64);
    color: white;
    border-radius: 10px;
    font-size: 14px;
    padding: 4px 8px;
  }

  .d-flex.flex-wrap {
    gap: 10px;
  }
</style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    
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
<li class="nav-item l" style="padding:0px;">
    <a class="nav-link k" href="followups.php" style="color: white;">
        <i class="fas fa-fw fa-comment-dots" style="font-size:16px"></i>
        <span>FollowUps</span>
    </a>
</li>
<!-- Divider -->
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<!-- Nav Item - Master -->
<li class="nav-item l master">
    <a class="nav-link k collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo" style="color: white;">
        <i class="fas fa-fw fa-clipboard-list" style="font-size:16px"></i>
        <span>Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="customer.php" style="color: black;">Customer</a>
            <a class="collapse-item " href="employee.php" style="color: black;">Employee</a>
            <a class="collapse-item" href="designation.php" style="color: black;">Designation</a>
            <a class="collapse-item" href="projecttype.php" style="color: black;">Project Type</a>
            <a class="collapse-item" href="followuptype.php" style="color: black;">FollowUp Type</a>
        </div>
    </div>
</li> 
<!-- Divider -->
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<!-- Nav Item - Project Creation -->
<li class="nav-item l active ">
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow" style=" background:white;color:white;">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
<div class="mr-auto d-flex align-items-center pl-3 py-2">
    <h4 class="text-dark font-weight-bold mr-3" 
        style="color: rgb(15,29,64); margin-top: 5px;">
        Project Creation
    </h4>
    


</div>


<!-- Employee Selection Modal --> 
<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-3">
        <div class="row no-gutters">
          <!-- Form Section -->
          <div class="col-12 p-3">
            <form id="employeeSelectionForm" style="padding-left: 30px;">
              
              <!-- Employee Selection -->
              <div class="form-group">
                <div id="employeeList" class="row">
                  <?php
                    include 'dbconn.php'; // Ensure you have a DB connection file
                    $query = "SELECT ID, Name FROM employeedetails"; // Fetch employee names
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-6 d-flex align-items-center mb-2'>";
                        echo "<input type='checkbox' name='employees[]' value='" . $row['Name'] . "' class='form-check-input mr-2'>";
                        echo "<label class='form-check-label' style='color:black'>" . $row['Name'] . "</label>";
                        echo "</div>";
                    }
                  ?>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="text-center">
                <button type="submit" class="btn submit-btn" style="color: white;">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () { 
    const employeeSelectionForm = document.getElementById("employeeSelectionForm");
    const selectedEmployeesContainer = document.getElementById("selectedEmployees");
    const selectedEmployeesInput = document.getElementById("selectedEmployeesInput");
    const addAccessBtn = document.getElementById("addAccessBtn");

    // Function to check selected employees when modal opens
    function checkSelectedEmployees() {
        let selectedNames = selectedEmployeesInput.value.split(","); // Get selected employee names

        document.querySelectorAll("input[name='employees[]']").forEach((checkbox) => {
            checkbox.checked = selectedNames.includes(checkbox.value);
        });
    }

    // Open modal and check selected employees
    addAccessBtn.addEventListener("click", function () {
        checkSelectedEmployees();
        $("#employeeModal").modal("show");
    });

    employeeSelectionForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent page reload

        let selectedEmployees = [];
        let selectedEmployeeIDs = [];

        document.querySelectorAll("input[name='employees[]']:checked").forEach((checkbox) => {
            selectedEmployees.push(checkbox.nextElementSibling.innerText); // Store employee names
            selectedEmployeeIDs.push(checkbox.value); // Store employee IDs
        });

        // Update displayed names in the UI
        selectedEmployeesContainer.textContent = selectedEmployees.length > 0 ? selectedEmployees.join(", ") : "--Nil--";

        // Update the hidden input field in the main form
        selectedEmployeesInput.value = selectedEmployeeIDs.join(",");

        // Close the modal
        $("#employeeModal").modal("hide"); 
    });

    // Ensure clicking labels toggles checkboxes
    document.querySelectorAll("#employeeList label").forEach(label => {
        label.addEventListener("click", function () {
            let checkbox = this.previousElementSibling;
            checkbox.checked = !checkbox.checked;
        });
    });
});

</script>

<style>

.add{
  background-color:rgb(0, 148, 255); 
  color: white; 
  border-radius: 25px; 
  font-size: 50px;
  padding:8px;
}
  #addAccessBtn{
        background: rgb(238, 153, 129); 
        color: white; 
        padding: 8px;
        font-size: 16px; 
        font-weight: 600; 
        border-radius: 25px; 
        transition: all 0.3s ease-in-out;
        border: none; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
    /* Ensure buttons are responsive */
    .btn-container {
        display: flex;
        flex-direction: column; /* Stack vertically on mobile */
        gap: 10px; /* Space between buttons */
    }

    /* Responsive Button Sizes */
    .plus-button, #addAccessBtn {
        font-size: 16px;
        width: 100%;  /* Full width on smaller screens */
    }

    @media (max-width: 868px) {
        .plus-button, #addAccessBtn {
            width: 100%;  /* Ensure full width on small screens */
            font-size: 10px;  /* Slightly smaller font size */
        }
        .fa-plus{
          font-size:10px
    
        }
    }

    @media (min-width: 768px) {
        .plus-button, #addAccessBtn {
            width: auto;  /* Auto width on larger screens */
            font-size: 14px;
        }
    }
</style>

<style>
   /* Access Button Hover Effect */
#addAccessBtn {
    transition: all 0.3s ease-in-out;
}

#addAccessBtn:hover {
    background: rgb(255, 105, 0); /* Slightly darker shade */
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Dropdown Container Hover Effect */
#accessDropdownContainer {
    transition: all 0.3s ease-in-out;
}

#accessDropdownContainer:hover {
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
}

/* Dropdown Items */
.employee-checkbox {
    margin-right: 10px;
}

.employee-label {
    font-size: 14px;
    font-weight: 500;
    color: #333;
    transition: color 0.3s ease-in-out;
}

.employee-label:hover {
    color: rgb(255, 105, 0);
    cursor: pointer;
}

/* Dropdown Item Wrapper */
.dropdown-item-wrapper {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
    transition: background 0.2s ease-in-out;
}

.dropdown-item-wrapper:last-child {
    border-bottom: none;
}

/* Highlight on Hover */
.dropdown-item-wrapper:hover {
    background-color: rgba(255, 105, 0, 0.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    #addAccessBtn {
        font-size: 14px;
        padding: 8px 12px;
    }

    #accessDropdownContainer {
        width: 100%; /* Full width on smaller screens */
        max-height: 300px;
        overflow-y: auto; /* Scroll if too many items */
    }

    .dropdown-item-wrapper {
        padding: 8px;
        font-size: 14px;
    }

    .employee-label {
        font-size: 14px;
    }

    .employee-checkbox {
        margin-right: 6px;
        transform: scale(0.9); /* Slightly smaller checkboxes */
    }
}

@media (max-width: 480px) {
    #addAccessBtn {
        font-size: 12px;
        padding: 6px 10px;
    }

    .employee-label {
        font-size: 14px;
    }

    .dropdown-item-wrapper {
        padding: 6px;
        font-size: 14px;
    }

    #accessDropdownContainer {
        max-height: 250px;
    }
}
#addEmployeeBtn {
    align-self: flex-start;
    white-space: nowrap; /* Ensures button text does not wrap */
}

.text-muted {
    color: white !important;
}


</style>


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
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">
        
                        
                        <!-- End of Topbar -->
        
                        <!-- Begin Page Content -->
                        <div class="container-fluid">
                        <div class="container mb-4 mt-4" style="background: white; border-radius: 25px; border: 2px solid rgb(0, 148, 255);">
    <div class="row">
        <div class="col-md-12">
            <form action="projectCreationBackend.php" method="post" id="customerForm" style="font-size:14px;" class="row g-3 mt-3" enctype="multipart/form-data">
                <input type="hidden" id="selectedEmployeesInput" name="employees">

                <!-- Column 1: Company, Project Type & No. of Days -->
                <div class="col-md-4 pb-1">
                    <div class="d-flex align-items-center mb-2">
                        <select class="form-control" id="companySelect" name="companyName">
                            <option value="">Select Company</option>
                            <?php
                                include 'dbconn.php';
                                $query = "SELECT ID, companyName FROM customer";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['companyName'] . "'>" . $row['companyName'] . "</option>";
                                }
                            ?>
                        </select>
                        <span onclick="window.location.href='customer.php'">
                            <i class="fas fa-plus-circle text-primary ml-2" style="cursor: pointer;"></i>
                        </span>
                    </div>

                    <div class="d-flex align-items-center mb-2">
                        <select class="form-control" id="projectTypeSelect" name="projectType">
                            <option value="">Select Project Type</option>
                            <?php
                                include 'dbconn.php';
                                $query = "SELECT ID, ProjecttypeName FROM projecttype";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" .  $row['ProjecttypeName']. "'>" . $row['ProjecttypeName'] . "</option>";
                                }
                            ?>
                        </select>
                        <span onclick="window.location.href='projecttype.php'">
                            <i class="fas fa-plus-circle text-primary ml-2" style="cursor: pointer;"></i>
                        </span>
                    </div>

                    <input type="number" class="form-control mb-2" id="employeephnno" name="totalDays" placeholder="Enter No. of Days">
                </div>

                <!-- Column 2: Project Title & Description -->
                <div class="col-md-4 pb-1">
                    <input type="text" class="form-control mb-2" id="projecttitle" name="projectTitle" placeholder="Enter Project title">
                    <textarea class="form-control mb-2" id="projectdescription" name="description" placeholder="Enter Project Description" rows="2" style="height: 85px;"></textarea>
                </div>

                <!-- Column 3: File Upload -->
                <div class="col-md-4 pb-1">
                    <div class="container d-flex justify-content-center align-items-center" 
                        style="border: 3px solid rgb(252, 217, 104); background: rgb(252, 217, 104); border-radius: 25px; min-height: 120px;">
                        <div class="form-group" style="margin-top: 8px; margin-bottom: 8px;">
                            <label for="requirementfile" class="upload-label d-block font-weight-bold" style="margin-bottom: 0px;">
                                <i id="requirement" class="fas fa-folder file-icon fa-lg upload-icon" 
                                    style="text-align: center; display: block; cursor: pointer; margin-bottom: 12px; color: white;">
                                </i> 
                                <p class="mt-1 justify-content-center" style="font-size: 14px; text-align: center; margin-bottom: 10px; color: white;">
                                    Upload Requirement 
                                </p>
                            </label>
                            <input type="file" class="form-control-file d-none" id="requirementfile" name="reqfile"
                                onchange="updateIcon(this, 'requirement', 'requirementfile-name')">
                                <p class="file-name text-muted" id="requirementfile-name">
                                    <?php echo isset($fileName) ? $fileName : "No file chosen"; ?>
                                </p>

                        </div>
                    </div>
                </div>

                <!-- Employee Selection and Project Submission Row -->
                <div class="row align-items-center mb-3 w-100">
                    <!-- Employees (9 columns) -->
                    <div class="col-md-9 d-flex align-items-center">
                        <!-- Add Employee Button -->
                        <button type="button" class="btn mt-2 d-flex align-items-center" id="addAccessBtn"
                            style="background: rgb(238, 153, 129); color: white; font-size: 14px; align-self: flex-start; white-space: nowrap;">
                            <i class="fas fa-user-plus"></i>&nbsp; Employee
                        </button>
                        <span onclick="window.location.href='employee.php'">
                            <i class="fas fa-plus-circle text-primary ml-2" style="cursor: pointer;"></i>
                        </span>

                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div id="selectedEmployeesContainer" class="mt-2">
                            <span id="selectedEmployees" employees>--Nil--</span>
                        </div>

                        <!-- Dropdown Container -->
                        <div id="dropdownContainer" class="mt-2 p-3 rounded shadow" 
                            style="display: none; border: 1px solid #ccc; background: white; position: absolute; width: 10%; min-width: 280px; z-index: 100;">
                            <div id="employeeDropdown" class="row"></div>
                        </div>
                    </div>

                    <!-- Add Project Button (3 columns) -->
                    <div class="col-md-3 d-flex justify-content-md-end justify-content-center">
                        <button type="submit" class="btn" id="customerbtn" 
                            style="background: rgb(0, 148, 255); border-radius: 25px; color: white; width: auto;">
                            <i class="fas fa-file-alt"></i>&nbsp; Add Project
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>




<?php
include 'dbconn.php'; // Include your DB connection file

$query = "SELECT pc.ID,pc.date, pc.companyName, c.customerName, pc.projectType, pc.totalDays, pc.projectTitle, pc.employees
          FROM projectcreation pc
          LEFT JOIN customer c ON pc.companyName = c.companyName";

$result = mysqli_query($conn, $query);
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <p class="m-0" style="font-size: 16px; color:rgb(23, 25, 28); font-style: normal;
            overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
            font-size: 16px; font-weight: 500;"><b>Project Creation</b>
            <span class="header-counter"><?php echo mysqli_num_rows($result); ?></span>
        </p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" style="font-size:14px;" cellspacing="0">
                <thead>
                    <tr class="thead">
                        <th>S.no</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Company</th>
                        <th>Project Type</th>
                        <th>Project Title</th>
                        <th>Days</th>
                        <th>Employees</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sno = 1;
                    while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr id="row_<?php echo $row['ID']; ?>">
                            <td><?php echo $sno++; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['customerName'] ?? 'N/A'; ?></td>
                            <td><?php echo $row['companyName']; ?></td>
                            <td><?php echo $row['projectType']; ?></td>
                            <td><?php echo $row['projectTitle']; ?></td>
                            <td><?php echo $row['totalDays']; ?></td>
                            <td><?php echo $row['employees']; ?></td>
                            <td class="action-buttons">
                                <button class="btn-action btn-edit" data-id="<?php echo $row['ID']; ?>"><i class="fas fa-edit"></i></button>

                                <button class="btn-action btn-delete" onclick="deleteProject(<?php echo $row['ID']; ?>)"><i class="fas fa-trash-alt" style="color: rgb(238, 153, 129);"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

        
                        </div>
                        <!-- /.container-fluid -->
        
                    </div></div>
            <!-- End of Footer -->

        </div>
        <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                       <h6> <b>Copyright &copy; Knock the Globe Technologies 2025</b></h6>
                    </div>
                </div>
            </footer>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 -->

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
    $(document).ready(function() {
      // Prevent the row click event when an action button is clicked.
      $('.action-buttons button').on('click', function(e) {
        e.stopPropagation();
      });
      
      // Attach click event to each table row in the tbody.
      $('#dataTable tbody tr').on('click', function() {
        var pdfUrl = $(this).data('pdf');
        if (pdfUrl) {
          // Open the PDF in a new tab.
          window.open(pdfUrl, '_blank');
        }
      });
    });
  </script>
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
    function updateIcon(input, iconId, fileNameId) {
    var fileName = input.files.length > 0 ? input.files[0].name : "No file chosen";
    document.getElementById(fileNameId).textContent = fileName;

    // Change icon to green check mark if a file is selected
    var icon = document.getElementById(iconId);
    if (input.files.length > 0) {
        icon.className = "fas fa-check-circle fa-lg text-success";
    } else {
        // Reset to original icon if no file is selected
        if (iconId === "requirement") {
            icon.className = "fas fa-camera-retro fa-lg text-primary";
        } 
    }
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get all rows from the table
    const rows = document.querySelectorAll('#dataTable tbody tr');

    rows.forEach(row => {
        row.addEventListener('click', function(event) {
            const companyCell = row.cells[2]; // Company column
            const projectTypeCell = row.cells[3]; // Project Type column
            const projectTitleCell = row.cells[4]; // Project Title column

            let paramKey = '';
            let paramValue = '';

            // Check which column was clicked and set the respective parameter
            if (event.target === companyCell) {
                paramKey = 'company';
                paramValue = companyCell.textContent.trim();
            } else if (event.target === projectTypeCell) {
                paramKey = 'projectType';
                paramValue = projectTypeCell.textContent.trim();
            } else if (event.target === projectTitleCell) {
                paramKey = 'projectTitle';
                paramValue = projectTitleCell.textContent.trim();
            }

            // Navigate to reports.php with the correct parameter
            if (paramKey && paramValue) {
                window.location.href = `reports.php?${paramKey}=${encodeURIComponent(paramValue)}`;
            }
            else {
                window.location.href = "requirement.php";            }
        });
    });
});

</script>


<script>
  $(document).ready(function () {
    let editMode = false;
    let editId = null;

    // Edit Button Click Handler
    $(".btn-edit").click(function () {
        let projectId = $(this).data("id");

        $.ajax({
            url: "fetchEmployees.php",
            type: "POST",
            data: { id: projectId },
            dataType: "json",
            success: function (data) {
                if (data.error) {
                    Swal.fire("Error!", data.error, "error");
                    return;
                }
                if (data.employees) {
                    $("#selectedEmployees").text(data.employees);
                    $("#selectedEmployeesInput").val(data.employees);
                } else {
                    $("#selectedEmployees").text("--Nil--");
                }


                // Populate the form with project data
                $("#companySelect").val(data.companyName);
                $("#projectTypeSelect").val(data.projectType);
                $("#employeephnno").val(data.totalDays);
                $("#projecttitle").val(data.projectTitle);
                $("#projectdescription").val(data.description);

                if (data.reqfile) {
                    $("#requirementfile-name").text(data.reqfile);
                    $("#filePreview").html(`<a href="uploads/${data.reqfile}" target="_blank">${data.reqfile}</a>`);
                } else {
                    $("#filePreview").html("No file uploaded.");
                }



                // Change button text & mode
                $("#customerbtn").html('<i class="fas fa-sync-alt"></i>&nbsp; Update Project')
                                 .css("background", "rgb(255, 165, 0)"); // Change color
                editMode = true;
                editId = projectId;
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            }
        });
    });

    // Form Submit Handler
    $("#customerForm").submit(function (event) {
        event.preventDefault();

        let formData = new FormData(this);
        if (editMode) {
            formData.append("id", editId);
        }

        $.ajax({
            url: "projectCreationBackend.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: editMode ? 'Project Updated!' : 'Project Created!',
                    text: editMode ? 'Project details updated successfully.' : 'New project created successfully.',
                }).then(() => {
                    location.reload(); // Refresh page after action
                });

                // Reset form
                $("#customerForm")[0].reset();
                $("#customerbtn").html('<i class="fas fa-file-alt"></i>&nbsp; Add Project')
                                 .css("background", "rgb(0, 148, 255)"); // Revert button
                editMode = false;
                editId = null;
            }
        });
    });
});

function deleteProject(projectId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('delete_project.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'projectID=' + projectId
            })
            .then(response => response.json())  // Parse response as JSON
            .then(data => {
                if (data.success) {  // Check if success exists in JSON
                    // Remove the deleted row
                    document.getElementById("row_" + projectId).remove();

                    // Update the project count
                    let counterElement = document.querySelector(".header-counter");
                    let currentCount = parseInt(counterElement.textContent);
                    if (currentCount > 0) {
                        counterElement.textContent = currentCount - 1;
                    }

                    // Show success alert
                    Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: "Project has been deleted successfully.",
                        confirmButtonColor: "#3085d6"
                    }).then(() => {
                    location.reload(); // Refresh page after action
                });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Error deleting project: " + (data.error || "Unknown error"),
                        confirmButtonColor: "#d33"
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Network error or invalid response",
                    confirmButtonColor: "#d33"
                });
            });
        }
    });
}




</script>



</body>

</html>