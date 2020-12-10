<?php require_once("resources/config.php"); ?>

<!DOCTYPE html>
<html>
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>View User</title>
			
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/viewuser.css" >
	
	</head>

	<body>
		<div>
			<p align="right"><a class="btn1" href="user.php" align="right">Back</a></p>

			<form method="POST" action="">
			
				<h2>Transfer Credit<br/>From:</h2>

				<?php $txt=user(); ?>

				<h3>Select Name to transfer the Credits:</h3>
				
				<div>
					<select required name="touser" id="listu1">
						<option value="">Select Users</option>
						<?php option(); ?>
					</select>
				</div>

				<div class="horizontal">
					<span class="amt">Amount</span>
					<input type="text" id="amt" name="credits" required="required">
					<input name="from" type="hidden" value="<?php echo $txt;?>">
					<button class='btn2' name='' onclick="myfun();">Transfer Credits</button>
				</div>
			</form>	
		
		</div>
			<?php include'resources/footer.php' ; ?>

		<script>
			function myfun()
			{
				var r = confirm("Are you sure?");
				if(r == true)
				{
					document.querySelector("form").setAttribute("action",'transfer.php');
					document.querySelector('.btn2').setAttribute("name",'transfer');
				}
				else
				{
					document.querySelector("form").setAttribute("action",'user.php');
				}
			}
		</script>

	</body>