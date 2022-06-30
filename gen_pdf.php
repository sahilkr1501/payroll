<?php
require('fpdf.php');
include("db.php"); //include auth.php file on all secure pages
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',90,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Move to the right
    $this->Cell(45);
    // Title
    $this->Cell(30,50,'Cronbay Technologies Pvt. Ltd.','C');
	$this->Ln(20);
	$this->SetFont('Arial','',9);
	$this->Cell(33);
	$this->Cell(10,20,'Unit 109, 2nd floor, Regent prime, no 48, Whitefield main road, Bangalore-560066','C');
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
	if(isset($_POST['submit']))
	{
		$emp_id=$_POST['id'];
		$basic_pay = $_POST['basic_pay'];
		$hra = $_POST['hra'];
		$conveyance = $_POST['conveyance'];
		$incentives = $_POST['incentives'];
		$overtime = $_POST['overtime'];
		$total_earning = $basic_pay + $hra + $conveyance + $incentives + $overtime;
		
		$provident_fund = $_POST['p_fund'];
		$loan = $_POST['loan'];
		$profession_tax = $_POST['profession_tax'];
		$tds_it = $_POST['tds_it'];
		$lop = $_POST['lop'];
		$total_deduction = $provident_fund + $loan + $profession_tax + $tds_it + $lop;
		
		$net_salary = $total_earning - $total_deduction;
		
        $query=mysqli_query($connection,"select * from employee where emp_id = '$emp_id'")or die(mysql_error());
        if($row=mysqli_fetch_array($query))
        {
			$fname = $row['fname'];
			$lname = $row['lname'];
			$emp_type = $row['emp_type'];
			$division = $row['division'];
			$bank_name = $row['bank_name'];
			$acc_no = $row['acc_no'];
			$ifsc_code = $row['ifsc_code'];
			$email = $row['email'];
			$phone = $row['phone'];
			$emp_designation = $row['emp_designation'];
				$currentDateTime = date('Y-m-d H:i:s');
			
		}
		else{
			alert('Unable to generate Payroll. Please contact Tech support.');
		}
		
		// Instanciation of inherited class
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',11);
			$pdf->Cell(0,10,'  ',0,1);
			$pdf->Cell(0,10,'  ',0,1);
			$pdf->Cell(0,5,'Employee ID : '.$emp_id,0,1);
			$pdf->Cell(0,5,'Employee Name : '.$fname. ' ' .$lname,0,1);
			$pdf->Cell(0,5,'Employee Designation : '.$emp_designation,0,1);
			$pdf->Cell(0,15,'Payroll Date : '.$currentDateTime,0,1);
			
		$pdf->SetFont('Times','B',11);
		$pdf->SetFillColor(153, 179, 255);
			$pdf->Cell(95,10,'Earnings ',1,0,'C',true);
			
			$pdf->Cell(0,10,'Deductions ',1,1,'C',true);
		
		$pdf->SetFont('Times','',10);
			$pdf->Cell(50,8,'Basic Salary ',1,0);
			$pdf->Cell(45,8,$basic_pay.'  ',1,0,'R');
			$pdf->Cell(50,8,'Provident Fund ',1,0);
			$pdf->Cell(45,8,$provident_fund.'  ',1,1,'R');
			
			$pdf->Cell(50,8,' HRA ',1,0);
			$pdf->Cell(45,8,$hra.'  ',1,0,'R');
			$pdf->Cell(50,8,' LOP ',1,0);
			$pdf->Cell(45,8,$lop.'  ',1,1,'R');
			
			$pdf->Cell(50,8,' Conveyance ',1,0);
			$pdf->Cell(45,8,$conveyance.'  ',1,0,'R');
			$pdf->Cell(50,8,' Loan ',1,0);
			$pdf->Cell(45,8,$loan.'  ',1,1,'R');
			
			$pdf->Cell(50,8,' Incentives ',1,0);
			$pdf->Cell(45,8,$incentives.'  ',1,0,'R');
			$pdf->Cell(50,8,' Profession Tax ',1,0);
			$pdf->Cell(45,8,$profession_tax.'  ',1,1,'R');
			
			$pdf->Cell(50,8,' Overtime ',1,0);
			$pdf->Cell(45,8,$overtime.'  ',1,0,'R');
			$pdf->Cell(50,8,' TDS/IT ',1,0);
			$pdf->Cell(45,8,$tds_it.'  ',1,1,'R');
			
			$pdf->Cell(50,8,'  ',1,0);
			$pdf->Cell(45,8,'  ',1,0,'R');
			$pdf->Cell(50,8,'  ',1,0);
			$pdf->Cell(45,8,'  ',1,1,'R');
			
			$pdf->Cell(50,8,' Total Earnings ',1,0);
			$pdf->Cell(45,8,$total_earning.'  ',1,0,'R');
			$pdf->Cell(50,8,' Total Deductions ',1,0);
			$pdf->Cell(45,8,$total_deduction.'  ',1,1,'R');
		$pdf->SetFont('Times','B',10);
		$pdf->SetFillColor(102, 140, 255);
			$pdf->Cell(50,8,'  ',1,0,'',true);
			$pdf->Cell(45,8,'  ',1,0,'R',true);
			$pdf->Cell(50,8,' NET SALARY ',1,0,'',true);
			$pdf->Cell(45,8,$net_salary.'  ',1,1,'',true);
			
			$pdf->Cell(0,10,' ',0,1);
			$pdf->Cell(80,10,'Bank Name : '.$bank_name,0,0);
			$pdf->Cell(0,10,'Account No. : '.$acc_no,0,1);
			$pdf->Cell(0,10,'Date : '.$currentDateTime,0,1);
			
			$pdf->Cell(0,10,' ',0,1);
			$pdf->Cell(0,10,' ',0,1);
			$pdf->Cell(0,10,' ',0,1);
			$pdf->Cell(0,10,' ',0,1);
			
		$pdf->SetFont('Times','B',9);
			$pdf->Cell(120,5,' ',0,0);
			$pdf->Cell(0,5,'Phone No. : +91 7845465218',0,1);
			$pdf->Cell(120,5,' ',0,0);
			$pdf->Cell(0,5,'Email ID : finance@cronbay-tech.com',0,1);
			$pdf->Cell(120,5,' ',0,0);
			$pdf->Cell(0,5,'Website : www.cronbay-tech.com',0,1);
			
			
			$pdf->Cell(0,10,' ',0,1);
			$pdf->Cell(0,10,' ',0,1);
			
			$pdf->Cell(60,10,' ',0,0);
			$pdf->Cell(0,10,'Computer generated statement doesnot require signature.',0,1);

			$FileName = md5(time()) . '.pdf';
			$folder   = "payrolls";
			$full_path = $folder . '/' . $FileName;
		$pdf->Output($full_path,'F');
		
		//Mail code here
		
		$sql = mysqli_query($connection,"INSERT into payroll(emp_id,file_id,date)VALUES('$emp_id','$full_path','$currentDateTime')");
        if($sql)
		{
			header('location:'.$full_path);
		}
		else{
			echo "<script>window.location.href='index.php'</script>";
			echo "<script>alert('Problem occured while generating Payroll.');</script>";
			}
	}
?>
