<!DOCTYPE html>
<html>
<head>
    <title>Admin Portal</title>
    <link rel="stylesheet" type="text/css" href="final_style.css">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

		* {
			margin: 0px;
			padding: 0px;
			font-family: 'Roboto', sans-serif;
		}

		nav {
			background-color: white;
			/* background-color: red; */
			box-shadow: 0 0.5em 1em rgba(0, 0, 0, 0.1);
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 1;
		}

		nav ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
		}

		nav li {
			float: left;
		}

		nav li a {
			display: block;
			color: #428bca;
			font-size: 1.2em;
			padding: 0.8em 1em;
			text-align: center;
			text-decoration: none;
			transition: background-color 0.3s ease;
		}

		nav a.active {
			/* border-bottom: 2px solid blue; */
			background-color: white;
			/* border-bottom: 2px solid blue; */
		}

		nav li a:hover {
			/* transform: scale(1.2); */
			border-bottom: 2px solid blue;
		}

		body {
			/* font-family: Arial, sans-serif; */
		}



		.cource {
			/* margin: 100px; */
			display: flex;
			flex-wrap: wrap;
			margin: 80px 80px;
			/* align-items: center; */
			/* justify-content: center; */
		}

		table {
			border-collapse: collapse;
			width: 100%;
			text-align: center;
		}

		th {
			background-color: #428bca;
			color: white;
			font-weight: bold;
			text-transform: uppercase;
		}

		th,
		td {
			padding: 12px;
		}

		tr {
			border: 1px solid #ddd;

		}

		tr:hover {
			background-color: #f5f5f5;
		}

		.btn {
			border: none;
			background-color: #428bca;
			border-radius: 0.5em;
			color: #fff;
			cursor: pointer;
			font-size: 1em;
			padding: 0.5em 1em;
			text-align: center;
			text-decoration: none;
			transition: background-color 0.3s ease;
		}

		.btn:hover {
			background-color: #3071a9;
		}
	</style>
</head>
<body>
	
	<?php
    // Connect to the database
	include 'db.php';
	include 'header.php';
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete user if delete button is clicked
    if (isset($_GET['delete'])) {
        $roll_no = $_GET['delete'];
        $query = "DELETE FROM user WHERE roll_no = '$roll_no'";
        mysqli_query($conn, $query);
        
        // Redirect to same page
        // header("Location: admin_start (1).php");
        // exit();
		// echo "<h2>Deleted Successfully</h2>";
    }

    // Display list of users
    $query = "SELECT * FROM user";
    $result = mysqli_query($conn, $query);

	if ($result === false) {
		die("Error executing query: " . mysqli_error($conn));
	}

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>RollNo</th><th>Username</th><th>Email</th><th>Semester</th><th>Grade</th><th>Action</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['roll_no'] . "</td>";
            echo "<td>" . $row['userName'] . "</td>";
            echo "<td>" . $row['email_id'] . "</td>";
            echo "<td>" . $row['semester'] . "</td>";
            echo "<td>" . $row['cgpa'] . "</td>";
            echo "<td><a href=\"http://localhost/LAMP_Pracs/Innovative/admin_user.php?delete=" . $row['roll_no'] . "\" class='btn'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No users found.";
    }

    mysqli_close($conn);
    ?>

</body>
</html>
