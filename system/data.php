<?php
    function get_db_connection()
    {
        $db = mysqli_connect('localhost', '717416_3_1', 'T9VXwZxtsGS7', '717416_3_1')
         or die('Fehler beim Verbinden mit dem MySQL-Server.');
        mysqli_query($db, "utf8");
        return $db;
    }

    function get_result($sql)
    {
      $db = get_db_connection();
    //  echo $sql;
      $result = mysqli_query($db, $sql);
      mysqli_close($db);
      return $result;
    }



/*   **************************************************************** */
/*    index.php
/*   **************************************************************** */


function get_insert_result($sql)
{
  $db = get_db_connection();
  // echo $sql;
  $result = mysqli_query($db, $sql);
  $last_id = mysqli_query($db);
  mysqli_close();
  return $last_id;
}

/* *****************************************************************************
/* Login login.php
/* ************************************************************************** */

function login($email, $password)
  {
    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password';";
    return get_result($sql);
    echo $sql;
  }
    function register($nachname, $vorname, $geburtsdatum, $email)
{
    $sql = "INSERT INTO user (nachname, vorname, geburtsdatum, email) VALUES ('$nachname', '$vorname', '$geburtsdatum', '$email');";
  	return get_insert_result($sql);
}










 ?>
