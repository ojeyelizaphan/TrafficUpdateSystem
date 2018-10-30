<!DOCTYPE html>
<html>
<head>
	<title>Traffic Update</title>
	<link rel="stylesheet" 
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<center>
  <h1>TRAFFIC UPDATE</h1>
  <fieldset>
  	<form action="" method="POST">
  		<input type="text" name="road_name" placeholder="Enter Road Name"><br><br>
  		<input type="text" name="traffic_info" placeholder="Enter Traffic Info"><br><br>
        <input type="submit" value="POST" class="btn btn-info">
  	</form>
  </fieldset>
  </center>
</body>
</html>

<?php 
$conn = mysqli_connect("localhost","root","","clinic_db");
$response1 = mysqli_query($conn, "SELECT * FROM table_traffic ORDER BY time DESC");
   while ($row = mysqli_fetch_array($response1)) {
   	echo "<i class='text-muted'> $row[0]</i>";
   	echo "<p class='alert alert-warning'> $row[1]</p>";
   	echo "<b class='badge badge-secndary'> $row[2]</b>";
   	echo "<hr>";
   }

   if (empty($_POST)) {
	exit();//quit executing php code until,Form Button is clicked
}

$object = new Traffic($_POST['road_name'],$_POST['traffic_info']);
$object->save();


class Traffic{
	function __construct($road_name,$traffic_info){
      $this->road_name = $road_name;
      $this->traffic_info = $traffic_info;
	}//end constructor

    function save(){
    	$conn = mysqli_connect("localhost","root","","clinic_db");
    	$response=mysqli_query($conn, "INSERT INTO `table_traffic`
    		(`road_name`, `traffic_info`)
    	 VALUES ('$this->road_name','$this->traffic_info')");

    	if ($response==true) {
		echo "Record Saved Succesfully";
		header("location:addtraffic.php");
	    }

    else{
    	echo "Record Failed.Check Your Details";
    }
    }//end function save


   

}//end class










 ?>