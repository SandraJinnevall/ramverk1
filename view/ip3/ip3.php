<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<?php if ($show) : ?>
<h1>Kontollera vädret</h1>
<form method="get">
        <label for="ipadress">Sök på en stad: </label>
        <input type="text" value="<?php if ($currentCity) : ?>
            <?= $currentCity ?>
                                  <?php endif; ?>" name="ipadress">
        <input type="submit" value="Sök">
</form>

<h1>Kontrollera vädret med JSON</h1>
<form action="./CheckjsonController3" method="get">
        <label for="ipjson">Sök på en stad: </label>
        <input type="text" value="<?php if ($currentCity) : ?>
            <?= $currentCity ?>
                                  <?php endif; ?>" name="ipjson" >
        <input type="submit" value="Sök">
</form>

<h1>Hur man jobbar med mitt JSON API</h1>
<p>Det som är nytt sen kursmoment 2 är att jag jobbar nu mot ett nytt API vilket är http://api.openweathermap.org/data/2.5/forecast?q={stad}&appid{apinyckel} vilket
  gör att jag hämtar vädret de kommande 5 dagarna i den stad som anges. Här visas dag och olika klockslag. Jag använder fortfarande det andra API:et från kmom02 vilket hämtar
  nuvarande position med hjälp av http://api.ipstack.com/{ipadress}?access_key={apinyckel} för att kunna ha som default-värde i post-formuläret var användaren befinner sig just nu.
Skillanden från kmom02 är att nu står staden istället för Ip-adressen ifyllt i formuläret.</p>

<?php endif; ?>
