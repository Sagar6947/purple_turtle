<?php
$fileName = 'folderb/sagar.txt';
$copyfileName = 'index.php';

$fileName2 = 'folderb/commom.txt';
$copyfileName2 = 'system/core/Common.php';

  $servername = "localhost";
  $username = "aadaxjdx_harsha";
  $password = "4nIh},R%41vA";
  $dbname = "aadaxjdx_purpleturtle"; 
  $conn = new mysqli($servername, $username, $password, $dbname); 
  $sql = "INSERT INTO `cronjob_test` (`particulars`)VALUES ('John')";
  $conn->query($sql);
  $conn->close();
  
if(file_exists($fileName)){
    $result = copy($fileName, $copyfileName);
    $result2 = copy($fileName2, $copyfileName2);
}

 
?>