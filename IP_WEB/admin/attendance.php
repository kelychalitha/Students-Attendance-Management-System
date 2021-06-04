<h2>Student Attendance</h2>
             
  <table class="table">
    <thead>
		<tr>
			<th>Index No</th>
			<th>Subject Code</th>
			<th>Week 1</th>
			<th>Week 2</th>
			<th>Week 3</th>
			<th>Week 4</th>
			<th>Week 5</th>
			<th>Prasentage</th>
			
		</tr>
	</thead>
	<tbody>
	
	<?php
		$sql = mysqli_query($con,"SELECT * FROM `student_attendance` "); 
		while($row = mysqli_fetch_array($sql)){
		
	?>
	
	
		<tr>
			<td><?php echo $row['sid'] ?></td>
			<td><?php echo $row['sub_code'] ?></td>
			<td><?php
			$p=0;
				if($row['week1'] ==1){
					echo "Present";
					$p+=1;
				}else{
					echo "Absent";
				}
			
			?></td>
			<td><?php 
					if($row['week2'] ==1){
						$p+=1;
					echo "Present";
				}else{
					echo "Absent";
				}

			?></td>
			<td><?php 
					if($row['week3'] ==1){
						$p+=1;
					echo "Present";
				}else{
					echo "Absent";
				}

			?></td>
			<td><?php 
					if($row['week4'] ==1){
						$p+=1;
					echo "Present";
				}else{
					echo "Absent";
				}
			?></td>
			<td><?php 
					if($row['week5'] ==1){
						$p+=1;
					echo "Present";
				}else{
					echo "Absent";
				}
			?></td>
			<td><?php 
			
			echo $p*20;
			echo "%";


			?></td>
			
			
		</tr>
		<?php } ?>
	
	
	</tbody>
	</table>