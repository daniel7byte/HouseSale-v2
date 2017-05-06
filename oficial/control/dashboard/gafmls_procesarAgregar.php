<?php

function num($price){
  return str_replace(',', '', str_replace('$', '', $price));
}

function zip($zip){
  $zipOk = explode('-', $zip);
  return $zipOk[0];
}

// Validar sesion

session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: ' . APP_URL . 'index.php');
  exit;
}elseif($_SESSION['rol'] != 'ADMIN'){
  header('Location: ' . APP_URL . 'index.php');
  exit;
}


// Conexion

require_once('../config/parameters.php');

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


// Subida del fichero

if(isset($_FILES['file']['name'])) {
  $file_name = time().'_'.$_FILES['file']['name'];
  $extension = strtolower(end(explode(".", $_FILES['file']['name'])));
  if($extension == "csv"){
    $route = "tmp/" . $file_name;
    move_uploaded_file($_FILES['file']['tmp_name'], $route);
  }else{
    echo "ERROR";
    exit;
  }
}else{
  echo "ERROR";
  exit;
}

?>

<a id="btn" style="display: none;" href="gafmls_agregarRegistros.php">Regresar</a>

<?php

// La Magia

$file = fopen($route, 'r');

$count = 0;
while ($data = fgetcsv($file, 1000, ",")) {
  if($count == 0){
    $count++;
    continue;
  }

  $status = ($data['2'] == 'Active' ? 'A' : $data['2']);

  $queryUpdate = $mysql->query('INSERT INTO datoscasas (id, dato1, dato2, dato3, dato4, dato5, dato6, dato7, dato8, dato9, dato10, dato11, dato12, dato13, dato14, dato15, dato16, dato17, dato18, dato19, dato20, dato21, dato22, dato23, dato24, dato25, dato26, dato27, dato28, dato29, dato30) 
VALUES ("0", "", "'.$data['0'].'", "", "", "'.num($data['1']).'", "'.$data['2'].'", "'.$data['3'].'", "", "'.$data['4'].'", "'.$data['5'].'", "'.$data['6'].'", "'.$data['7'].'", "'.$data['8'].'", "'.$data['9'].'", "'.$data['10'].'", "", "", "", "", "", "", "", "", "'.zip($data['11']).'", "", "'.$data['12'].'", "'.$data['13'].'", "'.$data['14'].'", "'.$data['15'].'", "'.$data['16'].'")');
  
  if ($queryUpdate) {
    echo "OK (".$data['0'].")";
  }else{
    echo "PUEDE QUE EL REGISTRO (".$data['0'].") YA EXISTA";
  }
  $count++;
  echo "<br>";
}

echo "Ready!";

fclose($file);

?>
<script>
  document.getElementById("btn").style.display="block";
</script>
<?php
// Eliminar fichero

unlink($route);
?>
