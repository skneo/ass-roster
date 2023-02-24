<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
function validateInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <title>Login</title>
</head>

<body>
    <?php
    include 'header.php';
    if (isset($_POST['password'])) {
        $password = validateInput($_POST['password']);
        if ($password === '1234') {
            $_SESSION['loggedin'] = true;
            header('Location: index.php');
        } else {
            echo "<div class='alert alert-danger ' role='alert'>
            <strong >Wrong Password</strong>
            </div>";
        }
    }
    ?>
    <div class='container my-3'>
        <h4>Login</h4>
        <form method='POST' action=''>
            <div class='mb-3'>
                <label for='password' class='form-label float-start'>Password</label>
                <input type='password' class='form-control' id='password' name='password' required>
            </div>
            <button type='submit' class='btn btn-primary'>Submit</button>
        </form>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
</body>

</html>