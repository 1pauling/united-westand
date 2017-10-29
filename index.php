<!--Roxanne Low -->
<!--COM 214 Final Project  -->
<!--Spring 2017-->

<html> 
<head>
    <br><br>
    <link rel="stylesheet" href="main.css"> 
    <link rel=icon href="logo.svg"/>

    <a href="index.php"> <img src="logo.png" style="width: 250px; height:250px;margin:auto; display:block"></a>
    <title> U.N.I.T.E.D </title> 
    
    <h1 id="title"> U.N.I.T.E.D. </h1>
    <h2 id="titlecap"> U n I Together Embracing Diversity </h2> 
    <br><br><br>


    <script> 
        function load(){
            var nitem = document.getElementById("optionsItem") ;
            var activity = document.getElementById("optionsActivity") ;
            
            if(localStorage.getItem("checkbox1")!=undefined){
                nitem.value = localStorage.getItem("checkbox1");
                
            }
            else{
                nitem.value =5;
            }
             if(localStorage.getItem("checkbox2")!=undefined){
                activity.value = localStorage.getItem("checkbox2");
                
            }
            else{
                activity.value =7;
            }
        }

             //Saves the dropdown menu values as local storage
        function save(){
        var check = document.getElementById("optionsItem");
        console.log(check.value);
        localStorage.setItem("checkbox1", check.value);
        }
        
        function saveact(){
        var check = document.getElementById("optionsActivity");
        console.log(check.value);
        localStorage.setItem("checkbox2", check.value);
        }
            
        
    </script>
    </head>


<body onload ="load()">
    
    <p>
    <a href="login.php">Login/Signup</a>&nbsp;&nbsp;
    <a href="contact.html">Contact </a>&nbsp;&nbsp;
        <a href="documentation.html">Documentation</a>&nbsp;&nbsp; </p>
    <br> <br>
     <h1 id="connect"> Connect with Your Community</h1>

    <form id="content" method="get" action="index.php">
      
            <form>
               Items per page
                <select id="optionsItem" name="items" type ="submit" onchange = "save()">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select> 

                Activity
                <select id="optionsActivity" name="activity" type ="submit" onchange = "saveact()">
                    <option value="1" selected>Have a meal</option>
                    <option value="2">Play sports</option>
                    <option value="3">Do art</option>
                    <option value="4">Play music</option>
                    <option value="5">Read books</option>
                    <option value="6">Learn languages</option>
                    <option value="7">Celebrate holiday </option>
                </select> <br><br><br>
                <input id="getNLButt" <a href = "connect" type="submit" name="NL-button" value="New London">
                &nbsp;  &nbsp; 
          </div>
            </form>
<br>
            
             
     
    <form>
    <article id="output"></article>
    <?php
        
        $activities= array('Meal', 'Sports', 'Art', 'Music', 'Books', 'Languages', 'Celebration');
        list($a[1],$a[2],$a[3],$a[4],$a[5],$a[6],$a[7]) =$activities;
            
        // --- CREATE THE DATABASE
            $db_conn = mysqli_connect("localhost", "root", "");
            if (!$db_conn)
                die("Unable to connect: " . mysqli_connect_error());

            if (isset($_GET['NL-button'])) {
                    mysqli_query($db_conn, "CREATE DATABASE IF NOT EXISTS newlondonDB;");
                    mysqli_select_db($db_conn, "newlondonDB");

                    $cmd = "CREATE TABLE IF NOT EXISTS users (
                                                    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                                                    username varchar(60) UNIQUE NOT NULL,
                                                    password varchar(60) NOT NULL,
                                                    email varchar(60) NOT NULL, 
                                                    telephone int(15) NOT NULL
                                                 
                                                  );";
    
        
		
                    $cmd1 = "CREATE TABLE IF NOT EXISTS actionlist( id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                                        date varchar (12) NOT NULL,
                                        name varchar(35) NOT NULL,
                                        email varchar(35) NOT NULL,
                                        title varchar(20) NOT NULL,
                                        des mediumtext DEFAULT NULL,
                                        tag varchar(35) NOT NULL
                                        );";
                    
                     
                    /*
                    if( mysqli_query($db_conn, $cmd) && mysqli_query($db_conn, $cmd1) )
			             echo "Tables 'users' and 'actionlist' created<br>";
		            else
			             echo "Tables not created: ". mysqli_error($db_conn) . "<br>";         
                    */
                    mysqli_query ($db_conn, $cmd);
                    mysqli_query ($db_conn, $cmd1);
                
                    $cmd=  "LOAD DATA LOCAL INFILE 'users.csv' INTO TABLE users FIELDS TERMINATED BY ','"; 

                    $cmd1 = "LOAD DATA LOCAL INFILE 'actions.csv' INTO TABLE actionlist FIELDS TERMINATED BY ','"; //Loads into the actual csv file 

                   
                    mysqli_query ($db_conn, $cmd);
                    mysqli_query ($db_conn, $cmd1);
                    
                    //$name = $_GET['posx']; //gets the value in the input forms, and sets it as the variable
                    //$clickLat = $_GET['posy'];
                    $tag = $_GET['activity'];
                    $nItems= $_GET['items'];
                    
                    //Order sent to MySQL so that it sorts from longitude and latitude, and asks for the number of items
                    $cmd1 = "SELECT*
                            FROM actionlist 
                            WHERE tag='".$tag."'
                            ORDER BY date DESC 
                            LIMIT $nItems;";

             
                       
                    $records = mysqli_query($db_conn, $cmd1);
                    //populates the table
                    echo "<div id ='post'>".PHP_EOL;   
                    while($row = mysqli_fetch_array($records)){
                        echo( "<p id='username'> Name: " .$row['name'] . "</p> <p id='contact'> Contact: " .$row['email']. "<p id='date'> Date Posted: ".$row['date']. "</p> <p id='tag'> Category: ".$a[$row['tag']]. "</p>" .PHP_EOL);
                        echo("</p><p id='posttitle'>" .$row['title']."</p> <p id='description'>" .$row['des']. "</p>" .PHP_EOL ); 
                        echo "<p> --------------------------------------------------------------------------------------------------------------- </p>".PHP_EOL;
                }
                    }
                    echo " </div>".PHP_EOL;
                    
   

        
        
          
                mysqli_close($db_conn);


        ?>
    </form>    
        <br><br>
        <br><br>
    <video width="700" height="500"  controls loop >
        <source src="diversity.mp4" type="video/mp4">
        Your browser does not support the video tag.

    </video>
    <br><br>
    
        
<br><br>

    <h2>Mission</h2> 
    <div>
    <p> 
        The mission of this site is to promote cultural awareness and understanding. 
        <br> There is a strong power within a group of community members working together. This site aims to bridge the gap and build strong relationships through culture exchange activities. </p>
        
     </div>
    
    <h2>Work</h2>
    <div>
    <p> This site provides a platform where community members can connect with other on various levels.<p>
    </div>
<br><br><br>
   
</body>
    
</html>