<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <div class='container-fluid'>
        <a class='navbar-brand  ' href='index.php'>ASS Roster</a>
        <!-- <img src='images/logo.png' alt='BrandName' width='30' height='30'> -->
        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item'>
                    <a id='home' class='nav-link active ' aria-current='page' href='index.php'>Home</a>
                </li>
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo "<li class='nav-item'>
                        <a class='nav-link active ' href='edit-roster.php'>Edit Roster</a>
                        </li>
                        <li class='nav-item'>
                        <a class='nav-link active ' href='add-employee.php'>Add Employee</a>
                        </li>";
                }
                ?>


            </ul>
            <?php
            if (!isset($_SESSION['loggedin'])) {
                echo "<a href='login.php' class='btn btn-primary' >Login</a>";
            } else {
                echo "<a class='btn btn-primary' href='logout.php'>Logout</a>";
            }
            ?>
        </div>
    </div>
</nav>
<style>
    body {
        background-color: rgb(218, 225, 233);
    }

    @media only screen and (min-width: 960px) {
        .navbar .navbar-nav .nav-item .nav-link {
            padding: 0 0.5em;
        }

        .navbar .navbar-nav .nav-item:not(:last-child) .nav-link {
            border-right: 1px solid #f8efef;
        }
    }
</style>