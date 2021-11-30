<?php
/**
 * Redirection vers la page index.php de controler.
 */
$url = 'Location: controler/index.php?pg='.md5('accueil'); header($url);
