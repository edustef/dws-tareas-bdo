<?php

include_once('../config/Database.php');
include_once('../model/Tarea.php');
include_once('../Views/VistaTarea.php');

$tareas = Tarea::getTareas();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  switch ($_POST['action']) {
    case 'addTarea':
      Tarea::addTarea($_POST['titulo'], $_POST['prioridad'], $_POST['fetcha']);
      $tareas = Tarea::getTareas();
      break;
    case 'clearTareas':
      Tarea::clearTareas();
      $tareas = Tarea::getTareas();
      break;
    case 'deleteTarea':
      Tarea::deleteTarea($_POST['id']);
      $tareas = Tarea::getTareas();
      break;
    case 'sortTareasDesc':
      // TO DO 
      $tareas = Tarea::sortTareas(true);
      break;
    case 'sortTareasAsc':
      // TO DO
      $tareas = Tarea::sortTareas();
      break;
    case 'filterFetcha':
      $tareas = Tarea::filterFetcha($_POST['fetcha']);
      break;
    default:
      $tareas = Tarea::getTareas();
      break;
  }
}

VistaTarea::render($tareas);
