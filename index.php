/**
 * Redirection vers la page index.php de controler.
 */
<?php
$url = 'Location: controler/index.php?pg='.md5('accueil'); header($url);