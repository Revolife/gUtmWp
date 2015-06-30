<?php

/**
 * Class to determine the Google UTM (Urchin Tracking Module) tails
 *
 * Usage:
 *      gUTM::init();
 *      ...
 *      var_dump(gUTM::getLastUtmConversion());
 *
 * @author Grom <grom@revolife.com>
 * @package Revolife engine
 * @subpackage ecommerce
 * @version 1.0 26.06.2015
 *
 */

class gUTM {

	/**
	 * UTM params
	 * @var array
	 */
	private static $UTM=[
		'utm_source'=>'',
		'utm_medium'=>'',
		'utm_term'=>'',
		'utm_content'=>'',
		'utm_campaign'=>'',

	];

	/**
	 * UTM history form client cookies
	 * @var array
	 */
	private static $UTMHistory = [];

	/**
	 * initialize gUTM in start point
	 */
	public static function init(){
		self::_getUtmHistory();
		if(self::_checkConversion()) {
			self::_readUTM();
			self::_writeUtmHistory();
		}

	}

	/**
	 * get UTM history from clien cookies
	 */
	private static function _getUtmHistory(){
		if( !empty($_COOKIE['gUTM_COOKIE']) )
			self::$UTMHistory = (array)json_decode($_COOKIE['gUTM_COOKIE'], true);
	}

	/**
	 * check is current conversion has UTM tail
	 * @return bool
	 */
	private static function _checkConversion(){
		return ( !empty($_GET['utm_source']) && !empty($_GET['utm_medium']) &&  !empty($_GET['utm_campaign']) ) ;
	}

	/**
	 * write updated UTM history in client cookies
	 */
	private static function _writeUtmHistory(){
		$utm = self::$UTM;
		$utm_key = md5(implode('|||',$utm));
		$utm['date'] = date('d.m.Y H:i:s');
		unset(self::$UTMHistory[$utm_key]);
		self::$UTMHistory[$utm_key] = $utm;
		setcookie('gUTM_COOKIE', json_encode(self::$UTMHistory), -1, "/", "", NULL, TRUE);
	}

	/**
	 * read current UTM marks from tail
	 */
	private static function _readUTM(){
		foreach (self::$UTM as $k=>$v) {
			self::$UTM[$k] = $_GET[$k];
		}
	}

	/**
	 * get all user UTM history
	 * @return array|bool
	 */
	public static function getAllUtmHistory(){
		return empty(self::$UTMHistory) ? false : self::$UTMHistory ;
	}

	/**
	 * get first or last UTM conversion or his param by name
	 * @param bool $param
	 * @param bool $last
	 * @return bool|mixed
	 */
	private static function _getUtmConversion($param = false, $last = true){
		if(empty(self::$UTMHistory)) return false;
		$utm = $last ? end(self::$UTMHistory) : reset(self::$UTMHistory);
		return (empty($param) || !in_array($param,array_keys(self::$UTM))) ? $utm : $utm[$param];

	}

	/*
	 * get firs UTM conversion or his param by name
	 */
	public static function getFirstUtmConversion($param = false){
		return self::_getUtmConversion($param, false);
	}

	/**
	 * get last UTM conversion or his param by name
	 * @param bool $param
	 * @return bool|mixed
	 */
	public static function getLastUtmConversion($param = false){
		return self::_getUtmConversion($param);
	}
} 