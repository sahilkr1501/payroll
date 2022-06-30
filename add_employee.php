<?php
	include ("db.php");

  $select_db = mysqli_select_db($connection,'payroll');
  if (!$select_db)
  {
    die("Database Selection Failed" . mysql_error());
  }

  if(isset($_POST['submit']))
  {
    $emp_id		= $_POST['emp_id'];
	$lname      = $_POST['lname'];
    $fname      = $_POST['fname'];
    $gender     = $_POST['gender'];
    $type       = $_POST['emp_type'];
    $division   = $_POST['division'];
    $emp_designation   = $_POST['emp_designation'];
    $basic_pay   = $_POST['basic_pay'];
    $hra   = $_POST['hra'];
    $profession_tax   = $_POST['profession_tax'];
    $bank_name   = $_POST['bank_name'];
    $acc_no   = $_POST['acc_no'];
    $ifsc_code   = $_POST['ifsc_code'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];


    $sql = mysqli_query($connection,"INSERT into employee(emp_id,lname, fname, gender, emp_type, division,basic_pay, hra, profession_tax, bank_name, acc_no, ifsc_code, email, phone, emp_designation)VALUES('$emp_id','$lname','$fname','$gender', '$type', '$division','$basic_pay','$hra','$profession_tax','$bank_name','$acc_no','$ifsc_code','$email','$phone','$emp_designation')");

    if($sql)
    {
      ?>
        <script>
            alert('Employee had been successfully added.');
            window.location.href='index.php';
        </script>
      <?php 
    }

    else
    {
      ?>
        <script>
            alert('Unable to add Employee, Check details correctly and try again.');
			window.location.href='index.php';
        </script>
      <?php 
    }
  }
?>