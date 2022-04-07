<?php include('connect_db.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <h1>VYTAJ NA ZAPISE DO FIRMY</h1>
</head>
<body> 
	<main>
  	<form method="post" action="index.php">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="header">
						  <h2>Registrácia</h2>
						  <p>Vyplň všetky polia</p>
					</div>
					<label for="firstname">Meno:</label> 
					<input class="forml-control" type="text" name="firstname" required>

					<label for="lastname">Priezvisko:</label>
					<input class="forml-control" type="text" name="lastname" required>

					<label for="age">Vek:</label>
					<input class="forml-control" type="text" name="age" required>

					<label for="family">Pribuzenstvo:</label>
					<input class="forml-control" type="text" name="family" required>

					<input type="submit" name="create" value="Zaregistruj ma!">
				</div>
			</div>
		</div>
	  </form>
	  <form action="udaje.php" method="post">
            <input class="button" type="submit" name='show' value="Ukaž celý zoznam"> <br>
            <input type="submit" name="show_name" value="Ukaž mená"> <br>
            <input type="submit" name="show_lastname" value="Ukaž priezviská"> <br>
            <input type="submit" name="show_age" value="Ukaž vek"> <br>
            <input type="submit" name="show_family" value="Ukaž pribuzenstvo"> <br>
        </form>
    </main>
    <div>
    <?php
    if(isset($_POST['create'])){
		$firstname = mysqli_real_escape_string($conn, $_REQUEST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_REQUEST['lastname']);
        $age = mysqli_real_escape_string($conn, $_REQUEST['age']);
        $family = mysqli_real_escape_string($conn, $_REQUEST['family']);
        $sql = "INSERT INTO rodina (firstname, lastname, age, family) VALUES ('$firstname', '$lastname', '$age','$family')";
      if(mysqli_query($conn, $sql)){   
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }
    }
      ?>
	</div>
        
    <footer>
        <p class="pt-4 text-muted futer">
            Copyright ©2020 All rights reserved | Tato stranku vytvoril David Ilas 
        </p>             
    </footer>
</body>
</html>