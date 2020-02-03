<!DOCTYPE html>
<html>
<body>
    <head>
      <meta charset="utf-8" />
      <meta name="keywords" content="xhtml, html5, form" />
      <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
      <title>Formulaire</title>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    </head>

<?php


require("FormClass.php");
require('Database.php');


  $form = new Formulaire('');
  $form->add_email("Email", "Email", false);
  $form->add_password("Mot de Passe", "Mdp");
  $form->add_submit("Envoyer");


  $data = new Database("bdd_handicop", "root", '', "Test3", $form->get_data());
  var_dump($form->get_data());
  if(!empty($_POST)){
    foreach ($_POST as $key => $value) {
      $_POST[$key] = htmlspecialchars($_POST[$key]);
    }
    $data ->add($_POST);
  }
  //$data->update(array('TestRadio' => "Test2", "Email" => "TestWeek" ), array('TestRadio' => 'Test2', 'Checkbox' => 'TestWeek'));
  //$data->delete(array('TestRadio' => "Test1", "Email" => "test@test"));

  ?>
