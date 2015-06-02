<?php

/**
 * Utility functions for use throughout the script.
 * @author Ben Keen <ben.keen@gmail.com>
 * @package Utils
 */
class Utils {

	/**
	 * Recursively sanitizes data stored in any non-object data format, preparing it
	 * for safe use in SQL statements.
	 */
	public static function sanitize($input) {
		if (is_array($input)) {
			$output = array();
			foreach ($input as $k=>$i) {
				$output[$k] = Utils::sanitize($i);
			}
		} else {
			if (get_magic_quotes_gpc()) {
				$output = stripslashes($input);
			} else {
				$output = $input;
			}
		}

		return $output;
	}


	/**
	 * Converts a datetime to a timestamp.
	 * @param $datetime
	 * @return int
	 */
	public static function convertDatetimeToTimestamp($datetime) {
		list($date, $time) = explode(" ", $datetime);
		list($year, $month, $day) = explode("-", $date);
		list($hours, $minutes, $seconds) = explode(":", $time);
		return mktime($hours, $minutes, $seconds, $month, $day, $year);
	}

	/**
	 * @return string
	 */
	public static function getCurrentDatetime() {
		return date("Y-m-d H:i:s");
	}

	public static function isHash($var) {
		if (!is_array($var)) {
			return false;
		}
		return array_keys($var) !== range(0, sizeof($var) - 1);
	}

    /**
     * A method to recursively encode an array (associative or indexed).
     * @param array
     * @return array
     */
    public static function utf8_encode_array($array) {

        // if the parameter wasn't an array, explicitly return false
        if (!is_array($array)) {
            return false;
        }

        $resultArray = array();
        foreach ($array as $key => $value) {
            if (Utils::isHash($array)) {
                if (is_array($value)) {
                    $resultArray[utf8_encode($key)] = Utils::utf8_encode_array($value);
                } else {
                    if (is_string($value)) {
                        $resultArray[utf8_encode($key)] = utf8_encode($value);
                    } else {
                        $resultArray[utf8_encode($key)] = $value;
                    }
                }
            } else {
                if (is_array($value)) {
                    $resultArray[$key] = Utils::utf8_encode_array($value);
                } else {
                    if (is_string($value)) {
                        $resultArray[$key] = utf8_encode($value);
                    } else {
                        $resultArray[$key] = $value;
                    }
                }
            }
        }
        return $resultArray;
    }

}
