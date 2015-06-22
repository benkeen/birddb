<?php

require_once("../../env.php");

$PAGE = array(
    "title" => "Images",
    "nav" => Constants::PAGE_IMAGES,
    "js" => array(
    ),
    "css" => array(
    )
);

require_once("ImagesPage.class.php");

$currentPage = (isset($_GET["page"]) && is_numeric($_GET["page"])) ? $_GET["page"] : 1;

// render the page
require_once("../../resources/templates/header.php");

$perPage = 24;
$search = Images::searchImages("imageId", "ASC", $perPage, $currentPage);
?>

<div class="container">
    <div class="imageSearch">
        <ul>
            <?php
            foreach ($search["results"] as $image) {
                echo "<li><img src=\"{$ENV["relativeRoot"]}/uploads/{$image["filename"]}\" width=\"200\" /></li>";
            }
            ?>
        </ul>
    </div>

    <?php
    ImagesPage::generatePagination($currentPage, $perPage, $search["numResults"]);
    ?>

</div>

<?php
require_once("../../resources/templates/footer.php");
