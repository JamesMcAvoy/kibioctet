#!/usr/bin/env php
<?php

//Delete recursively a folder
function delTree($dir) {
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

//Build
exec('bundle exec jekyll b');

$languages = array('fr', 'en');
$path = '_site/';

//Files to delete
$delete = array(
    'assets/js/agency.js',
    'assets/js/contact_me.min.js',
    'assets/js/jqBootstrapValidation.js',
    'assets/js/jqBootstrapValidation.min.js',
    'assets/vendor/',
    'assets/img/logos/creative-market.jpg',
    'assets/img/logos/designmodo.jpg',
    'assets/img/logos/envato.jpg',
    'assets/img/logos/themeforest.jpg'
);

//Delete the files needed
foreach($languages as $language) {
    if($language == 'fr') $lang = '';
    else $lang = $language . '/';

    foreach($delete as $link) {
        $l = $path . $lang . $link;
        echo "deleting $l\n\r";
        //If dir -> delTree
        if(substr($l, -1) == '/') delTree($l);
        else unlink($l);
    }
}
