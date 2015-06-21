<?php

class AddImage {

    private static $numPages = 5;
    private static $imagesDir = null;
    private static $imagesURL = null;
    private static $tmpUploadDir = null;
    private static $tmpUploadURL = null;

    public static function init() {
        global $ENV;

        self::$tmpUploadURL = $ENV["relativeRoot"] . "/uploads/tmp";
        self::$tmpUploadDir = realpath(__DIR__ . "/../../uploads/tmp");
        self::$imagesURL = $ENV["relativeRoot"] . "/uploads";
        self::$imagesDir = realpath(__DIR__ . "/../../uploads");

        if (isset($_GET["step"]) && is_numeric($_GET["step"]) && $_GET["step"] >= 1 && $_GET["step"] <= self::$numPages) {
            self::setPage($_GET["step"]);

            // if they're explicitly linking to step 1, remove the uploaded image and clear out the image in the DB
            if ($_GET["step"] == 1) {
                self::deleteTmpImage();
                self::clearAddImageSession();
            }
        }
    }

    private static function clearAddImageSession() {
        $_SESSION["imageId"] = "";
        $_SESSION["speciesName"] = "";
        $_SESSION["add-image-page"] = 1;
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
            case "3":
                self::step3();
                break;
            case "4":
                self::step4();
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
        $imageTags = isset($post["imageTags"]) ? $post["imageTags"] : array();

        Core::$db->query("
            UPDATE images
            SET    numBirds = '$numBirds',
                   gender = '$gender',
                   speciesId = $speciesId,
                   age = '$age'
            WHERE  imageId = $id
        ");

        // update whatever list of tags
        Images::setImageTags($id, $imageTags);

        // store the species name in sessions for convenience
        $_SESSION["speciesName"] = $post["speciesName"];
    }

    public static function step3() {
        self::setPage(4);

        $id = $_SESSION["imageId"];

        $post = Utils::sanitize($_POST);
        $activity     = $post["activity"];
        $proximity    = $post["proximity"];
        $idDifficulty = $post["idDifficulty"];

        Core::$db->query("
            UPDATE images
            SET    activity = '$activity',
                   proximity = '$proximity',
                   idDifficulty = '$idDifficulty'
            WHERE  imageId = $id
        ");
    }

    public static function step4() {
        self::setPage(5);

        $id = $_SESSION["imageId"];
        $post = Utils::sanitize($_POST);
        $lat = $post["lat"];
        $lng = $post["lng"];

        Core::$db->query("
            UPDATE images
            SET    status = 'live',
                   lat = '$lat',
                   lng = '$lng'
            WHERE  imageId = $id
        ");

        $imageInfo = Images::getImage($_SESSION["imageId"]);

        // move the file. She's good to go!
        $oldPath = self::$tmpUploadDir . "/" . $imageInfo["filename"];
        $newPath = self::$imagesDir . "/" . $imageInfo["filename"];
        rename($oldPath, $newPath);
    }

}
