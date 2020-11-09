<?php
  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbname     = "kroger";

  $conn = mysqli_connect($servername, $username, $password);
  $dbcon = mysqli_select_db($conn,$dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if ( !$dbcon ) {
    die("Database Connection failed : " . mysql_error());
  }

  function db_get_var2($query) {
    global $conn;
    $result = $conn->query($query);
    return $result->num_rows;
  }

  function db_get_row($query) {
    global $conn;
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      return $row;
    } else {
      return false;
    }
  }

  function db_get_results($query) {
    global $conn;
    $data = array();

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $data[] = $row;
      }
      return $data;
    } else {
      return false;
    }
  }


  function db_get_var($query) {
    global $conn;
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_array($result);
      return $row[0];
    } else {
      return false;
    }
  }

  function db_insert($table, $data) {
    global $conn;
    $columns = array();
    $values = array();

    foreach ($data as $key => $value) {
      $columns[] =  $key;
      $values[] = $value;
    }

    $columns = implode(",",$columns);
    $values = implode("','",$values);

    $sql = "INSERT INTO $table ($columns) VALUES ('$values')";

    if ($conn->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function db_update($table, $data, $index) {
    global $conn;
    $columns = '';
    $indexer = '';

    foreach ($data as $key => $value) {
      $columns .= "$key = '$value', ";
    }
    $columns = rtrim($columns, ", ");

    foreach ($index as $key => $value) {
      $indexer .= "$key = '$value'";
    }

    $sql = "UPDATE $table SET $columns WHERE $indexer";

    if ($conn->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }
?>
