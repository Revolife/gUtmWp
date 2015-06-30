<?php
class gUtmWp{
	public static function start(){
		self::bindWpActions();
		self::bindWpFilters();
	}

	private static function bindWpActions(){
		add_action('send_headers',[ 'gUTM', 'init']);
	}

	private static function bindWpFilters(){
		add_filter( 'wp_mail', [ __CLASS__, 'wpmailFilter']);

	}

	public static function wpmailFilter($args ){
		$args['message'] = self::replaceUtmData($args['message']);
		return $args;
	}

	private static function replaceUtmData($message){
		$utm = gUTM::getLastUtmConversion();
		$replace= '';
		if(!empty($utm))
			foreach ( $utm as $k=>$v ) {
				$replace .= "$k : $v".PHP_EOL;
			}

		return str_replace('[gUTM]',$replace,$message);
	}
}
?>
