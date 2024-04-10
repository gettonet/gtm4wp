<?php
/**
 * GTM4WP Matomo Device Detector integration.
 *
 * @package GTM4WP
 * @author Thomas Geiger
 * @copyright 2013- Geiger Tamás e.v. (Thomas Geiger s.e.)
 * @license GNU General Public License, version 3
 */

use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;

require_once dirname( __FILE__ ) . '/../vendor/autoload.php';

AbstractDeviceParser::setVersionTruncation( AbstractDeviceParser::VERSION_TRUNCATION_NONE );

$user_agent   = isset( $_SERVER['HTTP_USER_AGENT'] ) ? wp_strip_all_tags( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';
$client_hints = ClientHints::factory( $_SERVER );

$dd = new DeviceDetector( $user_agent, $client_hints );
if ( $dd ) {
	$dd->parse();
}

if ( $gtm4wp_options[ GTM4WP_OPTION_INCLUDE_BROWSERDATA ] ) {
	$client_data = $dd->getClient();

	$data_layer['browserName']    = $client_data['name'];
	$data_layer['browserVersion'] = $client_data['version'];

	$data_layer['browserEngineName']    = $client_data['engine'];
	$data_layer['browserEngineVersion'] = $client_data['engine_version'];

	$data_layer['browserData'] = $client_data;

	$data_layer['browserData']['bot'] = $dd->getBot();
}

if ( $gtm4wp_options[ GTM4WP_OPTION_INCLUDE_OSDATA ] ) {
	$os_data = $dd->getOs();

    $data_layer['osName']    = $os_data['name'];
	$data_layer['osVersion'] = $os_data['version'];

	$data_layer['osData'] = $os_data;
}

if ( $gtm4wp_options[ GTM4WP_OPTION_INCLUDE_DEVICEDATA ] ) {
	$data_layer['deviceType']         = $dd->getDeviceName();
	$data_layer['deviceManufacturer'] = $dd->getBrandName();
	$data_layer['deviceModel']        = $dd->getModel();

	$data_layer['deviceData'] = array(
		'type'  => $dd->getDevice(),
		'brand' => $dd->getBrandName(),
		'model' => $dd->getModel(),
	);
}