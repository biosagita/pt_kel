<?php
if (!function_exists('get_show_date'))
{
	function get_show_date($now = '') {
		//$now = date('Y-m-d h:i:s');
		if(empty($now)) return false;
		list($year, $month, $day, $hour, $min, $sec) = preg_split('/[: -]/', $now);
		$arr = array(
			'year' 	=> $year,
			'month' => $month,
			'day' 	=> $day,
			'hour' 	=> $hour,
			'min' 	=> $min,
			'sec' 	=> $sec,
		);
	    return $arr;
	}
}

if (!function_exists('get_current_url_other'))
{
	function get_current_url_other() {

		$protocol = 'http';
		if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')) {
			$protocol .= 's';
			$protocol_port = $_SERVER['SERVER_PORT'];
		} else {
			$protocol_port = 80;
		}

		$host = $_SERVER['HTTP_HOST'];
		$port = $_SERVER['SERVER_PORT'];
		$request = $_SERVER['PHP_SELF'];
		$query = isset($_SERVER['argv']) ? substr($_SERVER['argv'][0], strpos($_SERVER['argv'][0], ';') + 1) : '';

		$toret = $protocol . '://' . $host . ($port == $protocol_port ? '' : ':' . $port) . $request . (empty($query) ? '' : '?' . $query);

		return $toret;
	}
}

if (!function_exists('get_current_url_own'))
{
	function get_current_url_own() {

	  	$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
		    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
		    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}

if (!function_exists('get_client_ip'))
{
	function get_client_ip() {
	    $ipaddress = '';
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(!empty($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(!empty($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(!empty($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
}

if (!function_exists('get_pph21'))
{
	function get_pph21($jumlah) {
		$tmp = 12 * $jumlah; //pendapatan pertahun
	  	if($tmp <= 50000000) {
	  		$jumlah = round($jumlah/100) * 5; //sampai dengan Rp 50 juta : 5%
	  	} elseif ($tmp <= 250000000) {
	  		$jumlah = round($jumlah/100) * 15; //diatas Rp 50 juta sampai dengan Rp 250 juta : 15%
	  	} elseif ($tmp <= 500000000) {
	  		$jumlah = round($jumlah/100) * 25; //diatas Rp 250 juta sampai dengan Rp 500 juta : 25%
	  	} else {
	  		$jumlah = round($jumlah/100) * 30; //diatas Rp 500 juta : 30%
	  	}

	  	return $jumlah;
	}
}

function date_to_mysql($date, $delimiter='-') {
	if(empty($date)) return 0;
	list($day, $month, $year) = explode($delimiter, $date);
	$date = $year . '-' . $month . '-' . $day;
	return $date;
}

function mysql_to_date($date, $delimiter='-') {
	if(empty($date)) return 0;
	list($year, $month, $day) = explode($delimiter, $date);
	$date = $day . '-' . $month . '-' . $year;
	return $date;
}

function get_time_date_diff($date_start, $date_end) {
	$date_start = date('Y-m-d', $date_start);
	$date_end 	= date('Y-m-d', $date_end);

	$d1 = new DateTime($date_start);
	$d2 = new DateTime($date_end);

	$diff = (array) $d2->diff($d1);

	return $diff;
}

function parse_stringphp($userinput, $values) {
	$result = preg_replace_callback(
	    '!{([a-z_]*)}!', // limited to one small-case latin letter 
	    function ($capture) use ($values) { 
	        // for each match this function is called
	        // use($values) "imports the array into the function
	        // whatever this function returns replaces the match in the subject string
	        $key = $capture[1];
	        return isset($values[$key]) ? $values[$key] : '';
	    },
	    $userinput
	);
	return $result;
}

//slug function reference wordpress
function utf8_uri_encode( $utf8_string, $length = 0 ) {
	$unicode = '';
	$values = array();
	$num_octets = 1;
	$unicode_length = 0;

	mbstring_binary_safe_encoding();
	$string_length = strlen( $utf8_string );
	reset_mbstring_encoding();

	for ($i = 0; $i < $string_length; $i++ ) {

		$value = ord( $utf8_string[ $i ] );

		if ( $value < 128 ) {
			if ( $length && ( $unicode_length >= $length ) )
				break;
			$unicode .= chr($value);
			$unicode_length++;
		} else {
			if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;

			$values[] = $value;

			if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
				break;
			if ( count( $values ) == $num_octets ) {
				if ($num_octets == 3) {
					$unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
					$unicode_length += 9;
				} else {
					$unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
					$unicode_length += 6;
				}

				$values = array();
				$num_octets = 1;
			}
		}
	}

	return $unicode;
}

function reset_mbstring_encoding() {
	mbstring_binary_safe_encoding( true );
}

function mbstring_binary_safe_encoding( $reset = false ) {
	static $encodings = array();
	static $overloaded = null;

	if ( is_null( $overloaded ) )
		$overloaded = function_exists( 'mb_internal_encoding' ) && ( ini_get( 'mbstring.func_overload' ) & 2 );

	if ( false === $overloaded )
		return;

	if ( ! $reset ) {
		$encoding = mb_internal_encoding();
		array_push( $encodings, $encoding );
		mb_internal_encoding( 'ISO-8859-1' );
	}

	if ( $reset && $encodings ) {
		$encoding = array_pop( $encodings );
		mb_internal_encoding( $encoding );
	}
}

function seems_utf8($str) {
	mbstring_binary_safe_encoding();
	$length = strlen($str);
	reset_mbstring_encoding();
	for ($i=0; $i < $length; $i++) {
		$c = ord($str[$i]);
		if ($c < 0x80) $n = 0; # 0bbbbbbb
		elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
		elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
		elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
		elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
		elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
		else return false; # Does not match any model
		for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
			if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
				return false;
		}
	}
	return true;
}

function sanitize_title_with_dashes( $title, $raw_title = '', $context = 'display' ) {
	$title = strip_tags($title);
	// Preserve escaped octets.
	$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
	// Remove percent signs that are not part of an octet.
	$title = str_replace('%', '', $title);
	// Restore octets.
	$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

	if (seems_utf8($title)) {
		if (function_exists('mb_strtolower')) {
			$title = mb_strtolower($title, 'UTF-8');
		}
		$title = utf8_uri_encode($title, 200);
	}

	$title = strtolower($title);
	$title = preg_replace('/&.+?;/', '', $title); // kill entities
	$title = str_replace('.', '-', $title);

	if ( 'save' == $context ) {
		// Convert nbsp, ndash and mdash to hyphens
		$title = str_replace( array( '%c2%a0', '%e2%80%93', '%e2%80%94' ), '-', $title );

		// Strip these characters entirely
		$title = str_replace( array(
			// iexcl and iquest
			'%c2%a1', '%c2%bf',
			// angle quotes
			'%c2%ab', '%c2%bb', '%e2%80%b9', '%e2%80%ba',
			// curly quotes
			'%e2%80%98', '%e2%80%99', '%e2%80%9c', '%e2%80%9d',
			'%e2%80%9a', '%e2%80%9b', '%e2%80%9e', '%e2%80%9f',
			// copy, reg, deg, hellip and trade
			'%c2%a9', '%c2%ae', '%c2%b0', '%e2%80%a6', '%e2%84%a2',
			// acute accents
			'%c2%b4', '%cb%8a', '%cc%81', '%cd%81',
			// grave accent, macron, caron
			'%cc%80', '%cc%84', '%cc%8c',
		), '', $title );

		// Convert times to x
		$title = str_replace( '%c3%97', 'x', $title );
	}

	$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
	$title = preg_replace('/\s+/', '-', $title);
	$title = preg_replace('|-+|', '-', $title);
	$title = trim($title, '-');

	return $title;
}

function excel_datetime($datetime, $delimiter='-') {
	if(empty($datetime)) return 0;
	list($date, $time) = explode(' ', $datetime);
	list($year, $month, $day) = explode($delimiter, $date);
	$date = $day . '/' . $month . '/' . $year;
	return $date;
}