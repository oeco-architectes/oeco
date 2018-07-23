<?php

namespace Util;

class Request extends \Zend\Http\PhpEnvironment\Request {
	public static function baseUrl() {
		$request = new self();
		return $request->detectBaseUrl();
	}
}