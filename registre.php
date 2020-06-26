
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
  </head>
  <body>
    <?php
    if (isset($_POST['user'])){
      $sql = "INSERT IGNORE INTO `users` (`login`, `password`,`endplan`,`plan`) VALUES (?,?,?,?);";
      require_once("config.php");
      $query= $pdosql->prepare($sql);
      $tempo = time() + (30 * 24 * 60 * 60); //1 mes
      $result = $query->execute(array(trim($_POST['user']),trim($_POST['pass']),$tempo,trim($_POST['versao'])));
      if ($result){
        echo  "Account created!</en>";
      }
      $_POST = array();
    }


     ?>
    <form class="" action="" method="post">
      <div class="form-group">
        <label for="user">Login: </label>
        <input type="text" name="user" value="">
      </div>
      <div class="form-group">
        <label for="pass">Password: </label>
        <input type="password" name="pass" value="">
      </div>
      <div class="form-group">
        <label for="versao">Version: </label>
        <select class="version" name="version">
          <option value="0">Option 1</option>
          <option value="1">Option 2</option>
          <option value="2">Option 3 Korea</option>
        </select>
      </div>
      <button type="submit" name="button">Create account</button>
    </form>
  </body>
</html>
