<html>
<head>
	<title> Rules </title>
	
</head>

<body>

	
	<?php
	require ('connect.php');
	ini_set('max_execution_time', 120); //300 seconds = 5 minutes
	
		$sql2 = "SELECT * from association_rules"; //select everything
		$result2 = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result2) > 0) {
		    // output data of each row
			
			while($row = mysqli_fetch_assoc($result2)) {
				$id9=$row["row_names"];
				
				$fr_rules=$row["rules"];
				$fr_lift=$row["lift"];
				
		    	//$sql10 = "UPDATE for_related SET rules = '$fr_rules' WHERE row_names='$id9'";//INSERT INTO for the 1st time, then update
		    	//$result10 = mysqli_query($conn, $sql10);
				$sql10 = "UPDATE for_related SET lift = '$fr_lift' WHERE row_names='$id9'";//INSERT INTO for the 1st time, then update
				$result10 = mysqli_query($conn, $sql10);
				
		    	}//post everything
		    	
		    }

		    ?>

			
			<?php
			require ('connect.php');
			
			$sql5 = "SELECT * from association_rules" ; //select everything
			$result5 = mysqli_query($conn, $sql5);

			if (mysqli_num_rows($result5) > 0) {
		    // output data of each row
				
				while($row = mysqli_fetch_assoc($result5)) {
					$id1=$row["row_names"];
					$str = $row["rules"];
					$myarray = preg_split("[=>]",$str);
					$length = strlen($myarray[0]);
					$comma=$myarray[0];
					
					
					if (strpos($comma, ',') !== false) {
						$comma_split = preg_split("[,]",$comma);
						$length2=strlen($comma_split[0]);
				//$length1=strlen($myarray[1]);
					
						$ante1= substr($comma_split[0],1,$length2-1);
					
				$sql11 = "UPDATE for_related SET ant1 = '$ante1' WHERE row_names='$id1'";//insert details of question
				$result11 = mysqli_query($conn, $sql11);
			
				
		
				//echo substr($myarray[1],2,$length1-3)."<br>";

				
			}
			else{
				
				$ante1= substr($myarray[0],1,$length-3);
				
				$sql111 = "UPDATE for_related SET ant1 = '$ante1' WHERE row_names='$id1'";
				$result111 = mysqli_query($conn, $sql111);
				
				
			
			}
			
		}
	}
	
	

	?>

</td>
<td> 
	<?php
	require ('connect.php');
	
			$sql7 = "SELECT * from association_rules" ; //select everything
			$result7 = mysqli_query($conn, $sql7);

			if (mysqli_num_rows($result7) > 0) {
		    // output data of each row
				
				while($row = mysqli_fetch_assoc($result7)) {
					$id2=$row["row_names"];
					$str2 = $row["rules"];
					$myarray2 = preg_split("[=>]",$str2);
					$comma1=$myarray2[0];
					$comma_split1 = preg_split("[,]",$comma1);
					if ( ! isset($comma_split1[1])) {
		
						$comma_split1[1] = NULL;
					}
					$length33=strlen($comma_split1[1]);
				//$length1=strlen($myarray[1]);
				
					$ante2=substr($comma_split1[1],0,$length33-2);
			
				 $sql12 = "UPDATE for_related SET ant2 = '$ante2' WHERE row_names='$id2'";//insert details of question
				 $result12 = mysqli_query($conn, $sql12);
			
				 
			
				//echo substr($myarray[1],2,$length1-3)."<br>";
				}
				
			}
			?>

			
			<?php
			require ('connect.php');
			
			$sql6 = "SELECT * from association_rules" ; //select everything
			$result6 = mysqli_query($conn, $sql6);

			if (mysqli_num_rows($result6) > 0) {
		    // output data of each row
				
				while($row = mysqli_fetch_assoc($result6)) {
					$id3 = $row["row_names"];
					$str1 = $row["rules"];
					$myarray1 = preg_split("[=>]",$str1);
				//$length2 = strlen($myarray1[0]);
					if ( ! isset($myarray1[1])) {
						$myarray1[1] = NULL;
					}
					$length22=strlen($myarray1[1]);
					
					$conse = substr($myarray1[1],2,$length22-3);
					

				$sql13 = "UPDATE for_related SET cons = '$conse' WHERE row_names='$id3'";//insert details of question
				$result13 = mysqli_query($conn, $sql13);
			
				//echo substr($myarray1[0],1,$length2-3)."<br>";
			}
		}
		?>

		<?php
		require ('connect.php');
		
			$sql1 = "SELECT * from association_rules" ; //select everything
			$result1 = mysqli_query($conn, $sql1);

			if (mysqli_num_rows($result1) > 0) {
		    // output data of each row
				
				while($row = mysqli_fetch_assoc($result1)) {
					
		    	}//post everything
		    	
		    }

		    ?>

			<?php
			require ('connect.php');
			
			$sql3 = "SELECT * from association_rules "; //select everything
			$result3 = mysqli_query($conn, $sql3);

			if (mysqli_num_rows($result3) > 0) {
		    // output data of each row
				
				while($row = mysqli_fetch_assoc($result3)) {
				
					
		    	}//post everything
		    	
		    }

		    ?>

			<?php
			require ('connect.php');
			
			$sql4 = "SELECT * from association_rules "; //select everything
			$result4 = mysqli_query($conn, $sql4);

			if (mysqli_num_rows($result2) > 0) {
		    // output data of each row
				
				while($row = mysqli_fetch_assoc($result4)) {
			
					
		    	}//post everything
		    	
		    }

		    ?>
</body>

</html>



