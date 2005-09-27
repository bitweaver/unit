<?php
    // $Id: all_tests.php,v 1.1.2.1 2005/09/27 19:57:12 docekal Exp $
    if (! defined('TEST')) {
        define('TEST', __FILE__);
    }
    require_once(dirname(__FILE__) . '/test_groups.php');
    require_once(dirname(__FILE__) . '/../reporter.php');
    
    $test = &new AllTests();
    if (SimpleReporter::inCli()) {
        exit ($test->run(new TextReporter()) ? 0 : 1);
    }
    $test->run(new HtmlReporter());
?>