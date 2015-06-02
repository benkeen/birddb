<?php

/**
 * @author Ben Keen <ben.keen@gmail.com>
 * @package Core
 */
class Core {

	private static $dbHostname = "localhost";
	private static $dbName = "birds";
	private static $dbUsername = "root";
	private static $dbPassword = "root";
	private static $errorReporting = 2047;

	public static $db;


	/**
	 * Core::init()
	 */
	public static function init() {
		error_reporting(self::$errorReporting);

		// ensure the timezone is set. This is an arbitrary value (well, I live in Vancouver!) but it prevents warnings
		if (ini_get("date.timezone") == "") {
			ini_set("date.timezone", "Canada/Vancouver");
		}

        self::initDatabase();
        //self::initSessions();
	}

	/**
	 * Initializes the Database object and stores it in Core::$db.
	 * @access private
	 */
	private static function initDatabase() {
        self::$db = new Database();
	}


	public static function initSessions() {
		if (session_id() == '') {
			new SessionManager();
			session_start();
			header("Cache-control: private");
		}
	}

    /**
     * @access public
     */
    public static function getHostname() {
        return self::$dbHostname;
    }

    /**
     * @access public
     */
    public static function getDbName() {
        return self::$dbName;
    }

    /**
     * @access public
     */
    public static function getDbUsername() {
        return self::$dbUsername;
    }

    /**
     * @access public
     */
    public static function getDbPassword() {
        return self::$dbPassword;
    }

}
