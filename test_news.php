<?php

require('includes/application_top.php');
use
    OSC\News\Collection as NewsCol
;

    $col = new NewsCol();
    $col->sortByDate('DESC');
    $col->filterByStatus(1);
    $col->populate();

    foreach ($col->getElements() as $article) {
        $article->load();var_dump($article);
        var_dump($article->getImage());
    }
