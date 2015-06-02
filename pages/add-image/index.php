<?php
$PAGE = array(
    "title" => "Add Image",
    "js" => array(
        "resources/js/bootstrap-typeahead.min.js",
        "resources/js/utils.js",
        "pages/add-image/js/add-image.js"
    ),
    "step" => 1,
    "numSteps" => 4
);

require_once("../../env.php");

require_once("_index.php");
require_once("../../resources/templates/header.php");
require_once("progress.php");

require_once("step{$PAGE["step"]}.php");

require_once("../../resources/templates/footer.php");
