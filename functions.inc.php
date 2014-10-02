<?php

// alapertelmezett argumentum megadasa: ures tomb
function dd($info = array()) {
  echo '<pre>';
  var_dump($info); # tomb kiirasa
  echo '</pre>';
}

/* adatbazis fuggvenyek */
function database_connect() {
  // probaljunk meg csatlakozni az adatbazishoz
  $conn = mysqli_connect('localhost', 'user', 'password', 'j6sppe');
  if (mysqli_connect_errno()) { # ha hibat talal, akkor alljon le es irja ki hibat
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
  }
  return $conn; # visszateresi ertek megadasa: a kapcsolat maga
}

function database_query($sql = '', $con) { # argumentumok megadasa
  $result = array(); # az eredemeny alaperteke egy ures tomb
  $query = mysqli_query($con, $sql); # sql keres megadasa az argumentum segitsegevel
  while ($row = mysqli_fetch_assoc($query)) { # amig van kiolvashato sor, addig bovitsuk a eredmeny tombot
    $result[] = $row;
  }
  mysqli_free_result($query); # szabaditsunk fol egy keves memoriat
  return $result; # adjuk vissza a foltoltott tombot
}

function database_close($connection) { # nem vizsgaljuk letzik-e a kapcsolat!
  mysqli_close($connection); # zarjuk le az argumentumban levo kapcsolatot
}
# alapertemezett azonosito megadasa
function get_user_role($id = 0) { # felhasznalo csoportjanak kideritese azonosito alapjan
  $con = database_connect(); # kacsolodjunk az adatbazishoz
  $id = (int) $id; # eroltessuk a szam tipusu azonositot
  /* sql lekeres megadasa tobb sorban, valtozot kapcsos zarojelek koze zarjuk */
  $sql = <<<SQL
  SELECT
    u.name,
    r.title
  FROM users u
    LEFT JOIN user_roles ur
      ON u.id = ur.user_id
    LEFT JOIN roles r
      ON r.id = ur.role_id
  WHERE
    u.id = {$id}
SQL;

  $role = database_query($sql, $con); # inditjuk az olvasast

  database_close($con);
  # visszateres a felhasznalo csoportjanak nevevel vagy uzenettel, ha nincs ilyen azonositoju felhasznalo
  return (!empty($role)) ? $role[0]['name'] : 'Nincs ilyen felhasznalo!';
} # get_user_role fuggveny vege

function get_all_exams() {
  $exams = array(); # alapertelmezett ertek megadasa arra az esetre, ha nem lenne meg gyakorlofeladat
  $con = database_connect(); # kacsolodjunk az adatbazishoz
  $sql = <<<SQL
  SELECT
    e.title,
    q.title,
    a.value
  FROM exams e
  LEFT JOIN questions q
    ON e.id = q.exam_id
  LEFT JOIN answers a
    ON a.exam_id = e.id
SQL;

  $exams = database_query($sql, $con); # inditjuk az olvasast

  database_close($con);
  return $exams; # gyakorlo feladatok listaja vagy ures tomb
} # get_all_exams fuggveny vege

function get_right_answers() {

} # get_right_answers fuggveny vege

/* adatbazis fuggvenyek vege */

