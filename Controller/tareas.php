<?php

include_once('createTasksHTML.php');
include_once('../config/Database.php');
include_once('../model/Tarea.php');

$db = Database::connect();

Tarea::init($db);

$tareas = Tarea::getTareas();

// title, fecha limite, prioridad

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  switch ($_POST['action']) {
    case 'addTask':
      addTask($tareas);
      break;
    case 'clearTasks':
      clearTasks($tareas);
      break;
    case 'deleteTask':
      deleteTask($_POST['id'], $tareas);
      break;
    case 'sortTasksDesc':
      uasort($tareas, function ($a, $b) {
        return ($a['priority'] <=> $b['priority']);
      });
      break;
    case 'sortTasksAsc':
      uasort($tareas, function ($a, $b) {
        return ($b['priority'] <=> $a['priority']);
      });
      break;
    case 'filterDate':
      filterDate($tareas, $_POST['date']);
      break;
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  echo $tareas[0]->title;
}


function addTask(&$tareas)
{
  $title = $_POST['title'];
  $priority = $_POST['priority'];
  $dueDate = $_POST['due-date'];
  $tareas[] = array('title' => $title, 'dueDate' => $dueDate, 'priority' => $priority);
}

function deleteTask($id, &$tareas)
{
  unset($tareas[$id]);
  $tareas = array_values($tareas);
}

function clearTasks(&$tareas)
{
  $tareas = array();
}

function filterDate(&$tareas, $date)
{
  $tareas = array_filter($tareas, function ($task) use ($date) {
    return $task['dueDate'] == $date;
  });
}
