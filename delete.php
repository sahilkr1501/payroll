<?php 
	require('db.php');
	
	$id=$_GET['emp_id'];
	echo $id;
	$query = "DELETE FROM employee WHERE emp_id='$id'"; 
	$result = mysqli_query($connection,$query);
	
	if($result)
	{
		echo "<script>alert('Employee details has been removed successfully.');</script>";
		echo "<script>window.location.href='index.php'</script>";
	}
	else{
		echo "<script>alert('Error removing Employee Details.');</script>";
		echo "<script>window.location.href='index.php'</script>";
	}
	?>