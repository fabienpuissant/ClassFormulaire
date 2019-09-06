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
  $form->add_radio("Choisir une option", array("Test1", "Test2"), "TestRadio");
  $form->add_email("Email", "Email", false);
  $form->add_checkbox("Accepter", "Checkbox");
  $form->add_tel("Date de naissance", "Date", true);
  $form->add_password("Semaine", 'Semaine');
  $form->add_submit("Aller");
  var_dump($form->get_data());
  $data = new Database("bdd_handicop", "root", '', "test2", $form->get_data());
  $data ->add_user($arrayName = array('TestRadio' => "TestRadio", "Email" => "Email" ));

  ?>
