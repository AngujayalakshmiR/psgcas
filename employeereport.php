<?php
session_start();

if (!isset($_SESSION['empUserName'])) {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<style>
    .stats-box {
  color: #ffffff;
  text-align: center;
  padding: 20px;
  width: 160px;
  /* Ensure width and height are equal */
  height: 160px;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  margin: auto;
  /* Center the box within its container */
}

.stats-box:hover {
  transform: scale(1.1);
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
}

.stats-box i {
  margin-bottom: 10px;
  font-size: 24px;
}

.stats-box h5 {
  margin-bottom: 0;
  margin-top: 5px;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.cir {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.bo {
  position: relative;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  overflow: hidden;
}

.bo::before {
  content: "";
  position: absolute;
  inset: -5px 70px;
  background: linear-gradient(315deg, #00ccff, #d400d4);
  transition: 0.5s;
  animation: border-animation 8s linear infinite;
}

.bo:hover::before {
  inset: -20px 0px;
}

@keyframes border-animation {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}

.bo::after {
  content: "";
  position: absolute;
  inset: 3px;
  background-color: white;
  border-radius: 50%;
  z-index: 1;
}

.content1 {
  position: absolute;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  inset: 15px;
  border: 2px solid #070a1c;
  border-radius: 50%;
  overflow: hidden;
  z-index: 3;
}

.content1 img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: 0.75s;
  pointer-events: none;
  z-index: 3;
}

.bo:hover .content1 img {
  opacity: 0;
}

.content1 h2 {
  position: relative;
  color: #fff;
  font-size: 1.5rem;
  text-align: center;
  font-weight: 600;
  letter-spacing: 0.05rem;
  text-transform: uppercase;
}

.content1 h2 span {
  font-size: 0.75rem;
  font-weight: 300;
}

.content1 a {
  position: relative;
  margin-top: 5px;
  padding: 5px 10px;
  background: #fff;
  color: #070a1c;
  border-radius: 25px;
  font-size: 1.25rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.05rem;
  text-decoration: none;
  transition: 0.5s;
}

.content1 a:hover {
  letter-spacing: 0.2rem;
}
.card-container {
  max-width: 600px; /* Reduce card width */
  justify-content: center;
}

.profile-icon-container {
  position: absolute;
  top: -40px;
  left: 50%;
  transform: translateX(-50%);
  width: 120px;
  height: 120px;
  background-color: white;
  border: 4px solid   rgb(220, 20, 70);;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  animation: border-pulse 2s infinite; /* Animation */
  transition: transform 0.3s ease-in-out; /* Transition effect */
}

.profile-icon-container:hover {
  transform: translateX(-50%) scale(1.1); /* Enlarge on hover */
}

@keyframes border-pulse {
  0% {
    box-shadow: 0 0 0 0   rgb(220, 20, 70);;
  }
  50% {
    box-shadow: 0 0 0 20px rgba(0, 123, 255, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
  }
}
.stats-box {

  color: #ffffff;
  text-align: center;
  padding: 20px;
  width: 160px;
  /* Ensure width and height are equal */
  height: 160px;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  margin: auto;
  /* Center the box within its container */
}

.stats-box:hover {
  transform: scale(1.1);
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);

}

.stats-box i {
  margin-bottom: 10px;
  font-size: 24px;
}

.stats-box h5 {
  margin-bottom: 0;
  margin-top: 5px;
}






* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.cir {

  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;

}

.bo {
  position: relative;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  overflow: hidden;
}

.bo::before {
  content: "";
  position: absolute;
  inset: -5px 70px;
  background: linear-gradient(315deg, #00ccff, #d400d4);
  transition: 0.5s;
  animation: border-animation 8s linear infinite;
}

.bo:hover::before {
  inset: -20px 0px;
}

@keyframes border-animation {
  0% {
      transform: rotate(0deg);
  }

  100% {
      transform: rotate(360deg);
  }
}

.bo::after {
  content: "";
  position: absolute;
  inset: 3px;
  background-color: white;
  border-radius: 50%;
  z-index: 1;
}

.content1 {
  position: absolute;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  inset: 15px;
  border: 2px solid #070a1c;
  border-radius: 50%;
  overflow: hidden;
  z-index: 3;
}

.content1 img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: 0.75s;
  pointer-events: none;
  z-index: 3;
}

.bo:hover .content1 img {
  opacity: 0;
}

.content1 h2 {
  position: relative;
  color: #fff;
  font-size: 1.5rem;
  text-align: center;
  font-weight: 600;
  letter-spacing: 0.05rem;
  text-transform: uppercase;
}

.content1 h2 span {
  font-size: 0.75rem;
  font-weight: 300;
}

.content1 a {
  position: relative;
  margin-top: 5px;
  padding: 5px 10px;
  background: #fff;
  color: #070a1c;
  border-radius: 25px;
  font-size: 1.25rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.05rem;
  text-decoration: none;
  transition: 0.5s;
}

.content1 a:hover {
  letter-spacing: 0.2rem;
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
<li class="nav-item l  master">
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
<li class="nav-item l active">
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

<style>
   

    .custom-card {
        background: linear-gradient(45deg, rgba(255, 99, 71, 0.8), rgba(255, 165, 0, 0.8));
        transition: background 0.5s ease-in-out, transform 0.2s;
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        border: none;
    }

    .custom-card:hover {
        transform: translateY(-5px);
    }

    .total-card {
        background: linear-gradient(45deg, #00c6ff, #0072ff);
    }

    .pending-card {
        background: linear-gradient(45deg, #ff758c, #ff7eb3);
    }

    .ongoing-card {
        background: linear-gradient(45deg, #f7971e, #ffd200);
    }

    .completed-card {
        background: linear-gradient(45deg, #56ab2f, #a8e063);
    }

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
        background: white;
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
 .bo::before {
    background: rgb(45, 64, 113);
 }
 @media (max-width: 460px) {
    .hide-below-460 {
        display: none !important; /* Completely removes the element from the layout */
    }
    .square-box {
        display: flex;  /* Show the square-box */
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        padding: 20px;
        background-color: #f8f9fc;
        border-radius: 25px;
        border: 1px solid #f8f9fc;
    }
    .square-box .stats-box {
        width: calc(50% - 10px); /* 2 items per row */
        padding-left: 15px;
        padding-right: 15px;
        text-align: center;
        background-color: rgb(45, 64, 113);
        color: white;
        border-radius: 15px;
    }
}
/* Hide the section in desktop view */
@media (min-width: 461px) {  
    .square-box {
        display: none !important;
    }
}

/* Show the section in mobile view */
@media (max-width: 460px) {  
    .hide-below-460 {
        display: none !important; /* Remove from layout */
    }
    
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
.table td, .table th {
    border-top: 0px;
    border-bottom: 0px;
}
.table thead th {
    border-top: 0px;
    border-bottom: 0px;
}
.circle-badge {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 25px;
        height: 25px;
        background-color: rgb(0, 148, 255);
        color: white;
        font-weight: bold;
        border-radius: 50%;
        text-align: center;
    }
    .circle-badge {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            background-color: rgb(0, 148, 255);
            color: white;
            border-radius: 50%;
            font-weight: bold;
        }
</style>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style=" background:white;">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                <div class="mr-auto d-flex align-items-center pl-3 py-2">

    <h4 class="text-dark font-weight-bold mr-4" style="color: rgb(15,29,64); font-size: medium; margin-top: 5px;">
        Employee based report > Jayavarshini
    </h4></div>
    <div class="d-flex align-items-end ml-auto">
        <!-- Download Button -->
        <button onclick="downloadPDF()" class="btn  px-3" style="border-radius: 25px;background:rgb(0, 148, 255);color:white">
            Download PDF
        </button> &nbsp;&nbsp;
        <button id="printPDF" class="btn  px-3" style="border-radius: 25px;background:rgb(255, 154, 53);color:white">
            Print PDF
        </button></div>
                    <!-- Sidebar Toggle (Topbar) -->
                   

                   
<style>
  @media (max-width: 1024px) { /* Targets tablets and smaller screens */
    #printPDF,
    button[onclick="downloadPDF()"] {
        display: none !important;
    }
}

</style>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                       

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
                <script>
function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('p', 'mm', 'a4');

    html2canvas(document.querySelector("#pdf-content"), { scale: 2 }).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        const imgWidth = 210; // A4 width in mm
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        doc.addImage(imgData, 'PNG', 0, 10, imgWidth, imgHeight);
        doc.save("Project_Details.pdf");
    });
}

document.getElementById("printPDF").addEventListener("click", function () {
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF("p", "mm", "a4"); // A4 size PDF (portrait)

    const container = document.querySelector(".container");

    html2canvas(container, { scale: 2 }).then(canvas => {
        const imgWidth = 190; // Adjust width to fit A4
        const pageHeight = 297; // A4 page height in mm
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        let heightLeft = imgHeight;
        
        // Define top and bottom margins
        const topMargin = 20;  // Top margin in mm
        const bottomMargin = 20; // Bottom margin in mm
        let position = topMargin; // Start the content after the top margin

        // Convert canvas to image
        const imgData = canvas.toDataURL("image/png");

        // Add the first page with the top margin
        pdf.addImage(imgData, "PNG", 10, position, imgWidth, imgHeight);
        heightLeft -= pageHeight - topMargin - bottomMargin; // Adjust for top and bottom margins

        // If content is longer than one page, add extra pages
        while (heightLeft > 0) {
            position = heightLeft - imgHeight;
            pdf.addPage();
            pdf.addImage(imgData, "PNG", 10, position, imgWidth, imgHeight);
            heightLeft -= pageHeight - topMargin - bottomMargin;
        }

        // Open the PDF in a new tab
        const pdfBlob = pdf.output("blob");
        const blobUrl = URL.createObjectURL(pdfBlob);
        window.open(blobUrl, "_blank");
    });
});
</script>
                <!-- Begin Page Content -->
                <div class="container" id="pdf-content" style="background: white;padding:40px;">
                <div class="row d-flex justify-content-between align-items-center">
    <!-- Logo -->
    <div class="col-md-6">
        <img src="img/company.png" width="250px" height="130px">
    </div>

    <!-- Knock the Globe Address -->
    <div class="col-md-6 d-flex flex-column align-items-end text-end ms-auto" style="color: black;">
        <p class="mb-2"><b>Knock the Globe</b></p>
        <p class="mb-2">92, 2nd Cross, Vaiyapuri Nagar,</p>
        <p class="mb-2">Gandhi Puram, Karur,</p>
        <p class="mb-2">Tamil Nadu - 639002</p>
    </div>
</div>
<br><br><br>
<div class="row d-flex justify-content-between align-items-start" style="color: black;">
    <!-- Left Side: Company Info -->
    <div class="col-md-8">
    <p class="mb-2"><b>Jayavarshini</b></p>
    <p class="mb-2">Web & Mobile App Developer</p>
    </div>

    <!-- Right Side: Project Details -->
    <div class="col-md-4 d-flex flex-column align-items-end text-end ms-auto">
    <p class="mb-2"><b>Employee Address:</b></p>
    <p class="mb-2">123, Street Name,</p>
        <p class="mb-2">Area, District,</p>
        <p class="mb-2">State, Country - 123456</p>
        <p class="mb-2">Contact: +91 xxxxx xxxxx</p>
    </div>
</div>
<br><br><br>
<div class="row d-flex justify-content-between align-items-start" style="color: black;">
    <!-- Left Side: Company Info -->
    <div class="col-md-4">
    <p class="mb-2"><b>Company name - Project Title</b></p>
    <p class="mb-2">Kurinji Cement - Website Upgradation</p>
    <p class="mb-2">Land Corner - Mobile Application Development</p>
    </div>
    <!-- Right Side: Project Details -->
    <div class="col-md-4 d-flex flex-column align-items-end text-end ms-auto">
        <p class="mb-2"><b>Actual Work Days:</b> <span class="circle-badge">8</span> days</p>
        <p class="mb-2"><b>Actual Work Hours:</b> <span class="circle-badge">47</span> hrs</p>
    </div>
</div>
    <br><br><br>
    <div class="row d-flex justify-content-center align-items-center" style="color: black;"><b>-- Task Listed below --</b></div><br><br>
<div class="card shadow mb-4">
                       
                        <div class="card-body" style="padding: 0px;">
                            <div class="table-responsive ">
                            <table class="table text-center" id="dataTable" width="100%">
                            <colgroup>
        <col style="width: 3%;">  <!-- S.no -->
        <col style="width: 10%;">  <!-- Name -->
        <col style="width: 8%;">  <!-- Date -->
        <col style="width: 16%;">  <!-- Title -->
        <col style="width: 8%;">
        <col style="width: 16%;">  <!-- Description -->
        <col style="width: 8%;">  <!-- Total Hrs (Adjusted) -->
        <col style="width: 8%;">  <!-- Actual Hrs (Adjusted) -->
        <col style="width: 8%;">  <!-- Status -->
    </colgroup>
                            <thead>
              <tr style="font-family:calibri;">
                <th>S.no</th>
                <th>Date</th>
                <th>Company</th>
                <th>Title</th>
                <th>Type</th>
                <th>Description</th>
                <th>Total Hrs</th>
                <th>Actual Hrs</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr data-name="Surya">
                <td>1</td>
                <td>10-02-2025</td>
                <td>Kurinji Cement</td>
                
                <td>The project requires inbuilt updations and notifications.</td>
                <td>Web Development</td>
                <td>I completed half backend work</td>
                <td>4.5</td>
                <td>2</td>
                <td><i class="fas fa-check-circle status-icon completed" style="color: rgb(0, 148, 255);"></i>&nbsp;&nbsp;Completed</td>
              </tr>
              <tr data-name="JayaVarshini">
                <td>2</td>
                <td>10-02-2025</td>
                <td>Land Corner</td>
                
                <td>The project requires inbuilt updations and notifications.</td>
                <td>Mobile App Development</td>
                <td>I completed half backend work</td>
                <td>4.5</td>
                <td>2</td>
                <td><i class="fas fa-check-circle status-icon completed" style="color: rgb(0, 148, 255);"></i>&nbsp;&nbsp;Completed</td>
              </tr>




          
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
    <script>
$(document).ready(function() {
    $('#projectTable').DataTable();
});
</script>
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
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>