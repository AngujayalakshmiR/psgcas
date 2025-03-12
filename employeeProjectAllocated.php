<?php
session_start();

if (!isset($_SESSION['empUserName'])) {
    header("Location: login.php");
    exit();
}

include 'dbconn.php'; 

$empUserName = $_SESSION['empUserName'];
$Name = $_SESSION['Name'];

$sql = "SELECT ID, date, companyName, projectType, totalDays, projectTitle, employees 
        FROM projectcreation 
        WHERE employees LIKE ? ORDER BY date DESC";

$stmt = $conn->prepare($sql);
$searchTerm = "%" . $Name . "%"; 
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
$totalEntries = $result->num_rows; // Count total rows



?>
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
thead{
    color:black;
}
#dataTable th:nth-child(1), #dataTable td:nth-child(1) { width: 3%; }  /* S.no */
    #dataTable th:nth-child(2), #dataTable td:nth-child(2) { width: 10%; } /* Date */
    #dataTable th:nth-child(3), #dataTable td:nth-child(3) { width: 10%; } /* Company */
    #dataTable th:nth-child(4), #dataTable td:nth-child(4) { width: 18%; } /* Project Title */
    #dataTable th:nth-child(5), #dataTable td:nth-child(5) { width: 10%; }  /* Project Type */
    #dataTable th:nth-child(6), #dataTable td:nth-child(6) { width: 10%; } /* Description */
    #dataTable th:nth-child(7), #dataTable td:nth-child(7) { width: 11%; } /* Total days */
    #dataTable th:nth-child(7), #dataTable td:nth-child(7) { width: 11%; } /* Working days */
    #dataTable th:nth-child(8), #dataTable td:nth-child(8) { width: 15%; } /* Teammates */

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

 /* Reduce table font size */
 #dataTable {
        font-size: 14px; /* Adjust size as needed */
    }
tbody{
    border-color: #f8f9fa;
}
    /* Reduce padding for table cells */
    

    .status-icon {
            font-size: 1.2rem;
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }
        .ongoing { color: orange; animation: spin 1s linear infinite; }
        .pending { color: red; animation: pulse 1s infinite alternate; }
        .completed { color: green; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes pulse { 0% { opacity: 0.6; } 100% { opacity: 1; } }
        
        /* Styled Dropdown */
        .status-dropdown {
            font-weight: bold;
            border: none;
            padding: 6px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }
        .status-ongoing { background: orange; color: white; }
        .status-completed { background: green; color: white; }
/* Fix missing left and bottom borders */
.table thead tr:first-child th:first-child {
    border-top-left-radius: 15px;
}
.table thead tr:first-child th:last-child {
    border-top-right-radius: 15px;
}
.table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 15px;
}
.table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 15px;
}
.table-container {
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid #dee2e6; /* Ensures full border visibility */
}


/* Apply border to all cells */
.table th, .table td {
    border: 1px solid #dee2e6;
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
 /* Styling for the modal */
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
</style>

</head>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: white;">
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="employeedash.php">
    <div class="sidebar-brand-icon" style='font-size:19px'>KTG</div>
    <div class="sidebar-brand-text mx-2" style='font-size:19px'>DASHBOARD</div>
</a>
<hr class="sidebar-divider my-0">

<!-- Divider -->
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<!-- Nav Item - Dashboard -->
<li class="nav-item l ">
    <a class="nav-link k" href="employeedash.php" style="color: white;">
        <i class="fas fa-fw fa-tachometer-alt" style="font-size:16px"></i>
        <span>Dashboard</span>
    </a>
</li>
<div class="sidebar-divider" style="margin-bottom: 3px;"></div>


<!-- Divider -->
<!-- Nav Item - Project Creation -->
<li class="nav-item l active">
    <a class="nav-link k" href="employeeProjectAllocated.php" style="color: black;">
        <i class="fas fa-fw fa-folder" style="font-size:16px"></i>
        <span>Project Allocation</span>
    </a>
</li>

<div class="sidebar-divider" style="margin-bottom: 3px;"></div>
<!-- Nav Item - Work Reports -->
<li class="nav-item l">
    <a class="nav-link k" href="employeeWorkReports.php" style="color: black;">
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style=" background:white">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
<div class="mr-auto d-flex align-items-center pl-3 py-2">
    <h4 class="text-dark font-weight-bold mr-4" style="color: rgb(15,29,64); margin-top: 5px;">
        Allocated Projects
    </h4>
</div>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

<h4 class="text-dark font-weight-bold mr-1 d-flex align-items-center pl-3 py-2 " style="color: rgb(15,29,64); font-size: medium; margin-top: 5px;">
<?php echo htmlspecialchars($_SESSION['Name']); ?>
    </h4>
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


                <!-- Begin Page Content -->
                <div class="container-fluid">

                <div class="card shadow mb-4"> 
    <div class="card-header py-3">
        <p class="m-0" style="font-size: 16px; color: rgb(23, 25, 28); font-style: normal;
            overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
            font-weight: 500;"><b>Project Details</b> 
 <span class="header-counter"><?php echo $totalEntries; ?></span>  <!-- Dynamic Counter --></p>
    </div>

    <div class="card-body">
        <div class="table-responsive">
           <table class="table text-center" style="font-size:14px;" id="dataTable" width="100%">  
    <thead>
        <tr>
            <th>S.no</th>
            <th>Date</th>
            <th>Company</th>
            <th>Title</th>
            <th>Project Type</th>
            <th>Total Days</th>
            <th>Working Days</th>
            <th>Teammates</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sno = 1;
        while ($row = $result->fetch_assoc()) {
            $company = $row['companyName'];
            $projectTitle = $row['projectTitle'];

            // Query to get total actual hours
            $sql_hours = "SELECT SUM(actualHrs) AS total_actual_hrs FROM dailyupdates 
                          WHERE name = ? AND companyName = ? AND projectTitle = ?";
            $stmt_hours = $conn->prepare($sql_hours);
            $stmt_hours->bind_param("sss", $Name, $company, $projectTitle);
            $stmt_hours->execute();
            $result_hours = $stmt_hours->get_result();
            $row_hours = $result_hours->fetch_assoc();

            $totalActualHrs = $row_hours['total_actual_hrs'] ?? 0; // If no record, default to 0
            $workingDays = round($totalActualHrs / 8, 2); // Divide by 8 to get working days

            echo "<tr>";
            echo "<td>" . $sno++ . "</td>";
            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['companyName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['projectTitle']) . "</td>";
            echo "<td>" . htmlspecialchars($row['projectType']) . "</td>";
            echo "<td>" . htmlspecialchars($row['totalDays']) . "</td>";
            echo "<td>" . $workingDays . "</td>"; // Display calculated working days
            echo "<td>" . htmlspecialchars($row['employees']) . "</td>";
            echo "</tr>";

            $stmt_hours->close();
        }
        ?>
    </tbody>
</table>
        </div>
    </div>
</div>
<?php
$stmt->close();
$conn->close();
?>

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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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
 document.addEventListener("DOMContentLoaded", function () {
    let today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
    let dateInput = document.getElementById("dateFilter");

    dateInput.value = today; // Set default to today
    filterByDate(); // Automatically filter on page load

    // Apply filter immediately when date is changed
    dateInput.addEventListener("change", filterByDate);
});

function filterByDate() {
    let selectedDate = document.getElementById("dateFilter").value;
    if (!selectedDate) return;

    let formattedSelectedDate = selectedDate.split("-").reverse().join("-"); // Convert to DD-MM-YYYY
    let table = document.getElementById("dataTable");
    let rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        let dateCell = rows[i].getElementsByTagName("td")[2];
        if (dateCell) {
            let rowDate = dateCell.textContent.trim();
            rows[i].style.display = (rowDate === formattedSelectedDate) ? "" : "none";
        }
    }
}
</script>
<script>
setTimeout(function () {
    document.querySelectorAll("tbody tr").forEach(row => {
        console.log(`Row has ${row.cells.length} cells`);
        
        if (row.cells.length < 13) {
            console.warn("Skipping row: Some cells are missing.");
            return;
        }
        
        let taskTypeCell = row.cells[7];
        let moduleStatusCell = row.cells[11];
        let projectStatusCell = row.cells[12];
        
        let taskType = taskTypeCell.innerText.trim();
        let moduleStatus = moduleStatusCell.innerText.trim();
        
        console.log(`Task Type: ${taskType}, Module Status: ${moduleStatus}`);
        
        if (moduleStatus.includes("Completed")&&taskType.includes("Testing") ) {
            projectStatusCell.innerHTML = `
                <button class="btn btn-success btn-sm" onclick="markCompleted(this)">Mark as Completed</button>
            `;
        } else {
            projectStatusCell.innerHTML = `
                <button class="btn btn-warning btn-sm">Ongoing</button>
            `;
        }
    });
}, 2000);

function markCompleted(button) {
    let row = button.closest("tr");
    let projectStatusCell = row.cells[12]; // Adjusted to match correct index
    
    projectStatusCell.innerHTML = `
        <span class="text-success"><i class="fas fa-check-circle"></i> Completed</span>
    `;
}
</script>

  <!-- <script>
    $(document).ready(function() {
      // When a row is clicked, get the employee name and redirect to the report page with the name as a query parameter.
      $("#dataTable tbody tr").on("click", function() {
        var employeeName = $(this).data("name");
        if(employeeName) {
          // Redirect to the Customer Details page with the selected name in the URL.
          window.location.href = "reports.php?name=" + encodeURIComponent(employeeName);
        }
      });
    });
  </script> -->

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("#dataTable tbody tr").forEach(row => {
            row.addEventListener("click", function () {
                let company = this.cells[2].innerText.trim();
                let title = this.cells[3].innerText.trim();
                let type = this.cells[4].innerText.trim();
                let totalDays = this.cells[5].innerText.trim();
                let teammates = this.cells[7].innerText.trim();

                let url = `employeedailyupdate.php?company=${encodeURIComponent(company)}&title=${encodeURIComponent(title)}&type=${encodeURIComponent(type)}&totalDays=${encodeURIComponent(totalDays)}&teammates=${encodeURIComponent(teammates)}`;
                window.location.href = url;
            });
        });
    });
</script>

</body>

</html>