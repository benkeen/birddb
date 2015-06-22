<?php

class Stats {

    public static function getNumImages() {
        $response = Core::$db->query("SELECT count(*) as c FROM images");
        $data = mysqli_fetch_assoc($response["results"]);
        return $data["c"];
    }

    public static function getNumSpecies() {
        $response = Core::$db->query("SELECT count(*) as c FROM images GROUP BY speciesId");
        $numSpecies = mysqli_num_rows($response["results"]);
        return $numSpecies;
    }
}
