<?php

session_start();
if(!isset($_SESSION['id'])){
  header("Location:login.php");
}else{
  $admin_id = $_SESSION['id'];
}



require_once ('system/data.php');
require_once ('system/security.php');

$error = false;
$error_msg = "";
$success = false;
$success_msg = "";

if(isset($_POST['save'])){
  if (!empty($_POST['text'])) {
    $text = filter_data($_POST['text']);
    $a_id = filter_data($_POST['a_id']);

    $speichern = save_antworten($text, $a_id);
    $success = true;
    $success_msg .= "Erfolgreich gespeichert";


  }else {
    $error = true;
    $error_msg .= "Bitte fülle etwas aus.<br/>";
  }
}

$result = show_antworten();

 ?>

<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Backend - Antworten </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/backend.css" rel="stylesheet">


</head>

<body>

    <!--Navigation-->
    <div class="container content">
        <div class="row">
            <div class="col-md-offset-10 col-md-2 navigation">
                <a href="login.php" class="btn btn-default">Ausloggen</a>

            </div>
            <div class="col-md-12 navigation">
                    <ul class="nav nav-tabs ">
                        <li>
                            <a href="backend_resultate.php" role="button" aria-haspopup="true" aria-expanded="false">
                                Resultate <span class=""></span>
                            </a>
                        </li>
                        <li role="">
                            <a href="backend_fragen.php" role="button" aria-haspopup="true" aria-expanded="false">
                                Fragen <span class=""></span>
                            </a>
                        </li>
                        <li>
                            <a href="backend_antworten.php" role="button" aria-haspopup="true" aria-expanded="false">
                                Antworten<span class=""></span>
                            </a>
                        </li>
                    </ul>
            </div>
        </div>
    </div>

    <!--Tabelle-->
    <div class="container content">
        <div class="row">
            <div class="col-md-12 tabelle">

                <!--Titel-->
                <h2>Antworten</h2>

                <!--Tabelle-->
                <?php
                  if($error == true) {
                ?>
                    <div class="col-md-offset-3 col-md-6" >
                      <div style="margin-top:10%;" class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
                    </div>
                <?php
                  }
                ?>
                <?php
                  if($success == true) {
                ?>
                    <div class="col-md-offset-3 col-md-6" >
                      <div style="margin-top:10%;" class="alert alert-success" role="alert"><?php echo $success_msg; ?></div>
                    </div>
                <?php
                  }
                ?>
                <table class="table table-bordered ">
                <?php   while($antwort = mysqli_fetch_assoc($result)){?>
                          <!--Inputfelder-->
                      <!--Fragen-->
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <tr>
                          <th style="width:100px;" scope="row">Antwort <?php echo $antwort['a_id']?></th>
                          <td style="width:750px;"><p><?php echo $antwort['antwort']?></p></td>
                          <td style="width:750px;" class="breite">
                            <input type="hidden" name="a_id" value="<?php echo $antwort['a_id']?>">
                            <input type="text" name="text" placeholder="Text" class="texteingabe">
                          </td>
                          <td><input type="submit" name="save" class="" value="Speichern"></td>
                        </tr>
                      </form>
                  <?php } ?>
                  </table>

        </div>
    </div>
</div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
