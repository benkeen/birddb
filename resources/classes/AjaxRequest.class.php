<?php

/**
 * A generic class for handling all of the Core's Ajax requests. All requests are identified
 * through a unique "action" string, and (usually) arbitrary other info passed via POST.
 * @author Ben Keen <ben.keen@gmail.com>
 */
class AjaxRequest {
	private $action;
	private $response;
	private $post;
    private $get;

	/**
	 * AjaxRequest objects are automatically processed when they are created, based on the unique $action
	 * value. The result of the call is stored in $response to be handled however you need (e.g. output
	 * as JSON, XML etc) - or an Exception is thrown if something went wrong. Exceptions are used SOLELY for
	 * program errors: not for user-entry errors.
	 */
	public function __construct($action, $post = array(), $get = array()) {

		$this->action = $action;
		$this->get = Utils::sanitize($get);

		switch ($this->action) {
			case "searchSpecies":
				$this->response = Species::search($this->get["str"]);
				break;
		}
	}


	// HELPERS

	public function getResponse() {
		return Utils::utf8_encode_array($this->response);
	}
}
