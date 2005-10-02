<?php

require_once (KERNEL_PKG_PATH . 'BitBase.php');

class TestDirFinder {

  var $fTestFilters;
  var $tests       = Array ();
  var $filterTests = Array ();

  var $testDirName       = 'test';
  var $filterTestDirName = 'smarty_filter_tests';
  
  function TestFinder ()
  {
    $this->Constructor ();
  }

  function Constructor ()
  {
    // parent::Constructor ();
  } 

  function findTests ($method, $fTestFilters = false)
  {
    $this->fTestFilters = $fTestFilters;

    if ($method = 'all') {
      
    }
    
    // We have not yet implemented any other methods
    $this->findTestDirectories (BIT_ROOT_PATH);
  }


  // Test directories can be found in  any directory while
  // filter test directories can only be found in test directories
  function findTestDirectories ($rootDir)
  {
    // print "findTestDirectories dir: $rootDir <br \>\n";

    if (is_dir ($rootDir)) {
      if ($rootDirHandle = opendir ($rootDir)) {
      
	while (false !== ($subDir = readdir ($rootDirHandle))) {
	  
	  if ('.' == $subDir || '..' == $subDir) {  
	    continue;
	  }
      
	  $testDir = $rootDir . $subDir . '/';

	  if (is_dir ($testDir)) {
	    if ($subDir == $this->testDirName) {
	      $this->tests[] = $testDir;
	      
	      if ($this->fTestFilters) {
		$filterTestDir = $testDir . $this->filterTestDirName . '/';
		if (is_dir ($filterTestDir)) {
		  $this->filterTests[] = $filterTestDir;
		}
	      }
	    }

	    $this->findTestDirectories($testDir);
	  }
	}
	closedir ($rootDirHandle);
      }
    }
  }

  function getTests ()
  {
    return $this->tests;
  }
  
  function getFilterTests ()
  {
    return $this->filterTests;
  }

}

class TestCaseFinder {

  var $testFiles = Array ();

  function TestCaseFinder ($dir)
  {
    // print "TestCaseFinder dir: $dir <br \>\n";
    if (is_dir ($dir)) {
      if ($dirHandle = opendir ($dir)) {

	while (false !== ($file = readdir ($dirHandle))) {
	  $testFile = $dir . $file;

	  // print "TestCaseFinder found $testFile <br \>\n";
	  if (!is_file ($testFile)) {
	    // Skip directories
	    continue;
	  }      
      

	  // print "TestCaseFinder accepted $file <br \>\n";
	  if (preg_match ('/^test.*\.php$/i', $file)) {
	    // exclude the parse error test from simple tests for now
	    // since all activities stop then.
	    // The test can most likely be reactivated when we have PHP5 
	    // exceptions and these are handled.
	    if (! 
		(preg_match ('!.*/simpletest/test/test_with_parse_error.php!',
			     $testFile) ||
		 preg_match ('!.*/simpletest/test/test_groups.php!',
			     $testFile))
		) {
	      // print "TestCaseFinder added $testFile <br \>\n";
	      $this->testFiles[] = $testFile;
	      // print "TestCaseFinder After Add <br \>\n";
	    }
	  }
	}
	closedir ($dirHandle);
      }
    }
  }


  function getTestFiles ()
  {
    return $this->testFiles;
  }
  
  function hasTestFiles ()
  {
    return count ($this->testFiles);
  }
}

?>