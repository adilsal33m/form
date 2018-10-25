<?php
require_once './vendor/autoload.php';
require_once './config/dbconfig.php';
require_once './config/Paginator.php';


?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Form </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="jumbotron">
        <div class="container">
            <h1>Simple Form</h1>
        </div>
    </div>
	<form action="./index.php" class="text-right">
    <input class="btn-info btn" type="submit" value="Go to Enter Data" />
	</form>
	<?php
	$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
	$query = "SELECT * FROM ".$table;
	
	$Paginator = new Paginator($conn, $query);
	$results = $Paginator->getData($limit, $page);
	
	echo "<table border='3' class=\"table table-dark\">
	<tr>
	<th scope=\"col\">ID</th>
	<th scope=\"col\">Name</th>
	<th scope=\"col\">Phone</th>
	<th scope=\"col\">Email</th>
	<th scope=\"col\">City</th>
	</tr>";
	?>
	
	<?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
        <tr>
                <td><?php echo $results->data[$i]['id']; ?></td>
                <td><?php echo $results->data[$i]['firstname']; ?></td>
                <td><?php echo $results->data[$i]['phone']; ?></td>
                <td><?php echo $results->data[$i]['email']; ?></td>
                <td><?php echo $results->data[$i]['city']; ?></td>
        </tr>
	<?php endfor; echo "</table>"; ?>
	<?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?> 
</body>
</html>
