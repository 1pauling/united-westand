<!--Roxanne Low -->
<!--COM 214 Final Project  -->
<!--Spring 2017-->

<?php
			$message = "";
			if( !empty($_GET["username"]) ){
				$db_conn = mysqli_connect("localhost", "root", "");
				if (!$db_conn)
					die("Unable to connect: " . mysqli_connect_error());  // die is similar to exit

				if( !mysqli_select_db($db_conn, "newlondonDB") )
					die("Database doesn't exist: " . mysqli_error($db_conn));

				mysqli_select_db($db_conn, "newlondonDB");
                
                $user = mysqli_real_escape_string($db_conn, $_GET['username']);
                $pass = mysqli_real_escape_string($db_conn, $_GET['password']);

				$cmd = "INSERT INTO users (username, password, email, telephone) VALUES ('"
				                . $user . "','" . $pass . "','"
								. $_GET['email'] . "'," . $_GET['telephone'] . ");";

				if( mysqli_query($db_conn, $cmd) )

					$message = "Thank you, " .$user. "! You have been added to the database.<br>Your password is: " .$pass ;

				else
                    //if error coz duplicate. reply that username alrady exist
					$message = "Problem creating your account: Make sure you fill out all required areas! <br><br>";
                    //$error = mysqli_error($db_conn);
                echo "<br>" . $message . "<br>" ;
				mysqli_close($db_conn);
			}
            else{
                echo "<p> error </p>";
            }

		?>
        
        
                
