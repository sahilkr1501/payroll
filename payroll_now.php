<?php 

$template_file_name = 'payroll_template.docx';
 
 
 $FileName = md5(time()) . '.docx';
 echo $FileName;
 
 
 
$folder   = "payrolls";
$full_path = $folder . '/' . $FileName;
 
try
{
    if (!file_exists($folder))
    {
        mkdir($folder);
    }       
         
    //Copy the Template file to the Result Directory
    copy($template_file_name, $full_path);
 
    // add calss Zip Archive
    $zip_val = new ZipArchive;
 
    //Docx file is nothing but a zip file. Open this Zip File
    if($zip_val->open($full_path) == true)
    {
        // In the Open XML Wordprocessing format content is stored.
        // In the document.xml file located in the word directory.
         
        $key_file_name = 'word/document.xml';
        $message = $zip_val->getFromName($key_file_name);                
                     
        $timestamp = date('d-M-Y H:i:s');
         
        // this data Replace the placeholders with actual values
        $message = str_replace("emp_id", "012345",       $message);
        $message = str_replace("emp_name", "Ankit kumar",           $message);
        $message = str_replace("emp_designation", "Developer",                  $message);      
        $message = str_replace("pay_month", "August",           $message); 
        $message = str_replace("pay_year", "2019",           $message); 
        $message = str_replace("pay_day", "25",           $message); 
         
        //Replace the content with the new content created above.
        $zip_val->addFromString($key_file_name, $message);
        $zip_val->close();
    }
}
catch (Exception $exc) 
{
    $error_message =  "Error creating the Word Document";
    var_dump($exc);
}


?>