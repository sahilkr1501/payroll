<?php

$pdf->Output($full_path,'F');


$mailto = $email;
    $subject = 'PaySlip '.$fname.' '.$lname.' | Cronbay Technologies';
    $message ="Dear ".$fname.", Below is the attached automated generated Salary Slip for ".$month.".\n\n\n\n\n\n\n\nCronbay Technologies Pvt. Ltd. \nUnit 109, 2nd floor, Regent prime no 48, Whitefield main road, \nBangalore-560066";

    $content = file_get_contents($full_path);
    $content = chunk_split(base64_encode($content));

    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From: Cronbay Technologies <no-reply@cronbay-tech.com>" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;

    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $FileName . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {
        	$sql = mysqli_query($connection,"INSERT into payroll(emp_id,file_id,month,date)VALUES('$emp_id','$full_path','$month','$currentDateTime')");
        	
        	$newmonth = str_replace(' ', '%20', $month);
        	$newname = str_replace(' ', '%20', $fname);
        	
        	$url = 'http://bhashsms.com/api/sendmsg.php?user=VIKAS1&pass=hackervikas@321&sender=AGIROI&phone='.$phone.'&text=Mr%2E%20'.$newname.'%2C%20Your%20salary%20slip%20for%20'.$newmonth.'%20has%20been%20sent%20to%20your%20registered%20mail%20by%20Cronbay%20Technologies%2E%0D%0A%20%20-via%20One%20Byte%20Labs&priority=ndnd&stype=normal';
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    $result = curl_exec($ch);
                    curl_close($ch);
                    var_dump($result);
        	
		if($sql)
		{
			echo "<script>alert('Payroll Generates Successfully.');</script>";
			echo "<script>window.location.href='index.php'</script>";
		}
		else{
			echo "<script>alert('Problem occured while generating Payroll.');</script>";
			echo "<script>window.location.href='index.php'</script>";

		}
        
    }
    else {
        echo "<script>alert('Problem occured while generating Payroll.');</script>";
			echo "<script>window.location.href='index.php'</script>";
        print_r( error_get_last() );
    }
?>