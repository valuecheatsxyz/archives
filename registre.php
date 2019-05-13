
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registre</title>
  </head>
  <body>
    <?php
    if (isset($_POST['user'])){
      $sql = "INSERT IGNORE INTO `users` (`login`, `senha`,`vipfim`,`plano`) VALUES (?,?,?,?);";
      require_once("config.php");
      $query= $pdosql->prepare($sql);
      $tempo = time() + (30 * 24 * 60 * 60); //1 mes
      $result = $query->execute(array(trim($_POST['user']),trim($_POST['pass']),$tempo,trim($_POST['versao'])));
      if ($result){
        echo  "Conta criada com sucesso!</br>";
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
        <label for="pass">Senha: </label>
        <input type="password" name="pass" value="">
      </div>
      <div class="form-group">
        <label for="versao">Versão: </label>
        <select class="versao" name="versao">
          <option value="0">PB BR</option>
          <option value="1">PB Cazaquistão</option>
          <option value="2">Combat Arms Korea</option>
        </select>
      </div>
      <button type="submit" name="button">Criar conta VIP</button>
    </form>
  </body>
</html>
