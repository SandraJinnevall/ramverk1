<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<?php if ($show) : ?>
<h1>Kontollera IP</h1>
<form method="get">
        <label for="ipadress">Se om det är en giltig ipadress(ip4)(ip6): </label>
        <input type="text" name="ipadress">
        <input type="submit" value="Validera">
</form>

<h1>Kontrollera IP JSON</h1>
<form action="./Ipjsoncontroller" method="get">
        <label for="ipjson">Validera och visa ip adress i JSON-format: </label>
        <input type="text" name="ipjson" >
        <input type="submit" value="Validera">
</form>

<h1>Testa routes vanligt</h1>
<form method="get">
        <label for="ipadress">IP adress (ip4) som validerar: </label>
        <input type="text" name="ipadress" value="66.249.72.26" readonly>
        <input type="submit" value="Validera">
</form>

<form method="get">
        <label for="ipadress">IP adress (ip6) som validerar: </label>
        <input type="text" name="ipadress" value="2001:470:ed3d:1000::2:1" readonly>
        <input type="submit" value="Validera">
</form>

<form method="get">
        <label for="ipadress">IP adress som inte validerar: </label>
        <input type="text" name="ipadress" value="19.168.03.10" readonly>
        <input type="submit" value="Validera">
</form>

<h1>Testa routes JSON</h1>
<form action="./Ipjsoncontroller" method="get">
        <label for="ipjson">IP adress (ip4) som validerar: </label>
        <input type="text" name="ipjson" value="66.249.72.26" readonly>
        <input type="submit" value="Validera">
</form>

<form action="./Ipjsoncontroller" method="get">
        <label for="ipjson">IP adress (ip6) som validerar: </label>
        <input type="text" name="ipjson" value="2001:470:ed3d:1000::2:1" readonly>
        <input type="submit" value="Validera">
</form>

<form action="./Ipjsoncontroller" method="get">
        <label for="ipjson">IP adress som inte validerar: </label>
        <input type="text" name="ipjson" value="19.168.03.10" readonly>
        <input type="submit" value="Validera">
</form>

<h1>Hur man jobbar med mitt JSON API</h1>

<p>Jag återanvänvde min funcktion.php från oophp-kursen där jag har en getGet funktion som tar emot en GET request.
  Ovan är det ett formulär som skickar ip-adressen tillsammans med get. Hämtar upp värdet i min CheckjsonController-klass med funktionen getGet
  skickar in variablen i mina tre olika funktioner tillsammans i en array. De tre funktionerna kollar om det är en validerbar ipadress, vilken
  ipv och om den har en domän. Returnerar tillslut hela array:en vilket blir ett JSON-resultat.</p>

<?php endif; ?>
