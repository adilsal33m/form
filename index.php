<?php
require_once './vendor/autoload.php';
require_once './config/dbconfig.php';

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 

$helperLoader = new SplClassLoader('Helpers', './vendor');
$helperLoader->register();

use Helpers\Config;

$config = new Config;
$config->load('./config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = stripslashes(trim($_POST['form-name']));
	$designation    = stripslashes(trim($_POST['form-designation']));
	$employee_id    = stripslashes(trim($_POST['form-employee_id']));
	$department    = stripslashes(trim($_POST['form-department']));
	$work    = stripslashes(trim($_POST['form-work']));
	$description    = stripslashes(trim($_POST['form-description']));
	
    if ($name && $designation && $employee_id && $department && $work && $description) {
        $sql = "INSERT INTO ".$table." (name, designation, employee_id, department, work, description)
		VALUES ('$name', '$designation', '$employee_id', '$department', '$work', '$description')";
		if ($conn->query($sql) === TRUE) {
		$body = "Name: ".$name."\n";
		$body = $body."Designation: ".$designation."\n";
		$body = $body."Employee Code: ".$employee_id."\n";
		$body = $body."Department: ".$department."\n";
		$body = $body."Work Type: ".$work."\n\n";
		$body = $body."Issue Description: \n".$description."\n";
		$body = $body."\n\nThis is an auto-generated mail.";
		foreach ($config->get('emails.to') as $v){
			mail($v, "Issue Registration", $body, "From: ".$config->get('emails.from')."\n");
		}
			$emailSent = true;
		} else {
			echo "Error entering data: " . $conn->error;
			$hasError = true;
		}
    } else {
        $hasError = true;
    }
}
?><!DOCTYPE html>
<html>
<head>
    <title>Issue Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="jumbotron">
        <div class="container">
            <h1>Issue Registration</h1>
        </div>
    </div>
	<form action="./list.php" class="text-right">
    <input  class="btn-info btn" type="submit" value="Go to View Issues" />
	</form>
    <?php if(!empty($emailSent)): ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success text-center"><?php echo $config->get('messages.success'); ?></div>
        </div>
    <?php endif; ?>
        <?php if(!empty($hasError)): ?>
        <div class="col-md-5 col-md-offset-4">
            <div class="alert alert-danger text-center"><?php echo $config->get('messages.error'); ?></div>
        </div>
        <?php endif; ?>

    <div class="col-md-6 col-md-offset-3">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="application/x-www-form-urlencoded" id="contact-form" class="form-horizontal" method="post">
            <div class="form-group">
                <label for="form-name" class="col-lg-2 control-label"><?php echo $config->get('fields.name'); ?></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="form-name" name="form-name" placeholder="<?php echo $config->get('fields.name'); ?>" required>
                </div>
            </div>
			<div class="form-group">
                <label for="form-designation" class="col-lg-2 control-label"><?php echo $config->get('fields.designation'); ?></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="form-designation" name="form-designation" placeholder="<?php echo $config->get('fields.designation'); ?>" required>
                </div>
            </div>
			<div class="form-group">
                <label for="form-employee_id" class="col-lg-2 control-label"><?php echo $config->get('fields.employee_id'); ?></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="form-employee_id" name="form-employee_id" placeholder="<?php echo $config->get('fields.employee_id'); ?>" required>
                </div>
            </div>
			<div class="form-group">
                <label for="form-department" class="col-lg-2 control-label"><?php echo $config->get('fields.department'); ?></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="form-department" name="form-department" placeholder="<?php echo $config->get('fields.department'); ?>" required>
                </div>
            </div>
			<div class="form-group">
                <label for="form-work" class="col-lg-2 control-label"><?php echo $config->get('fields.work'); ?></label>
                <div class="col-lg-10">
					<select class="form-control" id="form-work" name="form-work" required>
					<option value="" disabled selected>Select your work</option>
					  <?php foreach ($config->get('work_fields') as $k => $v): ?>
						<option value="<?php echo $v;?>"><?php echo $v;?></option>
					  <?php endforeach; ?>
					</select>
                </div>
            </div>
			<div class="form-group">
                <label for="form-description" class="col-lg-2 control-label"><?php echo $config->get('fields.description'); ?></label>
                <div class="col-lg-10">
                    <textarea type="text" rows="3" class="form-control" id="form-description" name="form-description" placeholder="<?php echo $config->get('fields.description'); ?> (500 characters)" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-default"><?php echo $config->get('fields.submit'); ?></button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="public/js/contact-form.js"></script>
    <script type="text/javascript">
        new ContactForm('#contact-form');
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
    </script>
</body>
</html>
