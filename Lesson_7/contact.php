<!-- 1.solutie pentru problema cu cautarea daca am cautat dupa nume si ulterior mai apas odata pe search fara nici o valoare in input, trebuie sa apara rezultatele ( *nu este vorba despre copii si referinte avand in vedere ca se da refresh la pagina )
2. Creati un formular in contact.php care sa contina urmtoarele:
- Nume
- Email
- Numar de telefon
a. Formularul trebuie sa fac un POST request catre fisierul propriu( contact html ) -> va rog folositi variabila superglobala sa accesati fisierul.
b. informatiile din formular trebuie afisate sub formular in forma unei liste neordonate ( <ul> </ul> ) -> doar daca exista informatii in $_POST
c. Datele introduse de utilizator trebuie verificate, utilizatorul trebuie sa introduca informatii in fiecare camp pentru a putea inregistra cu succes cererea
d. ( bonus ) In fiecare camp introdus de utilizator trebuie sa fie prezente minim 3 caractere, altfel este considerat campul invalid, in mesajul de eroare specificati care dintre campuri este invalid. -->

<?php

$array = [];
$nume = '2';
$email;
$numar;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if (!empty($_POST['nume']) && !empty($_POST['email']) && !empty($_POST['numar'])) {

      if ((strlen($_POST['nume']) > 2)) {
         $nume = '';
      } else {
         $nume = 'Nume prea scurt <br>';
      }
      ;

      if ((strlen($_POST['email']) > 3)) {
         $email = '';
      } else {
         $email = 'Email prea scurt<br>';
      }
      ;

      if ((strlen($_POST['numar']) > 2)) {
         $numar = '';
      } else {
         $numar = 'Numar prea scurt<br>';
      }
      ;


      if (empty($nume) && empty($email) && empty($numar)) {

         $utilizator = [
            'nume' => $_POST['nume'],
            'email' => $_POST['email'],
            'numar' => $_POST['numar']
         ];
         // array_push($array, [$_POST['nume'], $_POST['email'], $_POST['numar']] );
         array_push($array, $utilizator);
      } else {

         echo $nume ? $nume: null;
         echo $email ? $email : null;
         echo $numar ? $numar : null;

      }


   } else {
      echo 'Completati toate campurile';
      echo '<br>';
   }
}
;



?>

<html>

<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
   <label>Nume</label>
   <input type="text" name="nume">
   <label>Email</label>
   <input type="email" name="email">
   <label>Telephone</label>
   <input type="number" name="numar">
   <button>Send</button>
</form>

<ul>
   <?php foreach ($array as $arr): ?>
      <li>
         <?php echo 'Nume: ' . $arr['nume'] . '<br>Email: ' . $arr['email'] . '<br>Numar: ' . $arr['numar']; ?>
      </li>
   <?php endforeach; ?>

</ul>

<a href="/index.php">Index</a>

</html>