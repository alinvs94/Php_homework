<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<br>';
echo $_SERVER['REQUEST_METHOD'];
echo '<br>';

$arrayNemodificat = [
   ['nume' => 'Alin', 'varsta' => 28, 'genul' => 'masculin'],
   ['nume' => 'Maria', 'varsta' => 56, 'genul' => 'feminin'],
   ['nume' => 'Mihaela', 'varsta' => 40, 'genul' => 'feminin'],
   ['nume' => 'Claudiu', 'varsta' => 32, 'genul' => 'masculin'],
];

$array = $arrayNemodificat;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if (isset($_POST['nume']) && isset($_POST['varsta']) && isset($_POST['genul'])) {

      $exista = false;

      foreach ($array as $arr) {
         if (strtolower($arr['nume']) === strtolower($_POST['nume'])) {
            $exista = true;
         }
      }

      if (!$exista) {

         $barbatiInscrisci = array_filter($array, function ($arr) {
            if ($arr['genul'] === 'masculin') {
               return true;
            }
            return false;
         });

         if (count($barbatiInscrisci) >= 2 && $_POST['genul'] !== 'feminin') {
            echo 'Nu va puteti inscrie';
            echo '<br>';
         } else {

            if ($_POST['varsta'] < 16) {
               echo 'Prea mic';
               echo '<br>';
            } else {
               $partecipant = [
                  'nume' => $_POST['nume'],
                  'varsta' => $_POST['varsta'],
                  'genul' => $_POST['genul'],
               ];
               array_push($array, $partecipant);
            }
         }

      } else {
         echo 'User existent';
      }

   } else {
      echo 'Nu ati introdus datele corect';
      echo '<br>';
   }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

   if (!empty($_GET['nume'])) {

      $rezultate = array_filter($array, function ($arr) {
         if (strtolower($arr['nume']) === strtolower($_GET['nume'])) {
            return true;
         }
         return false;
      });
      // solution
      $array = $rezultate;
   } else {
      $array = $arrayNemodificat;
   }
}

?>

<html>

<a href='/contact.php'>Contact</a>
<h3>Formular inscriere</h3>

<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
   <label>Nume partecipant</label>
   <input type='text' placeholder="introduceti numele Partecipantului" name="nume" />
   <br />
   <label>Varsta</label>
   <input type='number' placeholder="varsta" name="varsta" />
   <br />
   <label>Genul:</label>
   <br />
   <label>Masculin:</label>
   <input type="radio" value="masculin" name="genul" />
   <label>Feminin:</label>
   <input type="radio" value="feminin" name="genul" />
   <br />
   <button>TRIMITE</button>
</form>

<form method="GET" action="<?php $_SERVER['PHP_SELF']; ?>">
   <label>Nume partecipant</label>
   <input type='text' placeholder=" Numele Partecipantului" name="nume" />
   <br />
   <input type="submit" value='cauta' />
</form>

<table>
   <tr>
      <th>Nume</th>
      <th>Varsta</th>
      <th>Genul</th>
   </tr>
   <?php foreach ($array as $ar): ?>
      <tr>
         <td> <?php echo $ar['nume'] ?> </td>
         <td> <?php echo $ar['varsta'] ?> </td>
         <td> <?php echo $ar['genul'] ?> </td>
      </tr>
   <?php endforeach; ?>
</table>

</html>