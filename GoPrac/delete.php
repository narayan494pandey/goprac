
<?php
    $hostname="localhost";
	$username="root";
	$password="narayan1";                                      
	$database="coder";
	$conn=mysqli_connect($hostname,$username,$password,$database);
	if (!$conn) {
		die("connection failed:".mysqli_connect_error());
	    }
    $id = $_POST['code_id'];
    $sql = "DELETE FROM codes WHERE code_id=$id"; 
    if (mysqli_query($conn,$sql)) {
    	echo "data delete";
    }else{
    	echo "Error:".$sql."<br/>".mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: index.php"); 

?>
