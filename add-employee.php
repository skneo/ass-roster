<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
}
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <title>Add Employee</title>
</head>

<body>
    <?php
    include 'header.php';
    function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (isset($_POST['emp_name'])) {
        $emp_name = validateInput($_POST['emp_name']);
        $emp_num = validateInput($_POST['emp_num']);

        $roster = file_get_contents('roster.json');
        $roster = json_decode($roster, true);
        if ($roster == NULL)
            $roster = array();
        $emp_rota = array();
        $emp_rota['name'] = $emp_name;
        $emp_rota['SUN'] = "";
        $emp_rota['MON'] = "";
        $emp_rota['TUE'] = "";
        $emp_rota['WED'] = "";
        $emp_rota['THU'] = "";
        $emp_rota['FRI'] = "";
        $emp_rota['SAT'] = "";
        $roster[$emp_num] = $emp_rota;
        file_put_contents("roster.json", json_encode($roster));
        echo "<div class='alert alert-success ' role='alert'>
            <strong>$emp_name added</strong>
            </div>";
    }
    ?>
    <div class='container my-3'>
        <h4>Add Employee</h4>
        <form method='POST' action=''>
            <div class='mb-3'>
                <label for='emp_name' class='form-label float-start'>Name</label>
                <input type='text' class='form-control' id='emp_name' name='emp_name' required>
            </div>
            <div class='mb-3'>
                <label for='emp_num' class='form-label float-start'>Emp Number</label>
                <input type='number' class='form-control' id='emp_num' name='emp_num' required>
            </div>
            <button type='submit' class='btn btn-primary'>Submit</button>
        </form>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
</body>

</html>