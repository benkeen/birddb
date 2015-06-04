<?php

class Images {

    public static function getImageTags() {
        return Core::$db->query("SELECT * FROM imageTags ORDER BY tagId ASC");
    }

    public static function getImageTagCheckboxes() {
        $response = self::getImageTags();

        $lines = ["<ul>"];
        foreach ($response["results"] as $tagInfo) {
            $id = "tag-" . $tagInfo["tagId"];
            $lines[] = "<li><input type=\"checkbox\" name=\"imageTags[]\" id=\"$id\" value=\"{$tagInfo["tag"]}\" /> "
             . "<label for=\"$id\">{$tagInfo["tag"]}</label></li>";
        }
        $lines[] = "</ul>";

        echo implode("\n", $lines);
    }

    public static function insertNewImage($params) {
        $now = Utils::getCurrentDatetime();
        $params["status"] = "incomplete";
        $params["dateCreated"] = $now;
        $params["lastEdited"] = $now;
        $quotedCols = implode(",", array_keys($params));
        $quotedValues = implode(",", Utils::enquoteArray(array_values($params)));

        $query = "INSERT INTO images ($quotedCols) VALUES ($quotedValues)";
        $response = Core::$db->query($query);

        return ($response["success"]) ? mysqli_insert_id(Core::$db->getDBLink()) : null;
    }

    public static function getImage($imageId) {
        $response = Core::$db->query("SELECT * FROM images WHERE imageId = $imageId");
        if ($response["success"]) {
            $data = mysqli_fetch_assoc($response["results"]);
            return $data;
        } else {
            return null;
        }
    }

    public static function generateUniqueImageFilename() {
        $placeholderString = "HHHHHHHHHHHHHHHHHHH";
        $guid = Utils::generateRandomAlphanumericStr($placeholderString);

        // pretty sodding unlikely, but just in case!
        $maxChecks = 10;
        $checkNum = 1;
        while (!Images::checkImageFilenameUnique($guid)) {
            $guid = Utils::generateRandomAlphanumericStr($placeholderString);
            if ($checkNum > $maxChecks) {
                break;
            }
            $checkNum++;
        }
        return $guid;
    }

    public static function checkImageFilenameUnique($filename) {
        $response = Core::$db->query("SELECT count(*) as c FROM images WHERE filename LIKE '$filename.%'");
        if ($response["success"]) {
            $result = mysqli_fetch_assoc($response["results"]);
            return $result["c"] == 0;
        }
    }

    public static function deleteImage($imageId) {
        return Core::$db->query("DELETE FROM images WHERE imageId = $imageId");
    }
}

