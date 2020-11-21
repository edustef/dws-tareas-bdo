<?php

class Tarea
{
  private static $conn;
  private static $table = 'tareas';

  public $id;
  public $title;
  public $priority;
  public $fetcha;

  public static function init($db)
  {
    self::$conn = $db;
  }

  public function __construct($id, $title, $priority, $fetcha)
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

    $query = 'SELECT * FROM :table';

    $stmt = self::$conn->prepare($query);

    $stmt->execute(['table' => self::$table]);

    $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE);

    if ($stmt->rowCount() > 0) {
      while ($tarea = $stmt->fetch()) {
        $tareas[] = $tarea;
      }
    }

    return $tareas;
  }

  public static function getTarea()
  {
    $tarea = array();

    $query = 'SELECT * FROM :table';

    $stmt = self::$conn->prepare($query);

    $stmt->execute(['table' => self::$table]);

    if ($stmt->rowCount() > 0) {
      while ($tarea = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tarea = $tarea;
      }
    }

    return $tarea;
  }
}
