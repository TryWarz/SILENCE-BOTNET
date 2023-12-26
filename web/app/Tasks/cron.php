<?php

require_once dirname(__DIR__) . '/init.php';

$attacks = Attack::getAll();

foreach ($attacks as $attack) {
    $isExpired = (strtotime($attack['end']) - time()) <= 0 ? true : false;

    if ($isExpired) {
        Attack::remove($attack['id']);
    }

}