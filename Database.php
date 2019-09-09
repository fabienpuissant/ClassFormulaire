<?php

/**
* Class Database
* Manage Database from a form
*/
class Database {

  private $_all_fieds;
  private $_table_name;
  private $_bdd;

  /**
  *@param string Database name
  *@param string User name to connect database
  *@param string Password to connect bdd
  *@param string Table name which will be created
  *@param array Array of all fields name of the form
  *@return void
  */
  public function __construct($dbname, $dbuser, $dbpassword, $tableName, $data){
    $this->_table_name = $tableName;
    $this->_all_fieds = $data;
    try
      {
       	$this->_bdd = new PDO('mysql:host=localhost;dbname='.$dbname.';charset=utf8',  $dbuser , $dbpassword);
      }
      catch(Exception $e)
      {
             die('Erreur : '.$e->getMessage());
      }

      $requete = "CREATE TABLE IF NOT EXISTS ". $tableName ." (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";

      foreach ($data as $key => $value) {
        $requete = $requete.  $value ." VARCHAR (255) NULL, ";
      }

      $requete = substr($requete, 0, -2);
      $requete = $requete.")";
      $this->_bdd->prepare($requete)->execute();

  }


/**
*@param array Array key : field name in the database, value : value to set in the database
*@return void
*/
public function add($array) : void {
  $requete = "INSERT INTO " . $this->_table_name . " (";
  $labels = "";
  $values_string = "";
  foreach ($array as $key => $value) {
    $labels = $labels . $key . ", ";
    $values_string = $values_string . "?, ";
    $values[] = htmlentities($value);
  }

  $labels = substr($labels, 0, -2);
  $values_string = substr($values_string, 0, -2);
  $requete = $requete . $labels . ") VALUES (" . $values_string . ")";
  $this->_bdd->prepare($requete)->execute($values);

}


/**
*@param array key = field to look for, value = the value which is to be found to catch the row in the table. This array can have multiple keys, you have to pass the minimum of key to identify the row which be deleted
*@return void
*/
public function delete($array){
	$requete = "DELETE FROM " . $this->_table_name ." WHERE ";
	foreach ($array as $key => $value){
		$requete = $requete.$key."="."'".htmlentities($value)."'"."AND ";
	}
	$requete = substr($requete, 0, -4);
	$this->_bdd->exec($requete);
}


/**
*@param array key = field to look for, value = the value which is to be found to catch the row in the table. This array can have multiple keys, you have to pass the minimum of key to identify the row which be updated
*@param array key = field which will be updated, value = the updated value
*@return void
*/
public function update($array_find, $array_update){
	
	$check = "SELECT * FROM " . $this->_table_name ." WHERE ";

	$requete = "UPDATE " . $this->_table_name ." SET ";
	foreach ($array_update as $key => $value){
		$requete = $requete.$key."="."'".htmlentities($value)."'".", ";
	}
	$requete = substr($requete, 0, -2);
	$requete = $requete." WHERE ";
	foreach ($array_find as $key => $value){
		$requete = $requete.$key."="."'".htmlentities($value)."'"." AND ";
		$check = $check.
	}
	$requete = substr($requete, 0, -4);
	$this->_bdd->exec($requete);

}

}

 ?>
