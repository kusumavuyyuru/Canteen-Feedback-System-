<?php
$con  = mysqli_connect("localhost","root","","canteendb");
 if (!$con) {
     # code...
   echo "Problem in database connection! Contact administrator!" . mysqli_error();
 }else{
         $sql ="SELECT * FROM tblsales";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) {
         
            $productname[]  = $row['item1']  ;
            $sales[] = $row['item2'];
        }
     
 
 }
   
 
?>
