<?php 

$msg = '';
$msgClass = '';

	if(filter_has_var(INPUT_POST, 'submit')){
		$name = htmlspecialchars($_POST['name']);
		$phone = htmlspecialchars($_POST['phone']);
		$email = htmlspecialchars($_POST['email']);
		if(empty($name) || empty($phone) || empty($email)){
			$msg = 'Please, fill in all fieds!';
			$msgClass = 'alert-danger';
		}else{
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$file = 'people.txt';
				
				if(!file_exists($file)){
					$handle = fopen($file, 'w');
					fclose($handle);
				}
				
				$content = file_get_contents($file);
				$data = 'Name: '.$name.' Phone: '.$phone.' Email: '.$email;
				$content .= "\n".$data;
				/*$content = [
					'Name' => $name,
					'Phone'	=> $phone,
					'Email'	=> $email
				];*/
				file_put_contents($file, $content);
			
				$msg = "Thank you for your information! Your data in now being processed! :)";
				$msgClass = 'alert-success';
			}else{
				$msg = 'Please, inform a valid e-mail address!';
				$msgClass = 'alert-danger';
			}
			
		}
	}

?>

<?php include "header-template.php"; ?>
		<main style="max-width: 75%; margin:auto">
			<div class="container">
				<?php if($msg != ''):?>
					<div class="alert <?php echo $msgClass; ?>">
						<?php echo $msg; ?>
					</div>
				<?php endif; ?>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div class="form-group">
						<br>
						<label>Name</label>
						<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
					</div>
					<div class="form-group">
						<label>Phone number</label>
						<input type="text" name="phone" class="form-control" value="<?php echo isset($_POST['phone']) ? $phone : ''; ?>">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
					</div>
					<br>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					<br><br>
				</form>
			</div>
		</main>
	</body>
</html>