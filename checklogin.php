<?php
    session_start();
    if (!isset($_POST['user'])) header("location:index.php");
	//var_dump($_POST);

    $host="localhost"; // Host name
    $username="root"; // Mysql username
    $password=""; // Mysql password
    $db_name="calendar"; // Database name
    $tbl_name="member"; // Table name

    // Connect to server and select database.
    //mysql_connect("$host", "$username", "$password")or die("cannot connect");
    //mysql_select_db("$db_name")or die("cannot select DB");

    // username and password sent from form
    $_user=$_POST['user'];
    $_password=$_POST['password'];
   // var_dump($_POST);

    // To protect MySQL injection (more detail about MySQL injection)
    //$_user = stripslashes($_user);
    //$_password = stripslashes($_password);
    //$_user = mysql_real_escape_string($_user);
    //$_password = mysql_real_escape_string($_password);
    $_password2 = md5($_password);
	$_user2 = md5($_user);
    //$sql="SELECT * FROM $tbl_name WHERE user='$_user' and password='$_password'";
    //$result=mysql_query($sql);

    // Mysql_num_row is counting table row
    //if ($result == false) die("SQL False");

    //$count=mysql_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row


    echo "<hr>";
    
    if(($_user2=="21232f297a57a5a743894a0e4a801fc3") && ($_password2 == "25f9e794323b453885f5181f1b624d0b")){

    // Register $myusername, $mypassword and redirect to file "login_success.php"

        $_SESSION['user'] = $_user;
        //$_SESSION['password'] = $_password;
        header("location:main.php");
        //echo "OK";
    }
    else {
	    echo "\nUser: ".$_user."<br>";
	    echo "\nPassword: ".$_password."<br>";    	
        echo "<font color = red>Wrong Username or Password</font>";
        ?>
        <br><a href="index.php">Login</a>
<?php
	
	echo "<hr>";
    }
?>