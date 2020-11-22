<?php
include_once('../config/Database.php');

class Tarea extends Database
{

  public $id;
  public $titulo;
  public $prioridad;
  public $fetcha;

  public function __construct($id = null, $titulo = null, $prioridad = null, $fetcha = null)
  {
    $this->id = $id;
    $this->titulo = $titulo;
    $this->prioridad = $prioridad;
    $this->fetcha = $fetcha;
  }

  public static function getTareas()
  {
    $tareas = array();

    try {
      $stmt = self::connect()->prepare('SELECT * FROM tareas');
      $stmt->execute();
      $tareas = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Tarea');
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    self::disconnect();
    return $tareas;
  }

  public static function getTarea($id)
  {
    $tarea = null;

    try {
      $stmt = self::connect()->prepare('SELECT * FROM tareas WHERE ID = :id');

      $stmt->execute(['id' => $id]);

      $tarea = $stmt->fetch(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Tarea');
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    self::disconnect();
    return $tarea;
  }

  public static function addTarea($titulo, $prioridad, $fetcha)
  {
    $fetcha = DateTime::createFromFormat('d/m/Y', $fetcha);
    $fetcha = $fetcha->format('Y-m-d');
    $query = 'INSERT INTO tareas (titulo, prioridad, fetcha) VALUES (:titulo, :prioridad, :fetcha);';

    try {
      $stmt = self::connect()->prepare($query);
      $stmt->bindParam(':titulo', $titulo);
      $stmt->bindParam(':prioridad', $prioridad);
      $stmt->bindParam(':fetcha', $fetcha);

      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    self::disconnect();
  }

  public static function deleteTarea($id)
  {
    try {
      $stmt = self::connect()->prepare('DELETE FROM tareas WHERE id = :id');
      $stmt->bindParam(':id', $id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    self::disconnect();
  }

  public static function clearTareas()
  {
    self::connect()->prepare('DELETE FROM tareas')->execute();
    self::disconnect();
  }

  public static function sortTareas($isDesc = false)
  {
    $tareas = array();
    try {
      if ($isDesc === true) {
        $stmt = self::connect()->prepare('SELECT * FROM tareas ORDER BY fetcha DESC');
      } else {
        $stmt = self::connect()->prepare('SELECT * FROM tareas ORDER BY fetcha');
      }
      $stmt->execute();
      $tareas = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Tarea');
    } catch (PDOException $e) {
      $e->getMessage();
    }

    self::disconnect();
    return $tareas;
  }

  public static function filterFetcha($fetcha)
  {
    $tareas = array();

    $fetcha = DateTime::createFromFormat('d/m/Y', $fetcha);
    $fetcha = $fetcha->format('Y-m-d');

    try {
      $stmt = self::connect()->prepare('SELECT * FROM tareas WHERE fetcha = :fetcha');
      $stmt->bindParam(':fetcha', $fetcha);
      $stmt->execute();

      $tareas = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Tarea');
    } catch (PDOException $e) {
      $e->getMessage();
    }

    self::disconnect();
    return $tareas;
  }
}
