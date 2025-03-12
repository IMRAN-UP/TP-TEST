<?php 

$servername = "localhost"; // MySQL server address
$username = "IMRANE";        // MySQL username
$password = "0707";            // MySQL password (empty by default in XAMPP)
$dbname = "IHUB";          // Replace with your database name (use 'test' if unsure)

try {
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
}
session_start();

if(empty($_SESSION['Id_Admin'])) header('Location: login.php') ;

$_SESSION['internships_number'] = count($conn->query("SELECT * FROM internship WHERE Id_Admin = '{$_SESSION['Id_Admin']}'")->fetchAll(PDO::FETCH_ASSOC ));

$query_intern = $conn->query("SELECT * FROM intern ")->fetchAll(PDO::FETCH_ASSOC);
$query_departement = $conn->query("SELECT * FROM departement WHERE Id_Admin = '{$_SESSION['Id_Admin']}'")->fetchAll(PDO::FETCH_ASSOC);
// $query_internship = $DB_connection->query("SELECT intern.*, internship.*, departement.* FROM intern JOIN internship ON intern.Id_Intern = internship.Id_Intern JOIN departement ON internship.Id_Depart = departement.Id_Depart WHERE intern.Id_Admin = '{$_SESSION['Id_Admin']}' ")->fetchAll(PDO::FETCH_ASSOC);
$query_internship = $conn->query("SELECT * FROM internship JOIN intern ON internship.Id_Intern = intern.Id_Intern JOIN departement ON internship.Id_Depart = departement.Id_Depart WHERE internship.Id_Admin = '{$_SESSION['Id_Admin']}'")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./internship.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>IHUB internship</title>
</head>
<body>
    <header class="header">
        <h1><span>I</span>HUB</h1>
        <div class="error">
            <?php if( isset($_GET['error']) ) {?>
                <p id="msg_error"><?php echo $_GET['error']?></p>
                <?php unset($_GET['error'])?>
            <?php }?>
        </div>
        <nav>
            <a class="icon user-btn" id="menu_btn" ><i class='bx bx-menu'></i></a>
        </nav>
    </header>

    <nav class="hidden_nav" id="hidden_nav" >
        <a class="icon user-btn" id="cancel_menu"><i class='bx bx-x'></i></a> 
        <a class="icon add-btn" id="addbtn"><i class='bx bx-plus'></i></a>
        <a href="admin.php" class="icon user-btn"><i class='bx bxs-user'></i></a>
        <a href="dashboard.php" class="icon user-btn"><i class='bx bxs-dashboard'></i></a>
        <a href="departement.php" class="icon user-btn"><i class='bx bxs-business'></i></a>
        <a href="intern.php" class="icon user-btn"><i class='bx bx-male-female'></i></a>
        <a href="logout.php" class="icon logout-btn"><i class='bx bx-log-out'></i></a>
    </nav>
    <?php if( count($query_internship) ) {?>
        <setion class="container internship_container" id="internship_container">
            <table>
                <tr>
                    <th>Departement</th>
                    <th>Intern</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Action</th>
                </tr>
                <?php foreach ( $query_internship as $row ) {?>
                    <tr>
                        <td><?php echo $row['Name_Depart'] ?></td>
                        <td><?php echo $row['First_Name']." ".$row['Last_Name'] ?></td>
                        <td><?php echo $row['StartDate'] ?></td>
                        <td><?php echo $row['EndDate'] ?></td>
                        <td>
                            <div>
                                <a class="removebtns icon"
                                    data-action = "remove"
                                    data-internship-id="<?php echo $row['Id_Internship'] ?>">
                                    <i class='bx bxs-trash'></i>
                                </a>
                                <a class="editbtns icon"  
                                    data-action = "edit"
                                    data-internship-id="<?php echo $row['Id_Internship'] ?>">
                                    <i class='bx bxs-edit-alt'></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </setion>
    <?php } else { ?>
        <setion class="container no_internship_container" id="no_internship_container">
            <p>There is no internship yet</p>
        </setion>
    <?php } ?>
    <section class="container forms_container" id="forms_container" >
        <form id="remove_container" class="remove_container">
            <p>Are you sure you want to remove this internship ?</p>
            <div>
                <button type="button" id="confirm_remove_btn">Confirm</button>
                <button type="button" id="cancel_remove_btn">Cancel</button>
            </div>
        </form>
        <form id="edit_container" class="edit_container">
            <a class="icon cancel" id="cancel_edit_btn"><i class='bx bx-x'></i></a>
            <div id="edit_step1" class="step">
                <h1>Select the departement</h1>
                <table>
                    <tr>
                        <th>Departement</th>
                    </tr>
                    <?php foreach($query_departement as $row) {?>
                    <tr>
                        <td>
                            <span><?php echo $row['Name_Depart'] ?></span>
                            <span><input type="radio" class="check_departement_edit_Btns" data-departement-id="<?php echo $row['Id_Depart'] ?>"></span>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <div>
                    <button type="button" id="edit_next1">Next</button>
                </div>
            </div>

            <div id="edit_step2" class="step">
                <h1>Select the intern</h1>
                <table>
                    <tr>
                        <th>Intern</th>
                    </tr>
                    <?php foreach($query_intern as $row) {?>
                    <tr>
                        <td>
                            <span><?php echo $row['First_Name']." ".$row['Last_Name'] ?></span>
                            <span><input type="radio" class="check_intern_edit_Btns" data-intern-id="<?php echo $row['Id_Intern'] ?>"></span>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <div>
                    <button type="button" id="edit_prev1">Back</button>
                    <button type="button" id="edit_next2">Next</button>
                </div>
            </div>
            <div id="edit_step3" class="step">
                <h1>Enter the start and end date</h1>
                <from >
                    <label for="start_sate">Start date</label>
                    <input type="date" placeholder="Enter the start date of the internship" name="start_date">
                    <label for="start_sate">End date</label>
                    <input type="date" placeholder="Enter the end date of the internship" name="end_date">
                </form>
                <div>
                    <button type="button" id="edit_prev2">Back</button>
                    <button type="button" id="confirm_edit_btn">Confim</button>
                </div>
            </div>
        </form>
        <form id="add_container" class="add_container">
            <a class="icon cancel" id="cancel_add_btn"><i class='bx bx-x'></i></a>
            <div id="add_step1" class="step">
                <h1>Select the departement</h1>
                <table>
                    <tr>
                        <th>Departement</th>
                    </tr>
                    <?php foreach($query_departement as $row) {?>
                    <tr>
                        <td>
                            <span><?php echo $row['Name_Depart'] ?></span>
                            <span><input type="radio"class="check_departement_add_Btns" data-departement-id="<?php echo $row['Id_Depart'] ?>"></span>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <div>
                    <button type="button" id="add_next1">Next</button>
                </div>
            </div>

            <div id="add_step2" class="step">
                <h1>Select the intern</h1>
                <table>
                    <tr>
                        <th>Intern</th>
                    </tr>
                    <?php foreach($query_intern as $row) {?>
                    <tr>
                        <td>
                            <span><?php echo $row['First_Name']." ".$row['Last_Name'] ?></span>
                            <span><input type="radio" class="check_intern_add_Btns" data-intern-id="<?php echo $row['Id_Intern'] ?>"></span>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <div>
                    <button type="button" id="add_prev1">Back</button>
                    <button type="button" id="add_next2">Next</button>
                </div>
            </div>
            <div id="add_step3" class="step">
                <h1>Enter the start and end date</h1>
                <from >
                    <label for="start_sate">Start date</label>
                    <input type="date" placeholder="Enter the start date of the internship" name="start_add_date">
                    <label for="start_sate">End date</label>
                    <input type="date" placeholder="Enter the end date of the internship" name="end_add_date">
                </form>
                <div>
                    <button type="button" id="add_prev2">Back</button>
                    <button type="button" id="confirm_add_btn">Confim</button>
                </div>
            </div>
        </form>
    </section>
    
    <script> 
        var numberinternships = <?php echo $_SESSION['internships_number'] ?> ;
    </script>

    <script src="./internship.js"></script>
</body>
</html>