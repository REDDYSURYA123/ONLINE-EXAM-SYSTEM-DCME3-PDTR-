<?php
$serverName="localhost";
$userName="root";
$password="";
$dbname="examination";
$conn=mysqli_connect($serverName,$userName,$password,$dbname);
if(!$conn)
{
    echo " database connection was not successful because ".mysqli_connect_error()."<br>";
}















































// $query="CREATE TABLE results (id int NOT NULL AUTO_INCREMENT PRIMARYKEY, st_phone varchar(10), subject_name varchar(255) NOT NULL, score INT NOT NULL ,
//  total_questions INT NOT NULL, attempted_at DATETIME DEFAULT CURRENT_TIMESTAMP)";
// if(mysqli_query($conn,$query))
// {
//     echo "Table created successfully";
// }
// else{
//     echo "Table not creted ".mysqli_error($conn);
// }











// $query="DELETE FROM userdtls WHERE st_name='dinesh'";
// if(mysqli_query($conn,$query))
// {
//     echo "Table created successfully";
// }
// else{
//     echo "Table not creted ".mysqli_error($conn);
// }

























































// $sql="DELETE FROM USERDTLS WHERE st_name='jhbsjqu' ";
//  if(mysqli_query($conn,$sql))
//  {
//      echo "Row deleted successfully";
//  }
//  else{
//      echo "Row not deleted successfully".mysqli_error($conn);
//  }



// $sql="CREATE TABLE userdtls(st_name varchar(30), st_pass int(25),st_email varchar(35),st_phone int(10) )";
// if(mysqli_query($conn,$sql))
// {
//     echo "table created successfully";
// }
// else{
//     echo "table not created successfully".mysqli_error($conn);
// }



// $sql="INSERT INTO ADMINDTLS VALUES(220222025,202522022)";
// if(mysqli_query($conn,$sql)){
//     echo "inserted successfully";
// }
// else{
//     echo "error creating table".mysqli_error($conn);
// }
//  mysqli_close($conn);
?>

