<?php

class Images {
    //
    public static function getImageTagList() {
        return Core::$db->query("SELECT * FROM imageTagList ORDER BY tagId ASC");
    }

    public static function getImageTagCheckboxes($selectedTagIds = array()) {
        $response = self::getImageTagList();

        $lines = ["<ul>"];
        foreach ($response["results"] as $tagInfo) {
            $id = "tag-" . $tagInfo["tagId"];
            $checked = (in_array($tagInfo["tagId"], $selectedTagIds)) ? "checked=\"checked\"" : "";
            $lines[] = "<li><input type=\"checkbox\" name=\"imageTags[]\" id=\"$id\" value=\"{$tagInfo["tagId"]}\" $checked /> "
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

        $response = Core::$db->query("INSERT INTO images ($quotedCols) VALUES ($quotedValues)");

        return ($response["success"]) ? mysqli_insert_id(Core::$db->getDBLink()) : null;
    }

    public static function getImage($imageId) {
        $response = Core::$db->query("SELECT * FROM images WHERE imageId = $imageId");
        if ($response["success"]) {
            $data = mysqli_fetch_assoc($response["results"]);
            $data["imageTags"] = self::getImageTags($imageId);
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

    public static function deleteImageTags($imageId) {
        return Core::$db->query("DELETE FROM imageTags WHERE imageId = $imageId");
    }

    public static function setImageTags($imageId, $tags) {
        self::deleteImageTags($imageId);
        foreach ($tags as $tagId) {
            Core::$db->query("INSERT INTO imageTags VALUES ($imageId, $tagId)");
        }
    }

    public static function getImageTags($imageId) {
        $response = Core::$db->query("SELECT * FROM imageTags WHERE imageId = $imageId");
        $tags = array();
        foreach ($response["results"] as $tagInfo) {
            $tags[] = $tagInfo["tagId"];
        }
        return $tags;
    }

    public static function searchImages($orderField = "imageId", $order = "ASC", $pageSize = 24, $page = 1) {
        $offset = ($page - 1) * $pageSize;
        $countQuery = Core::$db->query("
            SELECT count(*) as c
            FROM images
            WHERE status = 'live'
        ");
        $countResult = mysqli_fetch_assoc($countQuery["results"]);

        $searchQuery = Core::$db->query("
            SELECT *
            FROM images
            WHERE status = 'live'
            ORDER BY $orderField $order
            LIMIT $pageSize
            OFFSET $offset
        ");

        $result = array(
            "numResults" => $countResult["c"],
            "results" => $searchQuery["results"]
        );

        return $result;
    }
}
