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

$_SESSION['departements_number'] = count($conn->query("SELECT * FROM departement WHERE Id_Admin = '{$_SESSION['Id_Admin']}'")->fetchAll(PDO::FETCH_ASSOC ));

$sql = $conn->query("SELECT * FROM departement WHERE Id_admin = '{$_SESSION['Id_Admin']}' ORDER BY Name_Depart ASC ")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./departement.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>IHUB departement</title>
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
        <a class="icon add-btn" id="addbtn" ><i class='bx bx-plus'></i></a>
        <a href="admin.php" class="icon user-btn"><i class='bx bxs-user'></i></a>
        <a href="dashboard.php" class="icon user-btn"><i class='bx bxs-dashboard'></i></a>
        <a href="intern.php" class="icon user-btn"><i class='bx bx-male-female'></i></a>
        <a href="Internship.php" class="icon user-btn"><i class='bx bx-transfer-alt'></i></a>
        <a href="logout.php" class="icon logout-btn"><i class='bx bx-log-out'></i></a>
        <a></a>
    </nav>
    <?php if( count($sql) ) {?>
        <setion class="container departement_container" id="departement_container">
            <table>
                <tr>
                    <th>Departement</th>
                    <th>Action</th>
                </tr>
                <?php foreach ( $sql as $row ) {?>
                    <tr>
                        <td> <?php echo $row['Name_Depart'] ?></td>
                        <td>
                            <div>
                                <a class="btns icon"
                                    data-action = "remove"
                                    data-departement-id="<?php echo $row['Id_Depart'] ?>"
                                    data-departement-name="<?php echo $row['Name_Depart'] ?>">
                                    <i class='bx bxs-trash'></i>
                                </a>
                                <a class="btns icon"  
                                    data-action = "edit"
                                    data-departement-id="<?php echo $row['Id_Depart'] ?>"
                                    data-departement-name="<?php echo $row['Name_Depart'] ?>">
                                    <i class='bx bxs-edit-alt'></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </setion>
    <?php } else { ?>
        <setion class="container no_departement_container" id="no_departement_container">
            <p>There is no departement yet</p>
        </setion>
    <?php } ?>
    <section class="container forms_container" id="forms_container" >
        <form id="remove_container" class="remove_container">
            <h1 id="removed_departement"></h1>
            <p>Are you sure you want to remove this departement ?</p>
            <div>
                <button type="button" id="confirm_remove_btn">Confirm</button>
                <button type="button" id="cancel_remove_btn">Cancel</button>
            </div>
        </form>
        <form id="edit_container" class="edit_container" onsubmit="return verifyEditForm()" >
            <h1 id="edited_departement"></h1>
            <label for="new_first_name">Departement new Name</label>
            <input type="text" name="new_departement_name" placeholder="Enter the new departement name">
            <label for="new_last_name">Confirm departement new Name</label>
            <input type="text" name="confirm_new_departement_name" placeholder="Confirm the new departement name">
            <p id="edit_error" class="error"></p>
            <div>
                <button type="button" id="confirm_edit_btn">Confirm</button>
                <button type="button" id="cancel_edit_btn">Cancel</button>
            </div>
        </form>
        <form id="add_container" class="add_container" onsubmit="return verifyAddForm()" >
            <label for="new_first_name">Departement new Name</label>
            <input type="text" name="departement_name" placeholder="Enter the departement name">
            <label for="new_last_name">Confirm departement new Name</label>
            <input type="text" name="confirm_departement_name" placeholder="Confirm the departement name">
            <p id="add_error" class="error"></p>
            <div>
                <button type="button" id="confirm_add_btn">Confirm</button>
                <button type="button" id="cancel_add_btn">Cancel</button>
            </div>
        </form>
    </section>
    
    <script> 
        var numberDepartements = <?php echo $_SESSION['departements_number'] ?>
    </script>

    <script src="./departement.js"></script>
</body>
</html>