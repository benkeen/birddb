<?php

require_once("../../env.php");

$PAGE = array(
    "title" => "Stats",
    "nav" => Constants::PAGE_STATS,
    "js" => array(
        "resources/js/bootstrap-typeahead.min.js",
        "resources/js/moment.js",
        "resources/js/utils.js",
        "pages/add-image/js/add-image.js"
    ),
    "css" => array(

    )
);

require_once("Stats.class.php");

// render the page
require_once("../../resources/templates/header.php");
?>

<div class="row">
    <div class="col-lg-2">Num birds</div>
    <div class="col-lg-10"><?=Stats::getNumImages();?></div>
</div>
<div class="row">
    <div class="col-lg-2">Num species</div>
    <div class="col-lg-10"><?=Stats::getNumSpecies();?></div>
</div>

<?php
require_once("../../resources/templates/footer.php");
