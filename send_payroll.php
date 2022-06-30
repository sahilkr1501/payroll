<?php
  include("db.php"); 
  include("auth.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bootstrap, a sleek, intuitive, and powerful mobile first front-end framework for faster and easier web development.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, bootstrap, front-end, frontend, web development">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">

    <title></title>

    <script>
      <!--
        var ScrollMsg= "Payroll and Management System - "
        var CharacterPosition=0;
        function StartScrolling() {
        document.title=ScrollMsg.substring(CharacterPosition,ScrollMsg.length)+
        ScrollMsg.substring(0, CharacterPosition);
        CharacterPosition++;
        if(CharacterPosition > ScrollMsg.length) CharacterPosition=0;
        window.setTimeout("StartScrolling()",150); }
        StartScrolling();
      // -->
    </script>

    <link href="assets/must.png" rel="shortcut icon">
    <link href="assets/css/justified-nav.css" rel="stylesheet">


    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="data:text/css;charset=utf-8," data-href="assets/css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet"> -->
    <!-- <link href="assets/css/docs.min.css" rel="stylesheet"> -->
    <link href="assets/css/search.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/styles.css" /> -->
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.min.css">

  </head>
  <body onload="calculate_earnings(),calculate_deductions(),cal_netpay()">

    <div class="container">
      <div class="masthead">
        <h3>
          <b><a href="index.php">Payroll Management System</a></b>
            <a data-toggle="modal" href="#colins" class="pull-right"><b>Admin</b></a>
        </h3>
      </div>

      <?php
        $id=$_REQUEST['emp_id'];
        $query = "SELECT * from employee where emp_id='".$id."'";
        $result = mysqli_query($connection,$query) or die ( mysql_error());

        while ($row = mysqli_fetch_assoc($result))
        {
            $fname=$row['fname'];
            $lname=$row['lname'];
            $basic_pay=$row['basic_pay'];
            $hra=$row['hra'];
            $profession_tax=$row['profession_tax'];
			
          ?>

              <form class="form-horizontal" action="gen_pdf.php" method="post" name="form">
			  
                <input type="hidden" name="new" value="1" />
                <input name="id" type="hidden" value="<?php echo $row['emp_id'];?>" />
                  <div class="form-group">
                    <label class="col-sm-5 control-label"></label>
                    <div class="col-sm-4">
                      <h1><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></h1>
                    </div>
                  </div>
				  <div style="padding-top:20px;position:relative">
					<div style=" width:50%; position:absolute">
						<center><h3>Earnings</h3></center>
						<div class="form-group">
							<label class="col-sm-5 control-label">Basic Pay  :</label>
							<div class="col-sm-4">
								<input type="text" name="basic_pay" id="basic_pay" class="form-control" value="<?php echo $basic_pay; ?>" required="required" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label">HRA  :</label>
							<div class="col-sm-4">
								<input type="text" name="hra" id="hra" class="form-control" value="<?php echo $hra;?>" required="required" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label">Conveyance  :</label>
							<div class="col-sm-4">
								<input type="text" name="conveyance" id="conveyance" onblur="calculate_earnings(),cal_netpay()" class="form-control" value="0" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label">Incentives  :</label>
							<div class="col-sm-4">
								<input type="text" name="incentives" id="incentives" onblur="calculate_earnings(),cal_netpay()" class="form-control" value="0" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label">Overtime  :</label>
							<div class="col-sm-4">
								<input type="text" name="overtime" id="overtime" onblur="calculate_earnings(),cal_netpay()" class="form-control" value="0" required="required">
							</div>
						</div><br>
						
						<div class="form-group">
							<label class="col-sm-5 control-label">Total Earnings  :</label>
							<div class="col-sm-4">
								<p id="tot_earnings"> 0 </p>
							</div>
						</div>
						<script>
							function calculate_earnings()
							{
								var val = 0;
								var b_pay = parseInt(document.getElementById("basic_pay").value);
								var hra = parseInt(document.getElementById("hra").value);
								var incentives = parseInt(document.getElementById("incentives").value);
								var conveyance = parseInt(document.getElementById("conveyance").value);
								var overtime = parseInt(document.getElementById("overtime").value);
								
								total_earnings = b_pay + hra + incentives + conveyance + overtime;
								document.getElementById("tot_earnings").innerHTML=total_earnings;
							}
						
						</script>
						<br><br>
						
					</div>
					
					
					<div style="width:50%; margin-left:50%;position:relative">
						<center><h3>Deductions</h3></center>
						
						<div class="form-group">
							<label class="col-sm-5 control-label">Provident Fund  :</label>
							<div class="col-sm-4">
								<input type="text" name="p_fund" id="p_fund" onblur="calculate_deductions(),cal_netpay()" class="form-control" value="0" required="required" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label">Loan  :</label>
							<div class="col-sm-4"> 
								<input type="text" name="loan" id="loan" onblur="calculate_deductions(),cal_netpay()" class="form-control" value="0" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label">Profession Tax :</label>
							<div class="col-sm-4">
								<input type="text" name="profession_tax" id="profession_tax" onblur="calculate_deductions(),cal_netpay()" class="form-control" value="<?php echo $profession_tax; ?>" required="required" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label">TDS / IT :</label>
							<div class="col-sm-4">
								<input type="text" name="tds_it" id="tds_it" onblur="calculate_deductions(),cal_netpay()" class="form-control" value="0" required="required" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label">LOP  :</label>
							<div class="col-sm-4">
								<input type="text" name="lop" id="lop" onblur="calculate_deductions(),cal_netpay()" class="form-control" value="0" required="required">
							</div>
						</div><br>
						<script>
							function calculate_deductions()
							{
								var val = 0;
								var p_fund = parseInt(document.getElementById("p_fund").value);
								var loan = parseInt(document.getElementById("loan").value);
								var profession_tax = parseInt(document.getElementById("profession_tax").value);
								var tds_it = parseInt(document.getElementById("tds_it").value);
								var lop = parseInt(document.getElementById("lop").value);
								
								total_deductions = p_fund + loan + profession_tax + tds_it + lop;
								document.getElementById("tot_deductions").innerHTML=total_deductions;
							}
						
						</script>
						<div class="form-group">
							<label class="col-sm-5 control-label">Total Deductions  :</label>
							<div class="col-sm-4">
								<p id="tot_deductions"> 0 </p>
							</div>
						</div>
					</div>
					<script>
					function cal_netpay()
					{
						var net_pay = parseInt(document.getElementById("tot_earnings").innerHTML) - parseInt(document.getElementById("tot_deductions").innerHTML);
						document.getElementById("net_pay").innerHTML=net_pay;
					}
					</script>
					<div class="form-group">
							<label class="col-sm-5 control-label">Net Pay  :</label>
							<div class="col-sm-4">
								<p id="net_pay"> 0 </p>
							</div>
						</div>
					<div class="form-group">
							<label class="col-sm-5 control-label"></label>
							<div class="col-sm-4">
								<input type="submit" name="submit" value="Generate Payroll" class="btn btn-danger">
								<a href="home_employee.php" class="btn btn-primary">Cancel</a>
							</div>
						</div>
				  </div>
              </form>
            <?php
          }
        ?>

      <div class="modal fade" id="colins" role="dialog">
        <div class="modal-dialog modal-sm">
              
          <div class="modal-content">
            <div class="modal-header" style="padding:20px 50px;">
              <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
              <h3 align="center">You are logged in as <b><?php echo $_SESSION['username']; ?></b></h3>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <div align="center">
                <a href="logout.php" class="btn btn-block btn-danger">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- <script src="assets/js/docs.min.js"></script> -->
    <script src="assets/js/search.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/dataTables.min.js"></script>

    <!-- FOR DataTable -->
    <script>
      {
        $(document).ready(function()
        {
          $('#myTable').DataTable();
        });
      }
    </script>

    <!-- this function is for modal -->
    <script>
      $(document).ready(function()
      {
        $("#myBtn").click(function()
        {
          $("#myModal").modal();
        });
      });
    </script>

  </body>
</html>