<!DOCTYPE html>
<html>
<head>
    <title>Buy Ticket</title>
</head>
<body>
    <!-- <h2>Buy a Concert Ticket</h2>
    <form action="generate_ticket.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Buy Ticket</button>
    </form> -->

    <form action="welcome.php" method="POST">
        Naam: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        Leeftijd: <input type="int" name="leeftijd" ><br>
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
    <input type="submit">
    <img src="https://api.qrserver.com/v1/create-qr-code/?data=HelloWorld&amp;size=100x100" alt="" title="" />
</form>
</body>
</html>
