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
            $lines[] = "<li><input type=\"checkbox\" id=\"$id\" /> <label for=\"$id\">{$tagInfo["tag"]}</label></li>";
        }
        $lines[] = "</ul>";

        echo implode("\n", $lines);
    }

    /**
     * Used during the Add Image process when a user starts by uploading an image. The image is uploaded to /uploads/tmp
     * and a record is created in the `images` table, marked as `incomplete`. Only once the user finishes adding the
     * image is it moves to /uploads. Orphaned images are removed.
     */
    public static function insertBlankImageRow() {
        $response = Core::$db->query("INSERT INTO images (status, speciesId) VALUES ('incomplete', NULL)");
        return ($response["success"]) ? mysqli_insert_id(Core::$db->getDBLink()) : null;
    }
}

