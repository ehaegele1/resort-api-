<?php

$dbconn = null;
if(getenv('DATABASE_URL')){
    $connectionConfig = parse_url(getenv('DATABASE_URL'));
    $host = $connectionConfig['host'];
    $user = $connectionConfig['user'];
    $password = $connectionConfig['pass'];
    $port = $connectionConfig['port'];
    $dbname = trim($connectionConfig['path'],'/');
    $dbconn = pg_connect(
        "host=".$host." ".
        "user=".$user." ".
        "password=".$password." ".
        "port=".$port." ".
        "dbname=".$dbname
    );
} else {
    $dbconn = pg_connect("host=localhost dbname=resorts");
}

class Resort {
  public $location;
  public $mountain;
  public $id;

  public function __construct($location, $mountain, $id){
    $this->location = $location;
    $this->mountain = $mountain;
    $this->id = $id;
  }
}

class Resorts {
  static function all(){
    $resorts = array();

    $results = pg_query("SELECT * FROM resorts");

    $row_object = pg_fetch_object($results);
    while($row_object){
      $new_resort = new Resort(
        $row_object->location,
        $row_object->mountain,
        intval($row_object->id)
      );
      $resorts[] = $new_resorts;
      $row_object = pg_fetch_object($results);
    }
    return $resorts;
  }

  static function create($resort){
    $query = "INSERT INTO jokes (setup, delivery) VALUES ($1, $2)";
    $query_params = array($resort->location, $resort->mountain);
    pg_query_params($query, $query_params);
    return self::all();
  }

  static function update($updated_resort){
      $query = "UPDATE resorts SET location = $1, photo = $2, WHERE id = $3";
      $query_params = array($updated_resort->location, $updated_resort->mountain, $updated_resort->id);
      $result = pg_query_params($query, $query_params);

      return self::all();
    }

    static function delete($id){
      $query = "DELETE FROM resort WHERE id = $1";
      $query_params = array($id);
      $result = pg_query_params($query, $query_params);

      return self::all();
    }
}
?>
