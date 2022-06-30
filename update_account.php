<?php 

    include("db.php");
    include("auth.php");
    if(isser($_POST['submit']))
    {
		$id         	     = $_POST['id'];
		$basic_pay 	     = $_POST['basic_pay'];
		$hra    			 = $_POST['hra'];
		$profession_tax    = $_POST['profession_tax'];

		$sql = mysqli_query($connection,"UPDATE employee SET basic_pay='$basic_pay', hra='$hra', profession_tax='$profession_tax' WHERE emp_id='$id'");
	
		if ($sql)
		{
			?>
			<script>
				alert('Account successfully updated.');
				window.location.href='index.php';
			</script>
			<?php 
		}
		else
		{
			echo "<script>alert('Problem updating account, Please contact developer.');</script>";
		}
	}
	else
	{
	    window.location.href='index.php';
	}
?>