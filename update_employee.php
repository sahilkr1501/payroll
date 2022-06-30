<?php 

  include("db.php");
  include("auth.php");

  $id      			 = $_POST['id'];
  $lname    	   	 = $_POST['lname'];
  $fname   			 = $_POST['fname'];
  $gender    		 = $_POST['gender'];
  $division     	 = $_POST['division'];
  $emp_type   		 = $_POST['emp_type'];
  $emp_designation	 = $_POST['emp_designation'];
  $basic_pay   		 = $_POST['basic_pay'];
  $hra   			 = $_POST['hra'];
  $profession_tax 	 = $_POST['profession_tax'];
  $bank_name   	  	 = $_POST['bank_name'];
  $acc_no  			 = $_POST['acc_no'];
  $ifsc_code  	     = $_POST['ifsc_code'];
  $email			 = $_POST['email'];
  $phone   			 = $_POST['phone'];
  

  $sql = mysqli_query($connection,"UPDATE employee SET emp_type='$emp_type', division='$division',emp_designation='$emp_designation', basic_pay='$basic_pay', hra = '$hra', profession_tax = '$profession_tax', bank_name = '$bank_name', acc_no='$acc_no', ifsc_code='$ifsc_code', email='$email', phone='$phone' WHERE emp_id='$id'");

  if ($sql)
  {
    ?>
    <script>
      alert('Employee Details successfully updated.');
      window.location.href='index.php';
    </script>
    <?php 
  }
  else
  {
    ?>
    <script>
      alert('Unable to update employee details.');
      window.location.href='index.php';
    </script>
    <?php 
  }
?>