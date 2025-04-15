<!DOCTYPE html>
<html>
<head><title>Tickets Bestellen</title></head>
<link rel="stylesheet" href="tickets.css">
<body>
  
  <form action="bestel.php" method="POST">
  <h2>Bestel je tickets</h2>
    <label>Voornaam: <input type="text" name="name" value="naam" required></label><br>
    <label>Achternaam: <input type="text" name="name" value="achternaam" required></label><br>
    <label>Email: <input type="email" name="email" value="email@hotmail.com" required></label><br>
    <label>Leeftijd <input type="text" name="leeftijd" value="22" required></label><br>
    <label>Waar kom je vandaan? <input type="text" name="location" value="provincie" required></label><br>
    <label>Aantal tickets: <input type="number" name="tickets" min="1" value="1" required></label><br><br>
    <button type="submit">Bestel</button>
  </form>
</body>
</html>
