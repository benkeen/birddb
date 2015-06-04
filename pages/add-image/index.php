<?php

$PAGE = array(
    "title" => "Add Image",
    "js" => array(
        "resources/js/bootstrap-typeahead.min.js",
        "resources/js/utils.js",
        "pages/add-image/js/add-image.js"
    )
);

require_once("../../env.php");
require_once("AddImage.class.php");
AddImage::init();

if (isset($_POST["submit"]) && $_POST["submit"]) {
    AddImage::processPage();
}


// render the page
require_once("../../resources/templates/header.php");

AddImage::displayProgress();

$imageInfo = Images::getImage($_SESSION["imageId"]);
$page = AddImage::getPage();
require_once("step{$page}.php");

require_once("../../resources/templates/footer.php");
