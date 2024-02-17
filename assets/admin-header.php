<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body, html {
    margin: 0;
    padding: 0;
}

.navbar {
    position: relative; 
    top: 0;
    left: 0;
    width: 100%;
}

        .navbar {
            background-color: black !important;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        
        body {
            font-family: 'Open Sans', sans-serif;
           
        }

        .container {
            max-width: 960px;
            margin: auto;
            padding: 20px;
        }

        .card {
            margin-bottom: 1rem;
        }

        .btn-danger {
            margin-right: 10px;
        }

        
        @media (max-width: 768px) {
            .navbar-brand, .nav-link {
                color: #fff !important;
            }
        }
    </style>
</head>


<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Change here -->
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create_employee.php">Utilisateurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_vehicles.php">Reviews</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="update_hours.php">Hours</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="deconnexion.php">deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    </header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
