<?php


$tables = array(
		// Plugin currently has no DB entries
		// 'test_table' => "test_table_id I4 NOTNULL PRIMARY, memo X"
);

global $gBitInstaller;

foreach (array_keys ($tables) AS $tableName) {
  $gBitInstaller->registerSchemaTable(BITUNIT_PKG_NAME, $tableName, $tables[$tableName]);
}

$gBitInstaller->registerPackageInfo(BITUNIT_PKG_NAME, array(
        'description' => "Package that runs unit tests in Bitweaver",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
	'version' => '0.9',
	'state' => 'beta',
	'dependencies' => '',
));
?>
