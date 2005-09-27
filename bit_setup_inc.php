<?php
global $gBitSystem;
$gBitSystem->registerPackage ('bitunit', dirname(__FILE__).'/');
if( $gBitSystem->isPackageActive('bitunit')) {
  // ... maybe do some initialization stuff if your package is turned on
}
?>