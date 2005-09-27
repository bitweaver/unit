<?php
require_once ('../bit_setup_inc.php');
require_once (BITUNIT_PKG_PATH . '/SmartyReporter.php');
require_once (BITUNIT_PKG_PATH . '/simpletest/unit_tester.php');
require_once (BITUNIT_PKG_PATH . '/TestFinder.php');


// Collect the parameters

$all        = false;
$all_active = false;
$testMode   = false;
$package    = '';


if (isset ($_REQUEST['test'])) {
  $testMode = true;
  
  if (isset ($_REQUEST['all'])) {
    $all = true;
  }
  elseif (isset ($_REQUEST['all_active'])) {
    $all_active = true;
  }
  elseif (isset ($_REQUEST['package'])) {
    $package = $_REQUEST['package'];
    // Package must be validated against availeble directories
  }

  if (isset ($_REQUEST['show_passes'])) {
    $show_only_passes = false;
  }
  else {
    $show_only_passes = true;
  }

}


if ($testMode) {
  $testContainer = new TestDirFinder;
  
  $testContainer->findTests ('all');
  $gBitSmarty->assign('tests', $testContainer->getTests ());

  $test = &new GroupTest('All file tests');

  foreach ($testContainer->getTests () as $testDir) {
    $testCases = new TestCaseFinder ($testDir);
    if ($testCases->hasTestFiles ()) { // or if debug is true
      $group = &new GroupTest($testDir);
      foreach ($testCases->getTestFiles () as $testCase) {
	$group->addTestFile ($testCase);
      }
      $test->addTestCase ($group);
    }
  }
  // $test->addTestFile(KERNEL_PKG_PATH . '/test/TestBitPreferences.php');

  
  if (false) { // Set to true for comparison agains SimpleTest provided class
    require_once (BITUNIT_PKG_PATH . '/simpletest/reporter.php');
    $test->run(new HtmlReporter());
  }
  else {
    // $reporter = new SmartyReporter(false); // paint only passes
    // $reporter = new SmartyReporter(true);
    $reporter = new SmartyReporter($show_only_passes);
    $test->run($reporter);

    $gBitSmarty->assign('test', $test);

    $gBitSmarty->assign('testResults', $reporter->getTests ());

    $gBitSmarty->assign('testPassCount',      $reporter->getPassCount ());
    $gBitSmarty->assign('testFailCount',      $reporter->getFailCount ());
    $gBitSmarty->assign('testExceptionCount', $reporter->getExceptionCount ());

    $gBitSmarty->assign('testCaseProgress', $reporter->_testCaseProgress);
    $gBitSmarty->assign('testCaseCount',    $reporter->_testCaseCount);
  
    if (! headers_sent()) {
      header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
    }

  }
}
$gBitSystem->display ('bitpackage:bitunit/bitunit.tpl', 
		      'bitUnit - Testing framework for bitweaver');
?>