<?php

require_once("../../env.php");

$PAGE = array(
    "title" => "Add Image",
    "nav" => Constants::PAGE_ADD_IMAGE,
    "js" => array(
        "resources/js/bootstrap-typeahead.min.js",
        "resources/js/moment.js",
        "resources/js/utils.js",
        "pages/add-image/js/add-image.js"
        // "resources/js/bootstrap-datetimepicker.js"
    ),
    "css" => array(
        //"resources/css/bootstrap-datepicker.min.css"
    )
);

require_once("AddImage.class.php");
AddImage::init();

if (isset($_POST["submit"]) && $_POST["submit"]) {
    AddImage::processPage();
}

$page = AddImage::getPage();
$imageInfo = (isset($_SESSION["imageId"])) ? Images::getImage($_SESSION["imageId"]) : array();

if ($page === 5) {
    $PAGE["title"] = "Complete";
}

// render the page
require_once("../../resources/templates/header.php");

if ($page < 5) {
    AddImage::displayProgress();
} else {
    $PAGE["title"] = "Complete";
}

require_once("step{$page}.php");

require_once("../../resources/templates/footer.php");
