<?php
    include 'database.php';
    $database = new Database;
    if(isset($_POST['submit'])){
        $data = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        );
        $result = $database->insert('users', $data);
        if($result) header('location:display.php');
    }
?>
<?php include 'layout.php' ?>   
    <div class="container mt-5">
        <form method="post" class="row g-3">
        <div class="col-md-12">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="inputName">
        </div>
        <div class="col-md-12">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail">
        </div>
        <div class="col-md-12">
            <label for="inputPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword">
        </div>
        <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
<?php include 'footer.php' ?>   