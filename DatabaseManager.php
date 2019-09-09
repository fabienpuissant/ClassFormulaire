<?php

class DatabaseManager {

	private $_database;
	private $_all_fields;

	/**
	*@param Object Database a object instance of the class Database
	*@return void
	*/
	public function __construct($database) {
		$this->_all_fields = $database->get_all_fields();
		$this->_database = $database;
	}


	/**
	* Create the head page Html of the Database Manager
	*/
	public function initialize() {
		?>
		<!DOCTYPE html>
			<html>
			<body>
				<head>
				  <meta charset="utf-8" />
    				<meta name="keywords" content="xhtml, html5, form" />
    				<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    				<title>Database</title>
    				<script type="text/javascript" src = "bootstrap/js/bootstrap.js"></script>
    				<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
							<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
				</head>

				<nav class="navbar navbar-expand-lg navbar-light bg-light">
				  <a class="navbar-brand" href="recup.php">Rechercher</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
					  <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Manager
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						  <a class="dropdown-item" href="erase.php">Supprimer utilisateur</a>
						  <a class="dropdown-item" href="update.php">Modifier utilisateur</a>
						</div>
					  </li>
					  <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Téléchargements
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						  <a class="dropdown-item" href="exportPhoto.php">Photo utilisateur</a>
						  <a class="dropdown-item" href="export.php">Base de donnée</a>
						</div>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="logout.php" tabindex="-1" >Se déconnecter</a>
					  </li>
					</ul>
				  </div>
				</nav>

			  <div class="container">
				  <h1>Apercu de la base de données</h1>
			  </div>
	<?php
	}

	/**
	*@param int Optionnal : Number of lines which will be diplayed. By default all the table is displayed.
	*return void : Display the table
	*/
	public function display_table(int $numer_row = 0) {
		//Display the labels of the table
		?>
		<table class="table">
			<thead>
				<tr>
					<?php
					$all_fields_with_id = array("id");
					foreach ($this->_all_fields as $key => $value) {
						$all_fields_with_id[] = $value;
					}
					foreach ($all_fields_with_id as $key => $value) {
						?>
							<th scope="col"><?= $value; ?></th>
						<?php
					}
				?>
				</tr>
			</thead>

		<?php
		//SQL Request
		if ($numer_row == 0){
			$requete = $this->_database->get_bdd()->query("SELECT * FROM ". $this->_database->get_table_name());
		} else {
			$requete = $this->_database->get_bdd()->query("SELECT * FROM ". $this->_database->get_table_name()." LIMIT ". $numer_row ." ORDER BY DESC");
		}

		//Display rows of the table
		$compt = 0;
	   while ($answer = $requete->fetch()){
	     ?>
	       <thead>
	         <tr>
	           <?php for ($i=0; $i<(count($answer))/2; $i++): ?>
	             <th scope="col"><?php echo $answer[$i]; ?></th>
	             <?php $compt++; ?>
	           <?php endfor; ?>
	         </tr>
	       </thead>
	     <?php
	   }
	   ?>
	   </table>
	   <?php
	   $requete->CloseCursor();
	}

 /**
 *Close all html tag
 */
	public function close_html() {
		?>
	</body>
	</html>
	<?php
	}

}
