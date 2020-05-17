<?php
    session_start();
    include( 'BDD.php' );
    require ( 'fonctions.php' );

?>
<!DOCTYPE html>
<html>
    <head> 
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

		<!-- Website CSS style -->
		<link rel="stylesheet" type="text/css" href="assets/css/main.css">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Changement de mot de passe</title>
	</head>
	<body>
	
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title"> 
						<?php echo "Bonjour " . $_SESSION['prenom'] ." ". $_SESSION['nom']; ?> <br><br>
                        <?php echo "Votre adresse mail : ".$_SESSION['email']; ?>
                        </h1>
	               		<hr/>
	               	</div>
	            </div> 
				
				<div class="main-login main-center">
					<form method ="POST">
						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Photo</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="file" class="form-control" name="photo" id="username">
								</div>
							</div>
						</div>
					</form>
					
					<form method ="GET">
						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label"> Ton mot de passe actuelle </label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Entrer votre mot de passe" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label"> Le nouveau mot de passe </label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Entrer le nouveau mot de passe" />
								</div>
							</div>
						</div>

                        <div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label"> Confirmer le nouveau mot de passe </label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="iconfirm" id="confirm"  placeholder="Confirmer le nouveau mot de passe" />
								</div>
							</div>
						</div>

						<div class="form-group ">
							<button type="submit" name="update" class="btn btn-primary btn-lg btn-block login-button">Confirmer</button>
						</div>
					</form>
				</div>
			</div>
		</div>	
	<?php
		if ( isset ( $_GET['update'] ) ){
			modifier ( $_SESSION['email'], $_GET['password'], $_GET['confirm'], $_GET['iconfirm'], $db );
		}
	?>	
	</body>
</html>