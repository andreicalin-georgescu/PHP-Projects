<?php

require 'vendor/autoload.php';
use Todo\TaskManager;

$manager = TaskManager::getInstance();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>Task Planner</title>
	</head>
	<body>
		<style>

			.jumbotron {
				background: #66ccff;
				color: white;
			}

			/* Submit jumbo */

			#jumbo1 {
				min-width: 338px;
				right: 2rem;

			}

			/* Get Task jumbo */

			#jumbo2 {
				min-width: 338px;
				right: 2rem;
				top: 0px;

			}
			
			/* Show all current tasks jumbo */
			#jumbo3 {
				min-width: 338px;
			}
			
		</style>
		<div class="container" id="pag-header">
			<div class="page-header">
				<h1>Task Planner</h1>
			</div>
		</div>
		<br>
		<div class="container">
			<div class="row">
				<div class="col-md-6 dflex flex-md-column">
					<?php
						if(isset($_POST['getAll'])) {
							$tasks = $manager->getAllTasks();
							echo '<div class="jumbotron" id="jumbo3">
										<h2>Current Tasks</h2>';
										foreach ($tasks as $task) {
											echo '<table>
												<tr>
													<th> ID </th>
													<th> Description </th>
													<th> Due Date </th>
													<th> Status </th>
												</tr>';

										echo '<tr><td>' , $task->getId() , '</td>';
										echo '<td>' , $task->getDescription() , '</td>'; 
										echo '<td>' , $task->getDue()->diffForHumans() , '</td>'; 
										echo '<td>' , ($task->getComplete()) ? 'Complete' : 'Due' , '</td></tr></table>'; 	
										}

							echo '</div>';
						}
					?>
				</div>

				<div class="col-md-6">
					<div class="float-md-right">
						<div class="jumbotron" id="jumbo1">
							<h3>Submit a new task</h3>

							<form action="app/Interact/SubmitTask.php" method="post" autocomplete="off">
								<label for="taskDescription">Task Description:</label><br>
								<input type="text" id="taskDescription" name="taskDescription"><br>
								<label for="taskDue">Task Due Date:</label><br>
								<input type="datetime-local" id="taskDue" name="taskDue"><br>
								<br>
								<input class="btn btn-primary" type="submit" name="submitNewTask" value="Submit new task">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-md-4">
					<div class="jumbotron" id="jumbo2">
						<h3>Get details about a task</h3>
						<form action="/app/Interact/GetTask.php" method="post" autocomplete="off">
							<label for="taskId">Task ID:</label><br>
							<input type="number" id="taskId" name="taskId"><br>
							<br>
							<input class="btn btn-primary" type="submit" name="submitButton" value="Find task with this ID"><br>
							<br>
							<h3> Or </h3>
							<input class="btn btn-primary" type="submit" formaction="/index.php" name="getAll" value="Get All Tasks">
						</form>
					</div>
				</div>
			</div>
		</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>
</html>
