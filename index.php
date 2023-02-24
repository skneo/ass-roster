<?php
session_start();
// if (!isset($_SESSION['loggedin'])) {
//     header('Location: index.php');
// }
$days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <title>ASS Roster</title>
</head>

<body>
    <?php
    include 'header.php';
    if (!empty($_POST)) {
        $roster = file_get_contents("roster.json");
        $roster = json_decode($roster, true);
        if ($roster != NULL) {
            $employees = array_keys($roster);
            $rowNos = count($employees) - 2;
        } else $rowNos = 0;
        $newRoster = array();
        $newEmpRota = array();
        for ($i = 0; $i < $rowNos; $i++) {
            $newEmpRota['name'] = $roster[$employees[$i]]['name'];
            $newEmpRota['SUN'] = $_POST[$employees[$i] . "-SUN"];
            $newEmpRota['MON'] = $_POST[$employees[$i] . "-MON"];
            $newEmpRota['TUE'] = $_POST[$employees[$i] . "-TUE"];
            $newEmpRota['WED'] = $_POST[$employees[$i] . "-WED"];
            $newEmpRota['THU'] = $_POST[$employees[$i] . "-THU"];
            $newEmpRota['FRI'] = $_POST[$employees[$i] . "-FRI"];
            $newEmpRota['SAT'] = $_POST[$employees[$i] . "-SAT"];
            $newRoster[$employees[$i]] = $newEmpRota;
        }
        date_default_timezone_set('Asia/Kolkata');
        $curr_date = date('d-m-Y H:i:s');
        $newRoster['lastUpdated'] = $curr_date;
        $newRoster['remark'] = $_POST['remark'];
        file_put_contents("roster.json", json_encode($newRoster));
        echo "<div class='alert alert-success ' role='alert'>
            <strong>Roster updated</strong>
            </div>";
    }
    ?>
    <div class="my-3 container ">
        <h4>ASS Roster</h4>
        <div class='table-responsive'>
            <table id="table_id" class="table table-light table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th style='position:sticky; left:0'>Emp Name</th>
                        <?php
                        for ($i = 0; $i < 7; $i++) {
                            $d = $days[$i];
                            echo "<th>$d</th>";
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
                        echo "<tr><td style='position:sticky; left:0'>$name</td>";
                        for ($i = 0; $i < 7; $i++) {
                            echo "<td>" . $employee[$days[$i]] . "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        echo "<p>Remark: " . $roster['remark'] . "</p>";
        echo "<p>Laste Updated: " . $roster['lastUpdated'] . "</p>";
        ?>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
</body>

</html>