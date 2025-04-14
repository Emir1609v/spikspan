<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Form</title>
</head>
<body>
    <h2>Fill in your details</h2>
    <form action="generate.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="John Doe" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="emir1609v@gmail.com"  required><br>

        <label for="age">Age:</label>
        <input type="number" name="age" value="31" required><br>

        <label for="city">City:</label>
        <input type="text" name="city"  value="Ohio" required><br>

        <button type="submit">Generate QR Code</button>
    </form>
</body>
</html>

















<!-- <!DOCTYPE html>
<html>
<head>
    <title>Buy Ticket</title>
</head>
<body>
 

    <form  class="form" method="POST" action="generate.php" >
        Naam: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        Leeftijd: <input type="number" name="leeftijd"  max="150"><br>
        <label for="Provincie">Kies je provincie:</label>
        <select id="provincie" name="waarvan">
             <option value="Drenthe">Drenthe</option>
             <option value="Flevoland">Flevoland</option>
             <option value="Friesland">Friesland</option>
             <option value="Gelderland">Gelderland</option>
             <option value="Groningen">Groningen</option>
             <option value="Limburg">Limburg</option>
             <option value="Noord-Brabant">Noord-Brabant</option>
             <option value="Noord-Holland">Noord-Holland</option>
             <option value="Overijssel">Overijssel</option>
             <option value="Utrecht">Utrecht</option>
             <option value="Zeeland">Zeeland</option>
             <option value="Zuid-Holland">Zuid-Holland</option>
    </select>  
    <input type="submit" value="Koop Ticket">
</form>
</body>
</html> -->
