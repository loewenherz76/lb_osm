<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'LeonhardBolschakow.' . $_EXTKEY,
	'Pi1',
	array(
		'OSM' => 'list,show',

	),
	// non-cacheable actions
	array(
		'OSM' => 'list,show',

	)
);
