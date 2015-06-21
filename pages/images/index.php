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


// render the page
require_once("../../resources/templates/header.php");

$images = Images::searchImages();
?>

<div class="container">
    <div class="imageSearch">
        <ul>
            <?php
            foreach ($images as $image) {
                echo "<li><img src=\"{$ENV["relativeRoot"]}/uploads/{$image["filename"]}\" width=\"200\" /></li>";
            }
            ?>
        </ul>
    </div>
</div>

<?php
require_once("../../resources/templates/footer.php");
