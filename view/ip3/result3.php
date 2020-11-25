<?php
namespace Anax\View;

?>
<a href="Ip3">TILLBAKA</a>
<h1><?= htmlentities($ipadress) ?></h1>

<?php if ($validerbar) : ?>
    <h4>Väderrapport kommande 5 dagar</h4>
    <?php if ($weatherForecast) :
         echo "<table class='table'>
        <tr>
        <th>Dag & Tid</th>
        <th>Väderslag</th>
        <th>Temp</th>
        <th>Väderbild</th>
        </tr>";

        ?>

        <?php foreach ($weatherForecast["list"] as $key => $row) :
            ?>
            <?php
            echo "<tr>";
            echo "<td>" . trim(json_encode($row["dt_txt"]), '"') . "</td>";
            echo "<td>" . trim(json_encode($row["weather"][0]["main"]), '"') . "</td>";
            echo "<td>" . round(json_encode($row["main"]["temp"]-273.15), 1). " C°" . "</td>";
            echo "<td><img src=\"http://openweathermap.org/img/wn/" . trim(json_encode($row["weather"][0]["icon"]), '"') . "@2x.png\"></td>";
        endforeach;
        echo "</tr>";
        echo "</table>";
        ?>
        <h4>Väderrapport för de dagar som har varit (Olika många dagar beroende på stad)</h4>
        <?php if ($weatherHistory) :
            echo "<table class='table'>
            <tr>
            <th>För hur många dagar sen</th>
            <th>Väderslag</th>
            <th>Temp</th>
            <th>Väderbild</th>
            </tr>";

            ?>

            <?php foreach ($weatherHistory["list"] as $key => $row) :
                ?>
                <?php
                echo "<tr>";
                echo "<td>" .json_encode($key + 1). "</td>";
                echo "<td>" . trim(json_encode($row["weather"][0]["main"]), '"') . "</td>";
                echo "<td>" . round(json_encode($row["main"]["temp"]-273.15), 1). " C°" . "</td>";
                echo "<td><img src=\"http://openweathermap.org/img/wn/" . trim(json_encode($row["weather"][0]["icon"]), '"') . "@2x.png\"></td>";
            endforeach;
            echo "</tr>";
            echo "</table>";
            ?>
        <h1>Karta</h1>
            <?php
            $city = trim(json_encode($weatherForecast["city"]["name"]), '"');
            $country = trim(json_encode($weatherForecast["city"]["country"]), '"');
            $long = trim(json_encode($weatherForecast["city"]["coord"]["lon"]), '"');
            $lat = trim(json_encode($weatherForecast["city"]["coord"]["lat"]), '"');
            ?>
           <p>Stad: <?= $city ?></p>
           <p>Land: <?= $country ?></p>
           <p>Longitude: <?= $long ?></p>
           <p>Latitude: <?= $lat ?></p>
           <p style="display: none;" id="longitude"><?= $long ?></p>
           <p style="display: none;" id="latitude"><?= $lat ?></p>
           <div style="height: 500px;" id="map"></div>
           <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css">
           <script src='https://unpkg.com/leaflet@1.3.3/dist/leaflet.js'></script>
           <script type="text/javascript">
             var longitude = document.getElementById('longitude').innerText;
             var latitude = document.getElementById('latitude').innerText;
             var map = L.map('map').setView([latitude, longitude], 11);

             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                 attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
             }).addTo(map);

             L.marker([latitude, longitude]).addTo(map)
             .openPopup();
           </script>
        <?php endif; ?>
    <?php endif; ?>
<?php else : ?>
    <p>Staden <?= htmlentities($ipadress) ?> hittades inte, var vänligen och försök igen. <a href="Ip3">TILLBAKA</a></p>
<?php endif; ?>
