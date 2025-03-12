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

$_SESSION['interns_number'] = count($conn->query("SELECT * FROM intern ")->fetchAll(PDO::FETCH_ASSOC ));

$sql = $conn->query("SELECT * FROM INTERN JOIN administrator ON INTERN.Id_Admin = administrator.Id_Admin")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./intren.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>IHUB intern</title>
</head>
<body>
    <header class="header">
        <h1><span>I</span>HUB</h1>
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
        <a href="Internship.php" class="icon user-btn"><i class='bx bx-transfer-alt'></i></a>
        <a href="logout.php" class="icon logout-btn"><i class='bx bx-log-out'></i></a>
    </nav>
    <?php if( count($sql) ) {?>
        <setion class="container interns_container" id="intern_container">
            <table>
                <tr>
                    <th>Admin</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Action</th>
                </tr>
                <?php foreach ( $sql as $row ) {?>
                    <tr>
                        <td><?php echo $row['Name_Admin'] ?></td>
                        <td><?php echo $row['First_Name'] ?></td>
                        <td><?php echo $row['Last_Name'] ?></td>
                        <td><?php echo $row['Birthday'] ?></td>
                        <td>
                            <div>
                                <a class="btns icon"
                                    data-action = "remove"
                                    data-intern-id="<?php echo $row['Id_Intern'] ?>"
                                    data-intern-name="<?php echo $row['First_Name']." ".$row['Last_Name'] ?>">
                                    <i class='bx bxs-trash'></i>
                                </a>
                                <a class="btns icon"  
                                    data-action = "edit"
                                    data-intern-id="<?php echo $row['Id_Intern'] ?>"
                                    data-intern-name="<?php echo $row['First_Name']." ".$row['Last_Name'] ?>">
                                    <i class='bx bxs-edit-alt'></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </setion>
    <?php } else { ?>
        <setion class="container no_interns_container" id="no_interns_container">
            <p>There is no intern yet</p>
        </setion>
    <?php } ?>
    <section class="container forms_container" id="forms_container">
        <form id="remove_container" class="remove_container">
            <h1 id="removed_intern"></h1>
            <p>Are you sure you want to remove this intern ?</p>
            <div>
                <button type="button" id="confirm_remove_btn">Confirm</button>
                <button type="button" id="cancel_remove_btn">Cancel</button>
            </div>
        </form>
        <form id="edit_container" class="edit_container" onsubmit="return verifyEditForm()" >
            <h1 id="edited_intern"></h1>
            <label for="new_first_name">First name</label>
            <input type="text" name="new_first_name" placeholder="Enter the new first name">
            <label for="new_last_name">Last name</label>
            <input type="text" name="new_last_name" placeholder="Enter the new last name">
            <label for="new_birthday">Birthday</label>
            <input type="date" name="new_birthday" >
            <p id="edit_error" class="error"></p>
            <div>
                <button type="button" id="confirm_edit_btn">Confirm</button>
                <button type="button" id="cancel_edit_btn">Cancel</button>
            </div>
        </form>
        <form id="add_container" class="add_container" onsubmit="return verifyAddForm()" >
            <h1 id="edited_intern"></h1>
            <label for="new_first_name">First name</label>
            <input type="text" name="first_name" placeholder="Enter the first name">
            <label for="new_last_name">Last name</label>
            <input type="text" name="last_name" placeholder="Enter the last name">
            <label for="new_birthday">Birthday</label>
            <input type="date" name="birthday">
            <p id="add_error" class="error"></p>
            <div>
                <button type="button" id="confirm_add_btn">Confirm</button>
                <button type="button" id="cancel_add_btn">Cancel</button>
            </div>
        </form>
    </section>
    
    <script> 
        var numberInterns = <?php echo $_SESSION['interns_number'] ?>
    </script>

    <script src="./intern.js"></script>
</body>
</html>