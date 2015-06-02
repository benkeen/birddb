<?php

/**
 * @author Ben Keen <ben.keen@gmail.com>
 * @package Species
 */
class Species {

    /**
     * Used for the realtime typeahead species name search
     * @param $string
     * @return array
     */
	public static function search($string) {
        $maxResults = 10;

        $string = mysqli_real_escape_string(Core::$db->getDBLink(), $string);

        $response = Core::$db->query("
              SELECT id, sciName, commonName
              FROM species
              WHERE category = 'species' AND
                    commonName LIKE '%$string%' OR
                    sciName LIKE '%$string%'
              LIMIT $maxResults
        ");

        if ($response["success"]) {
            $data = array();
            while ($row = mysqli_fetch_assoc($response["results"])) {
                $data[] = $row;
            }
            return array(
                "success" => true,
                "content" => $data
            );
        } else {
            return array(
                "success" => false,
                "error" => $response["errorMsg"]
            );
        }
	}

}
