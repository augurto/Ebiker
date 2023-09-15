
<?php
   define('DB_SERVER', "localhost");
   define('DB_USERNAME', "u291982824_ebiker");
   define('DB_PASSWORD', '21.17.Ebiker');
   define('DB_DATABASE', 'u291982824_ebiker');
   $con=mysqli_connect('localhost','u291982824_ebiker','21.17.Ebiker','u291982824_ebiker');

   // Verifica la conexión
   if (!$con) {
       die("Error de conexión: " . mysqli_connect_error());
   }

   // Establece la zona horaria a Perú
   $sql = "SET time_zone = 'America/Lima'";
   mysqli_query($con, $sql);

   mysqli_set_charset($con, "utf8");
?>
