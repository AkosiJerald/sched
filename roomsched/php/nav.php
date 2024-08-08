
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
<body>
    <button class="toggle-btn custom-right" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <div class="sidebar" id="sidebar">

        <div class="d-block img-div text-center"  >
        <img src="../img/logo.png" alt="" class="img-fluid mt-5" >
            <h4 class="mt-4">Room Scheduler</h4>
            
        </div>
      
        <div class="nav-bg mt-5 ">
           <div class="link pt-5" >
                <i class="bi bi-house-door-fill " style="color:white;"></i>
                <a href="#" class="" style="color:white;">Home</a>
                <br>
                <br>
                <i class="bi bi-calendar-day-fill " style="color:white;"></i>
                <a href="#" style="color:white;">Schedule</a>
                <br>
                <br>
                <i class="bi bi-book-fill" style="color:white;"></i>
                <a href="subject.html" style="color:white;">Subject</a>
                    
           </div>
        </div>

        <div class="bottom-div text-center">
            <a href="../php/logout.php" class="">Logout</a>
        </div>
    </div>
    


    <script src="../js/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>