<?php

class Tarea
{
  private static $conn;

  public $id;
  public $title;
  public $priority;
  public $fetcha;

  public static function init($db)
  {
    self::$conn = $db;
  }

  public function __construct($id = null , $title = null, $priority = null, $fetcha = null)
  {
    $this->id = $id;
    $this->title = $title;
    $this->priority = $priority;
    $this->fetcha = $fetcha;
  }

  // get tareas
  public static function getTareas()
  {
    $tareas = array();
    $query = 'SELECT * FROM tareas';

    try {

      $stmt = self::$conn->prepare($query);
      $stmt->execute();
      $tareas = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Tarea');
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    return $tareas;
  }

  public static function getTarea($id)
  {
    $tarea = array();

    $query = 'SELECT * FROM tareas WHERE ID = :id';

    $stmt = self::$conn->prepare($query);

    $stmt->execute(['id' => $id]);

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Tarea');
    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

    return $tarea;
  }
}
