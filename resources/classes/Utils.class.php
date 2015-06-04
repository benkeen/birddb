<?php

/**
 * Utility functions for use throughout the script.
 * @author Ben Keen <ben.keen@gmail.com>
 * @package Utils
 */
class Utils {

    // the Utils class memoizes a bunch of stuff to improve speed
    static $charLengthMemoized = false;
    static $letters     = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    static $consonants  = "BCDFGHJKLMNPQRSTVWXYZ";
    static $vowels      = "AEIOU";
    static $hex         = "0123456789ABCDEF";
    static $lettersLen;
    static $consonantsLen;
    static $vowelsLen;
    static $hexLen;

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
     * Converts the following characters in the parameter string and returns it:
     *
     *     C, c, A - any consonant (Upper case, lower case, any)
     *     V, v, B - any vowel (Upper case, lower case, any)
     *     L, l, D - any letter (Upper case, lower case, any)
     *     X       - 1-9
     *     x       - 0-9
     *     H       - 0-F
     *
     * @param string
     * @return string
     */
    static public function generateRandomAlphanumericStr($str) {

        // simple memoization to GREATLY increase speed for this heavily-relied on function
        if (!self::$charLengthMemoized) {
            self::$lettersLen    = strlen(self::$letters);
            self::$consonantsLen = strlen(self::$consonants);
            self::$vowelsLen     = strlen(self::$vowels);
            self::$hexLen        = strlen(self::$hex);
            self::$charLengthMemoized = true;
        }

        // loop through each character and convert all unescaped X's to 1-9 and
        // unescaped x's to 0-9.
        $new_str = "";
        $strlen = strlen($str);
        for ($i=0; $i<$strlen; $i++) {
            switch ($str[$i]) {
                // Numbers
                case "X": $new_str .= mt_rand(1, 9);  break;
                case "x": $new_str .= mt_rand(0, 9);  break;

                // Letters
                case "L": $new_str .= self::$letters[mt_rand(0, self::$lettersLen-1)]; break;
                case "l": $new_str .= strtolower(self::$letters[mt_rand(0, self::$lettersLen-1)]); break;
                case "D":
                    $bool = mt_rand()&1;
                    if ($bool) {
                        $new_str .= self::$letters[mt_rand(0, self::$lettersLen-1)];
                    } else {
                        $new_str .= strtolower(self::$letters[mt_rand(0, self::$lettersLen-1)]);
                    }
                    break;

                // Consonants
                case "C": $new_str .= self::$consonants[mt_rand(0, self::$consonantsLen-1)];      break;
                case "c": $new_str .= strtolower(self::$consonants[mt_rand(0, self::$consonantsLen-1)]);  break;
                case "E":
                    $bool = mt_rand()&1;
                    if ($bool) {
                        $new_str .= self::$consonants[mt_rand(0, self::$consonantsLen-1)];
                    } else {
                        $new_str .= strtolower(self::$consonants[mt_rand(0, self::$consonantsLen-1)]);
                    }
                    break;

                // Vowels
                case "V": $new_str .= self::$vowels[mt_rand(0, self::$vowelsLen-1)];  break;
                case "v": $new_str .= strtolower(self::$vowels[mt_rand(0, self::$vowelsLen-1)]);  break;
                case "F":
                    $bool = mt_rand()&1;
                    if ($bool) {
                        $new_str .= self::$vowels[mt_rand(0, self::$vowelsLen-1)];
                    } else {
                        $new_str .= strtolower(self::$vowels[mt_rand(0, self::$vowelsLen-1)]);
                    }
                    break;

                case "H":
                    $new_str .= self::$hex[mt_rand(0, self::$hexLen-1)];
                    break;

                default:
                    $new_str .= $str[$i];
                    break;
            }
        }

        return trim($new_str);
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

    public static function enquoteArray($arr, $char = "\"") {
        $newArr = array();
        foreach ($arr as $item) {
            $newArr[] = "{$char}$item{$char}";
        }
        return $newArr;
    }

}
