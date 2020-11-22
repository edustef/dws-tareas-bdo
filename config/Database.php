<?php

class Database
{
  private static $host = 'localhost';
  private static $username = 'admin';
  private static $db_name = 'tareas';
  private static $password = '290312';
  private static $conn = null;

  protected static function connect()
  {
    self::$conn = null;

    try {
      self::$conn = new PDO(
        'mysql:host=' . self::$host . ';dbname=' . self::$db_name,
        self::$username,
        self::$password
      );

      self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'Connection error: ' . $e->getMessage();
    }

    return self::$conn;
  }

  protected static function disconnect()
  {
    self::$conn = null;
  }
}
