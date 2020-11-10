<?php
namespace Anax\View;

?>
<a href="Ip">TILLBAKA</a>
<h1>Resultat från valideringen</h1>

<?php if ($validerbar) : ?>
    <p><?= htmlentities($ipadress) ?> gick igenom valideringen och är en <?= htmlentities($ipv) ?></p>
<?php else : ?>
    <p><?= htmlentities($ipadress) ?> gick inte igenom valideringen</p>
<?php endif; ?>

<?php if ($domain) : ?>
  <p>Domännamn: <?= $domain ?></p>
<?php endif; ?>
