<?php

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

<a id="btn" style="display: none;" href="fmls_actualizarRegistros.php">Regresar</a>

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

  $queryUpdate = $mysql->query('UPDATE datoscasas SET dato26="'.$data['4'].'", dato27="'.$data['5'].'", dato28="'.$data['6'].'", dato24="'.$data['1'].'", dato6="'.$status.'", dato5="'.$data['3'].'", description="'.$data['7'].'", dato29="'.$data['8'].'", dato30="'.$data['9'].'", SquareFootage="'.$data['10'].'", SqFtSource="'.$data['11'].'", Style="'.$data['12'].'", TaxID="'.$data['13'].'" WHERE dato2="'.$data['0'].'";');

  if ($queryUpdate) {
    echo "OK (".$data['0'].")";
  }else{
    echo "ERROR DESCONOCIDO (".$data['0'].")";
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
