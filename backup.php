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


html, body {
    height: 100%;
    margin: 0;
}

#wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Full viewport height */
}

#content-wrapper {
    flex: 1; /* Pushes the footer down */
    display: flex;
    flex-direction: column;
}

#content {
    flex: 1; /* Ensures content takes up remaining space */
}

.sticky-footer {
    margin-top: auto; /* Pushes footer to the bottom */
}


/* First container (Button Holder) */
.button-container {
    height: 10vh; /* 10% of viewport height */
    overflow-x: auto; /* Horizontal scrolling */
    overflow-y: hidden; /* Hides vertical scroll */
    white-space: nowrap; /* Keeps items in a single row */
    padding: 10px;
    background: #f8f9fa; /* Light background */
    scrollbar-width: thin; /* Makes scrollbar thin for Firefox */
    scrollbar-color: rgb(15, 29, 64) transparent; /* Dark blue color */
}

/* Custom Scrollbar for Chrome, Edge, Safari */
.button-container::-webkit-scrollbar {
    height: 4px; /* Thin scrollbar */
}

.button-container::-webkit-scrollbar-track {
    background: transparent; /* No background */
}

.button-container::-webkit-scrollbar-thumb {
    background: rgb(15, 29, 64); /* Dark blue scrollbar */
    border-radius: 5px;
}




</style>
<style>
        /* Container for requirement boxes */
        .file-container {
            overflow-x: auto; /* Horizontal scrolling */
            overflow-y: hidden; /* No vertical scroll */
            white-space: nowrap;
            padding: 15px;
            padding-top: 35px;
            padding-bottom: 35px;
            background: #f8f9fa;
            scrollbar-width: thin;
            scrollbar-color: white transparent;
        }

        /* Custom scrollbar for Chrome, Edge, Safari */
        .file-container::-webkit-scrollbar {
            height: 6px; /* Thicker scrollbar */
        }
        .file-container::-webkit-scrollbar-track {
            background: #ddd;
            border-radius: 5px;
        }
        .file-container::-webkit-scrollbar-thumb {
            background: rgb(15, 29, 64);
            border-radius: 5px;
        }

        /* Flexbox for boxes */
        .file-wrapper {
            display: flex;
            gap: 15px; /* Space between boxes */
            flex-wrap: nowrap; /* No wrapping */
        }

        /* Styling for each requirement file box */
        .file-box {
    width: 380px;
    height: 150px;
    display: flex;
    align-items: center; 
    padding: 15px;
    color: white;
    font-size: 16px;
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s;
    flex-direction: row; /* Row layout */
    justify-content: space-between; /* Space between text & image */
    text-align: left;
}

.text-container {
    display: flex;
    flex-direction: column; /* Stack text elements */
    align-items: flex-start; /* Align text to the left */
    gap: 5px;
    width: 70%; /* Ensure text takes most of the space */
}

.file-img {
    width: 60px; /* Adjust image width */
    height: 60px; /* Adjust image height */
    background-color: rgba(255, 255, 255, 0.2); /* Placeholder for image */
    border-radius: 5px;
}



        .file-box:hover {
            transform: scale(1.05);
        }

        /* Colors for the first four unique boxes */
        .file-box:nth-child(4n+1) { background:rgb(254, 115, 84); } /* Red */
        .file-box:nth-child(4n+2) { background:rgb(86, 192, 111); } /* Green */
        .file-box:nth-child(4n+3) { background:rgb(35, 207, 181); } /* Blue */
        .file-box:nth-child(4n+4) { background:rgb(255, 207, 63); } /* Yellow */

        /* Graphic design image */
        .file-box:nth-child(4n+1) .file-img  {
            width: 180px;
            height: 180px;
            background: url('img/graphicimg.png') no-repeat center;
            background-size: contain;
            border-radius: 5px;
        }
        .file-box:nth-child(4n+2) .file-img {
            width: 190px;
            height: 190px;
            background: url('img/graphicimg1.png') no-repeat center;
            background-size: contain;
            border-radius: 5px;
        }
        .file-box:nth-child(4n+3) .file-img  {
            width: 180px;
            height: 190px;
            background: url('img/graphicimg2.jpg') no-repeat center;
            background-size: contain;
            border-radius: 5px;
        }
        .file-box:nth-child(4n+4) .file-img {
            width: 150px;
            height: 150px;
            background: url('img/graphicimg4.jpg') no-repeat center;
            background-size: contain;
            border-radius: 5px;
        }


    .delete-btn {
        position: absolute;
        top: 10px;
        left: 10px;
        background: white;
        color: red;
        font-size: 14px;
        padding: 5px;
        border-radius: 50%;
        cursor: pointer;
        display: none;
    }

    .file-box:hover .delete-btn {
        display: block;
    }

    .file-link {
        color: white;
        text-decoration: none;
    }
 
    .no-file-message {
    display: flex;
    justify-content: center;  /* Centers horizontally */
    align-items: center;      /* Centers vertically */
    height: 100%;             /* Adjust based on parent container */
    width: 100%;              /* Ensures it takes full width */
    color: white;             
    font-size: 16px;          
    font-weight: bold;
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

<style>
 /* Entry Box Styling */
 .entry-box {
    background-color: rgb(81, 172, 246);
    color: white;
    padding: 10px 15px;
    margin: 8px 0;
    border-radius: 10px;
    font-weight: bold;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
  }

  /* Description Box Styling */
  .desc-content {
    background-color: rgb(255, 255, 255);
    padding: 8px;
    margin-top: 5px;
    border-radius: 5px;
    color: black;
    display: none;
  }

  /* Toggle Button Styling */
  .toggle-btn {
    background: white;
    color: rgb(81, 172, 246);
    border: none;
    padding: 4px 8px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px;
  }

  .toggle-btn:hover {
    background: lightgray;
  }
  .toggle-btn1 {
    background: white;
    color: rgb(81, 172, 246);
    border: none;
    padding: 4px 8px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px;
  }

  .toggle-btn1:hover {
    background: lightgray;
  }


</style>
</head>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
   
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow" style=" background:white">


<div class="mr-auto d-flex align-items-center pl-3 py-2">
    <h4 class="text-dark font-weight-bold mr-4" style="color: rgb(15,29,64); margin-top: 5px;">
        Project Requirements
    </h4>
</div>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
<div class="d-flex justify-content-between align-items-center mb-2">
<input type="file" id="fileInput" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx, .ppt, .pptx, .xlsx, .xls" style="display: none;">

<style>
  .btn-custom {
    background: rgb(81, 172, 246);
    font-size: 13px;
    color: white;
    padding: 8px 10px;
    display: inline-block;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
  }

  /* Hide text and adjust padding for mobile screens */
  @media (max-width: 576px) {
    .btn-custom {
      font-size: 12px; /* Reduce icon size slightly */
      padding: 6px 6px; /* Reduce padding */
      width: 40px; /* Ensure square button */
      text-align: center;
    }

    .btn-custom span {
      display: none; /* Hide the text */
    }
  }
</style>

<a href="#" id="addFileBtn" class="btn btn-custom" style="color: white;">
    <i class="fas fa-folder-plus"></i> <span>&nbsp; Add File</span>
</a> &nbsp; &nbsp;

<a href="#" class="btn btn-custom" data-toggle="modal" data-target="#descModal" style="color: white;">
    <i class="fas fa-pen"></i> <span>&nbsp; Add Desc</span>
</a>




    </div>
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
                
    <div class="container-fluid" style="padding-left: 5px;padding-right:15px;">
    <div class="file-container" style="background: rgb(15, 29, 64);">
        <div class="file-wrapper" id="fileWrapper">
            <!-- Files will be dynamically added here -->
        </div>
    </div>

    <div class=" row" id="entriesContainer">
    <!-- Entries will be dynamically added here -->
  </div>
    </div>
                <!-- /.container-fluid -->

            </div>
         
   <!-- Modal -->
<div class="modal fade" id="descModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
        <form id="descForm">
          <!-- Date & Title in Same Row -->
          <div class="form-group d-flex">
            <div class="w-50 pr-2">
              <label for="dateInput"><b>Date:</b></label>
              <input type="date" class="form-control" id="dateInput" required>
            </div>
            <div class="w-50 pl-2">
              <label for="titleInput"><b>Title:</b></label>
              <input type="text" class="form-control" id="titleInput" placeholder="Enter title" required>
            </div>
          </div>

          <!-- Description Field -->
          <div class="form-group">
            <label for="descInput"><b>Description:</b></label>
            <textarea class="form-control" id="descInput" rows="3" placeholder="Enter description" required></textarea>
          </div>

          <!-- Buttons -->
          <div class="text-center">
            <button type="submit" class="btn submit-btn mx-2" style="color: white;">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
        

<!-- Edit Description Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
        <form id="editForm">
          <div class="form-group d-flex">
            <div class="w-50 pr-2">
              <label for="editDateInput"><b>Date:</b></label>
              <input type="date" class="form-control" id="editDateInput" required>
            </div>
            <div class="w-50 pl-2">
              <label for="editTitleInput"><b>Title:</b></label>
              <input type="text" class="form-control" id="editTitleInput" placeholder="Enter title" required>
            </div>
          </div>
          <div class="form-group">
            <label for="editDescInput"><b>Description:</b></label>
            <textarea class="form-control" id="editDescInput" rows="3" placeholder="Enter description" required></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="btn submit-btn mx-2" style="color: white;">Update</button>
          </div>
        </form>
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
<style>
  /* Responsive font size adjustments */
  .entry-title, .entry-date, .desc-content {
    font-size: 14px;
  }

  .toggle-btn {
    font-size: 12px;
  }

  /* Adjust font size for smaller screens */
  @media (max-width: 768px) { /* Tablets */
    .entry-title, .entry-date, .desc-content {
      font-size: 12px;
    }
    .toggle-btn {
      font-size: 10px;
    }
  }

  @media (max-width: 576px) { /* Mobile */
    .entry-title, .desc-content {
      font-size: 12px;
    }
    .entry-date{
        font-size:10px;
    }
    .toggle-btn {
      font-size: 9px;
    }
    .toggle-btn1 {
      font-size: 11px;
    }
  }
  .desc-content {
  color: #6c757d; /* Lighter text color */
  font-size: 14px; /* Optional: Adjust font size */
}

</style>

<script>
let entryCount = 0;
let editEntryId = null; // To track which entry is being edited

document.getElementById("descForm").addEventListener("submit", function (event) {
  event.preventDefault();

  // Get input values
  let date = document.getElementById("dateInput").value;
  let title = document.getElementById("titleInput").value;
  let desc = document.getElementById("descInput").value.replace(/\n/g, "<br>");

  if (!date || !title || !desc) {
    alert("All fields are required!");
    return;
  }

  let entryId = entryCount++;
  let columnClass = "col-lg-4 col-md-6 col-sm-12"; // Responsive layout

  let entryHTML = `
    <div class="${columnClass}" id="entry-${entryId}">
      <div class="entry-box p-2">
        <div class="row align-items-center">
          <div class="col-6"><span id="title-${entryId}" class="entry-title">${title}</span></div>
          <div class="col-3 text-end"><span id="date-${entryId}" class="entry-date">${date}</span></div>
          <div class="col-3 text-end">
            <button class="toggle-btn" onclick="openEditModal(${entryId})"><i class="fas fa-pen"></i></button>
            <button class="toggle-btn1" onclick="toggleDesc(${entryId})">+</button>
          </div>
        </div>
        <div class="desc-content mt-2" id="desc-${entryId}" style="display: none; color: #6c757d;">
  ${desc}
</div>

      </div>
    </div>
  `;

  document.getElementById("entriesContainer").innerHTML += entryHTML;

  // Reset form & close modal
  document.getElementById("descForm").reset();
  $('#descModal').modal('hide');
});

// Open Edit Modal with Existing Data
function openEditModal(id) {
  editEntryId = id;
  document.getElementById("editDateInput").value = document.getElementById(`date-${id}`).innerText;
  document.getElementById("editTitleInput").value = document.getElementById(`title-${id}`).innerText;
  document.getElementById("editDescInput").value = document.getElementById(`desc-${id}`).innerText;
  
  $('#editModal').modal('show');
}

// Handle Update Functionality
document.getElementById("editForm").addEventListener("submit", function (event) {
  event.preventDefault();

  if (editEntryId !== null) {
    document.getElementById(`title-${editEntryId}`).innerText = document.getElementById("editTitleInput").value;
    document.getElementById(`date-${editEntryId}`).innerText = document.getElementById("editDateInput").value;
    document.getElementById(`desc-${editEntryId}`).innerHTML = document.getElementById("editDescInput").value.replace(/\n/g, "<br>");
    
    editEntryId = null; // Reset after update
    $('#editModal').modal('hide'); // Close modal
  }
});

// Toggle Description Visibility
function toggleDesc(id) {
  let descBox = document.getElementById(`desc-${id}`);
  descBox.style.display = (descBox.style.display === "none") ? "block" : "none";
}


</script>


<script>
    const fileWrapper = document.getElementById("fileWrapper");
    const fileInput = document.getElementById("fileInput");
    const addFileBtn = document.getElementById("addFileBtn");

    // Load files from local storage (Only filenames, because actual files are stored in "b2" folder)
    let storedFiles = JSON.parse(localStorage.getItem("uploadedFiles")) || [];

    function renderFiles() {
    fileWrapper.innerHTML = ""; // Clear existing files
    if (storedFiles.length === 0) {
        let noFileMessage = document.createElement("div");
        noFileMessage.classList.add("no-file-message");
        noFileMessage.textContent = "-- No Requirement File Uploaded --";
        fileWrapper.appendChild(noFileMessage);
        return;
    }
    storedFiles.forEach((fileName, index) => {
        let fileBox = document.createElement("div");
        fileBox.classList.add("file-box");

        let textContainer = document.createElement("div");
        textContainer.classList.add("text-container");

        let requirementText = document.createElement("b");
        requirementText.textContent = `Requirement ${index + 1}`;

        let fileNameText = document.createElement("div");
        fileNameText.classList.add("file-name");
        fileNameText.textContent = fileName;
        fileNameText.style.fontSize = "14px";
        fileNameText.style.marginTop = "5px";

        textContainer.appendChild(requirementText);
        textContainer.appendChild(fileNameText);

        let fileImg = document.createElement("div");
        fileImg.classList.add("file-img");

        let deleteBtn = document.createElement("div");
        deleteBtn.classList.add("delete-btn");
        deleteBtn.textContent = "❌";
        deleteBtn.onclick = (event) => {
            event.stopPropagation(); // Prevent opening file when clicking delete button
            deleteFile(fileName);
        };

        // Make the entire fileBox clickable
        fileBox.onclick = () => {
            window.open(`b2/${fileName}`, "_blank");
        };

        fileBox.appendChild(deleteBtn);
        fileBox.appendChild(textContainer);
        fileBox.appendChild(fileImg); // Image on the right

        fileWrapper.appendChild(fileBox);
    });
}


    addFileBtn.addEventListener("click", () => fileInput.click());

    fileInput.addEventListener("change", (event) => {
        const file = event.target.files[0];

        if (file) {
            let formData = new FormData();
            formData.append("file", file);

            fetch("upload.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    storedFiles.push(data.filename);
                    localStorage.setItem("uploadedFiles", JSON.stringify(storedFiles));
                    renderFiles();
                } else {
                    alert("File upload failed!");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    });

    function deleteFile(fileName) {
    console.log("Attempting to delete:", fileName); // Debugging
    fetch(`delete.php?file=${encodeURIComponent(fileName)}`, { method: "GET" })
    .then(response => response.json())
    .then(data => {
        console.log("Server Response:", data); // Debugging
        if (data.success) {
            storedFiles = storedFiles.filter(name => name !== fileName);
            localStorage.setItem("uploadedFiles", JSON.stringify(storedFiles));
            renderFiles();
        } else {
            alert("File deletion failed!");
        }
    })
    .catch(error => console.error("Error:", error));
}


    renderFiles(); // Initial render
</script>


</body>

</html>