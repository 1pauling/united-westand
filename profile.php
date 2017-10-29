<!--Roxanne Low -->
<!--COM 214 Final Project  -->
<!--Spring 2017-->


<!DOCTYPE html>
<!-- Demonstrates how to add a user to an existing database -->
<html>
<head>
    

    <title> U.N.I.T.E.D </title>
    
    <a href="index.php"> <img src="logo.png" style="width: 250px; height:250px;margin:auto; display:block"></a> 

    </head>
    <body style="text-align:center; margin:75px;background-color: floralwhite;">
        
        <form action="profile.php" method="get">
<br><br>
             <p id='titlecap'> Post your activity</p>
         
            <table align="center">
                <tr align="left"> <td>Title:</td> 
                <td> <input type="text" name="title" size="50" placeholder="Activity title" required></td></tr><br>
                <tr align="left"> <td>Description:</td> <td><input type="text" size="50" name="description" placeholder="Activity description" required></td></tr><br>
				<tr align="left"> <td>Type of Activity: </td> <td><select id="optionsActivity" name="activity" type ="number" >
                    <option value="1" selected>Have a meal</option>
                    <option value="2">Play sports</option>
                    <option value="3">Do art</option>
                    <option value="4">Play music</option>
                    <option value="5">Read books</option>
                    <option value="6">Learn languages</option>
                    <option value="7">Celebrate holiday </option>
                </select> </td></tr><br>
                <tr><td></td><td></td><td></td><td><input type="submit" name = "button"></td></tr>
				
            </table>
            <br><br>
            
        </form>
        <?php
            session_start();
            if (isset($_GET['title'])){
                
                $username = $_SESSION['active'];
                $date= date("Y/m/d");
                $des = $_GET["description"];
                $activity = $_GET["activity"];
                $title = $_GET["title"];

                //echo ($date);
                
                $db_conn = mysqli_connect("localhost", "root", "");
                
                if (!$db_conn)
                    die("Unable to connect: " . mysqli_connect_error());

                if( !mysqli_select_db($db_conn, "newlondonDB") )
                    die("Database doesn't exist: " . mysqli_error($db_conn));

                $cmd = "SELECT * from users where username = '".$username."'";

                $result = mysqli_query($db_conn, $cmd);


                if (mysqli_num_rows($result)){
                   while($row = mysqli_fetch_array($result)){
                       $email= $row["email"]; 
                   }
                   // echo ( $email);  

                    $cmd1 = "INSERT INTO actionlist (date, name, email, title, des, tag) VALUES    ('".$date."','".$username."','".$email."','".$title."','".$des."','".$activity."')";       
                    
                    //echo $cmd1;

                    if (mysqli_query($db_conn, $cmd1)){
                        //echo( $cmd1 );
                        echo("You successfully posted into the board!");
                    }
                    else{
                        echo("try adding another");
                    }


                  }
                    echo( PHP_EOL . "\t</article>" . PHP_EOL );
                    mysqli_close($db_conn);

            }
            ?>
        
    </body>
</html>
