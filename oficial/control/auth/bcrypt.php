<?php
$options = [
  'cost' => 12,
];

$hash = password_hash('secret', PASSWORD_BCRYPT, $options);

echo $hash;

if (password_verify('12345', $hash)) {
    echo '<br>¡La contraseña es válida!';
} else {
    echo '<br>La contraseña no es válida.';
}
