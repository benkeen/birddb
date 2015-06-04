<?php

class AddImage {

    private static $numPages = 4;
    private static $tmpUploadDir = null;
    private static $tmpUploadURL = null;

    public static function init() {
        global $ENV;

        self::$tmpUploadURL = $ENV["relativeRoot"] . "/uploads/tmp";
        self::$tmpUploadDir = realpath(__DIR__ . "/../../uploads/tmp");

        if (isset($_GET["step"]) && is_numeric($_GET["step"]) && $_GET["step"] >= 1 && $_GET["step"] <= self::$numPages) {
            self::setPage($_GET["step"]);

            // if they're explicitly linking to step 1, remove the uploaded image and clear out the image in the DB
            if ($_GET["step"] === 1) {
                self::deleteTmpImage();
                //Images::deleteImage();
            }
        }
    }

    public static function setPage($page) {
        $_SESSION["add-image-page"] = $page;
    }

    public static function getPage() {
        return isset($_SESSION["add-image-page"]) ? $_SESSION["add-image-page"] : 1;
    }

    public static function displayProgress() {
        echo "<ul class=\"pagination add-image-nav\">";

        $currentPage = self::getPage();
        for ($i=1; $i<=self::$numPages; $i++) {
            if ($currentPage == $i) {
                echo "<li class=\"active\"><a href=\"?page=$i\">$i</a></li>";
            } else if ($i < $currentPage) {
                echo "<li><a href=\"?step=$i\">$i</a></li>";
            } else {
                echo "<li class=\"disabled\"><a href=\"#\">$i</a></li>";
            }
        }
        echo '</ul>';
    }

    public static function processPage() {
        $currentPage = self::getPage();
        switch ($currentPage) {
            case "1":
                self::uploadFile();
                break;
            case "2":
                self::step2();
                break;
        }
    }

    private static function uploadFile() {
        if (!empty($_FILES)) {
            $oldFilename = $_FILES['image']['name'];
            $extension = Files::getFilenameExtension($oldFilename);
            $filename = Images::generateUniqueImageFilename();
            $newFilename = $filename . "." . $extension;

            $imageId = Images::insertNewImage(array("filename" => $newFilename));
            $_SESSION["imageId"] = $imageId;

            $newFilenameAndPath = self::$tmpUploadDir . "/" . $newFilename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $newFilenameAndPath)) {
                self::setPage(2);
            } else {
                // errors are handled by setting values on the page itself
                $PAGE["error"] = true;
                $PAGE["errorMessage"] = "There was a problem uploading the image. Hmm. This shouldn't have happened. Better contact Ben.";
            }
        }
    }

    public static function getImageURL($filename) {
        return self::$tmpUploadURL . "/" . $filename;
    }

    public static function getImagePath() {
        return self::$tmpUploadDir . "/" . $_SESSION["tmpImageFilename"];
    }

    public static function deleteTmpImage() {
        @unlink(self::getImagePath());
    }

    public static function step2() {
        self::setPage(3);

        $id = $_SESSION["imageId"];

        $post = Utils::sanitize($_POST);
        $numBirds  = $post["numBirds"];
        $speciesId = $post["speciesId"];
        $gender    = $post["gender"];
        $age       = $post["age"];

        $response = Core::$db->query("
            UPDATE images
            SET    numBirds = '$numBirds',
                   gender = '$gender',
                   speciesId = $speciesId,
                   age = '$age'
            WHERE  imageId = '$id'
        ");


        // now insert any tags
        //Core::$db->query("DELETE FROM imageTags WHERE");
    }
}
