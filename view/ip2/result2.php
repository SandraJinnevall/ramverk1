<?php
namespace Anax\View;

?>
<a href="Ip2">TILLBAKA</a>
<h1>Resultat från valideringen</h1>

<?php if ($validerbar) : ?>
    <p><?= htmlentities($ipadress) ?> gick igenom valideringen och är en <?= htmlentities($ipv) ?></p>
    <p>Latitude: <?= htmlentities($latitude) ?></p>
    <p>Longitude: <?= htmlentities($longitude) ?></p>
    <?php if ($country) : ?>
      <p>Land: <?= htmlentities($country) ?></p>
    <?php else : ?>
      <p> Land: Undefined </p>
    <?php endif; ?>
    <?php if ($city) : ?>
      <p>Stad: <?= htmlentities($city) ?></p>
    <?php else : ?>
      <p> Stad: Undefined </p>
    <?php endif; ?>
<?php else : ?>
    <p><?= htmlentities($ipadress) ?> gick inte igenom valideringen</p>
<?php endif; ?>

<?php if ($domain) : ?>
  <p>Domännamn: <?= $domain ?></p>
<?php endif; ?>
