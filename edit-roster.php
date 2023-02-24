<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
}
$days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <title>Edit Roster</title>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="my-3 container table-responsive">
        <h4>ASS Roster</h4>
        <form action="index.php" method="post">
            <div class='table-responsive'>
                <table id="table_id" class="table-light table table-striped table-bordered w-100">
                    <thead>
                        <tr>
                            <th style='position:sticky; left:0;'>Emp Name</th>
                            <?php
                            for ($i = 0; $i < 7; $i++) {
                                $d = $days[$i];
                                echo "<th style='min-width:80px'>$d</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $roster = file_get_contents("roster.json");
                        $roster = json_decode($roster, true);
                        if ($roster != NULL) {
                            $employees = array_keys($roster);
                            $rowNos = count($employees) - 2;
                        } else $rowNos = 0;

                        for ($x = 0; $x < $rowNos; $x++) {
                            $employee = $roster[$employees[$x]];
                            $name = $employee['name'];
                            echo "<tr><td style='position:sticky; left:0;'>$name</td>";
                            for ($i = 0; $i < 7; $i++) {
                                $d = $days[$i];
                                echo "<td><input type='text' class='form-control' name='" . $employees[$x] . '-' . $d . "' value='" . $employee[$d] . "'> </td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class='mb-3'>
                <label for='remark' class='form-label float-start'>Remark</label>
                <input type='text' value="<?php echo $roster['remark'] ?>" class='form-control' id='remark' name='remark' required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
</body>

</html>