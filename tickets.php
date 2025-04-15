<!DOCTYPE html>
<html>
<head><title>Tickets Bestellen</title></head>
<link rel="stylesheet" href="tickets.css">
<body>
  <h2>Bestel je tickets</h2>
  <form action="bestel.php" method="POST">
    <label>Voornaam: <input type="text" name="name" required></label><br>
    <label>Achternaam: <input type="text" name="name" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Leeftijd <input type="text" name="leeftijd" required></label><br>
    <label>Waar kom je vandaan? <input type="text" name="location" required></label><br>
    <label>Aantal tickets: <input type="number" name="tickets" min="1" value="1" required></label><br><br>
    <button type="submit">Bestel</button>
  </form>
</body>
</html>
