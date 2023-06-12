

<?php
$con = mysqli_connect("localhost","ict","password","ict");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// If form submitted, insert values into the database.


for ($x = 1; $x <= 1335; $x++) {
     
        // removes backslashes
	#$username = $x;
        //escapes special characters in a string

	$email = "email".$x;
	$password = "password".rand().rand().$x;
	$balance=rand(100,20000);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` ( password, email,balance, trn_date)
VALUES ( '".md5($password)."', '$email','$balance', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "registered successfully";
        }}
        
        
        $email = "email".$x;
	$password = "testsparrow";
	$balance=rand(100,20000);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` ( password, email,balance, trn_date)
VALUES ( '".md5($password)."', '$email','$balance', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "registered successfully";
        }

?>

