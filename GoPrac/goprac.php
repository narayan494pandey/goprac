<?php
	$hostname="localhost";
	$username="root";
	$password="narayan1";                                      
	$database="coder";
	$conn=mysqli_connect($hostname,$username,$password,$database);
	if (!$conn) {
		die("connection failed:".mysqli_connect_error());
	}
	$startDate= date("Y-m-d");
	$endDate = date('Y-m-d', strtotime('+1 year', strtotime($startDate)) );
    $code = array();
    for ($i=0;$i<50;$i++) {
    $code[$i] = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
    $sql="INSERT INTO codes(code,startdate,enddate) VALUES('$code[$i]','$startDate','$endDate')";
     if (mysqli_query($conn,$sql)) {
    	echo "data save";
    }else{
    	echo "Error:".$sql."<br/>".mysqli_error($conn);
    }
    }
    
   
    mysqli_close($conn); 
?>
