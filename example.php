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
require("DatabaseManager.php");

  $form = new Formulaire('');
  $form->add_radio("Choose an option", array("Test1", "Test2"), "TestRadio");
  $form->add_email("Email", "Email", false);
  $form->add_checkbox("Accept", "Checkbox");
  $form->add_tel("Birthdate", "Date", true);
  $form->add_password("Week", 'Week');
  $form->add_submit("Aller");


  $data = new Database("bdd_handicop", "root", '', "test2", $form->get_data());
//  $data ->add($arrayName = array('TestRadio' => "Test1", "Email" => "test@test"));
  $data->update(array('TestRadio' => "Test1", "Email" => "test@test" ), array('TestRadio' => 'Test2', 'Week' => 'TestWeek'));
  //$data->delete(array('TestRadio' => "Test1", "Email" => "test@test"));

  $databaseManager = new DatabaseManager($data);
  $databaseManager->initialize();
  $databaseManager->display_table();
  $databaseManager->close_html();

  ?>
