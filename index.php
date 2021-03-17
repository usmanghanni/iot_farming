<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<script src="./lib/js/jquery.min.js"></script>
<script src="./lib/js/chart.js"></script>

</head>
<body>


<?php
$hostname = "localhost";
$username = "root";
$password = "tstark";
$db = "kkkp";

$conn=mysqli_connect($hostname,$username,$password,$db);
if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}
echo "Connected Successfully";
?>

<div style="width:60%; height:100px; margin:0 auto;">
<canvas id="canvas"></canvas>
  </div>

<button id="plott">plot</button>
<table id="datatable" border="1" align="center" >
<tr>
  <td>S ID</td>
  <td>temp 1</td>
  <td>temp2</td>
  <td>hum1</td>
  <td>hum2</td>
  <td>time added</td>

</tr>
<?php



// $query = mysqli_query($conn, "SELECT *  from books join authors on books.authid=authors.id join series on series.id=books.sid");
$query = mysqli_query($conn, "SELECT *  from sensdata;");

$temp1_array = array();
$temp2_array = array();
$hum1_array = array();
$hum2_array = array();
$time_array = array();
// $query = mysqli_query($conn, "SELECT *  from books");
while ($row = mysqli_fetch_array($query)) {
  $temp_array = array($row['sid'], $row['temp1'], $row['temp2'], $row['hum1'], $row['hum2'], $row['time_added']);
  
  array_push($temp1_array, $temp_array[1]);
  array_push($temp2_array, $temp_array[2]);
  array_push($hum1_array, $temp_array[3]);
  array_push($hum2_array, $temp_array[4]);
  array_push($time_array, $temp_array[5]);
  echo
   "<tr>
    <td>{$temp_array[0]}</td>
    <td>{$temp_array[1]}</td>
    <td>{$temp_array[2]}</td>
    <td>{$temp_array[3]}</td>
    <td>{$temp_array[4]}</td>
    <td>{$temp_array[5]}</td>
    
   </tr>\n";
   }



?>
</table>

<script type="text/javascript">

var config = {
			type: 'line',
			data: {
				labels: <?php echo json_encode($time_array); ?>,
				datasets: [{
					label: 'temp1',
					backgroundColor: 'red',
					borderColor: 'red',
					data: <?php echo json_encode($temp1_array); ?>,
					fill: false,
				}, {
					label: 'temp2',
					backgroundColor: 'blue',
					borderColor: 'blue',
					data: <?php echo json_encode($temp2_array); ?>,
					fill: false,
				}, {
					label: 'hum1',
					backgroundColor: 'green',
					borderColor: 'green',
					data: <?php echo json_encode($hum1_array); ?>,
					fill: false,
				}, {
					label: 'hum2',
					backgroundColor: 'yellow',
					borderColor: 'yellow',
					data: <?php echo json_encode($hum2_array); ?>,
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Chart.js Line Chart'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			}
		};

		

		document.getElementById('plott').addEventListener('click', function() {
			document.getElementById("datatable").style.marginTop = "400px";
      var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		});

</script>


<?php
CloseCon($conn);

?>
</body>
</html>