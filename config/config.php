<?php
/**
 * Main configuration file
 */
$config = [];
$config['crmPath'] = 'https://yetiforceCRM/';
$config['portalPath'] = 'http://portal/';
$config['language'] = 'en_us';
$config['theme'] = 'default';
$config['defaultModule'] = 'HelpDesk';
$config['timezone'] = 'Europe/Warsaw';
$config['languages'] = [
	'en_us' => 'English',
	'pl_pl' => 'Polski',
];
$config['listMaxEntriesFromApi'] = 50;
// Available record display options in listview for datatable element - [[values],[labels]]
$config['listEntriesPerPage'] = [[10, 25, 50, 100], [10, 25, 50, 100]];
$config['minScripts'] = false;
$config['debugApi'] = true;
$config['debugConsole'] = true;
$config['logs'] = true;
// Security
$config['apiKey'] = 'VMUwRByXHSq1bLW485ikfvcC97P6gJsz';
$config['serverName'] = 'portal';
$config['serverPass'] = 'portal';
$config['encryptDataTransfer'] = false;
$config['privateKey'] = 'config/private.key';
$config['publicKey'] = 'config/public.key';
$config['logo'] = 'layouts/Default/skins/images/logo.png';
/** If timezone is configured, try to set it */
if (isset($config['timezone']) && function_exists('date_default_timezone_set')) {
	@date_default_timezone_set($config['timezone']);
}
