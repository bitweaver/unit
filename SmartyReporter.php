<?php
require_once('bit_setup_inc.php');
require_once(BITUNIT_PKG_PATH . 'simpletest/simple_test.php');


function enum()
{
  $i=0;
  $ARG_ARR = func_get_args();
  if (is_array($ARG_ARR)) {
    foreach ($ARG_ARR as $CONSTANT) {
      define ($CONSTANT, ++$i);
    }
  }
}
 

enum ('TestName',
      'TestHeader',
      'TestFooter',
      'TestGroupStart',
      'TestStart',
      'TestPass',
      'TestFail',
      'TestException');


class SmartyReporter extends SimpleReporter {

  var $tests;
  var $onlyErrors;
  
  var  $_testCaseProgress;
  var  $_testCaseCount;


  function SmartyReporter ($onlyErrors)
  {
    $this->SimpleReporter ();
    $this->tests = Array ();
    $this->onlyErrors = $onlyErrors;
  }


###### Name of selected test group
  function paintHeader($test_name)
  {
    $test = Array ();
    $test[] = TestHeader;
    $test[] = $test_name;
    $this->tests[] = $test;
    #print "paintHeader $test_name <br />\n";
  }
    
  function paintFooter($test_name)
  {
    $this->_testCaseProgress = $this->getTestCaseProgress ();
    $this->_testCaseCount = $this->getTestCaseCount ();
    # print "paintFooter $test_name <br />\n";
  }
###### End name of selected test group;
  
 
##### Name of extracted (or possibly assigned) (sub)group
  function paintGroupStart ($test_name, $size)
  {
    parent::paintGroupStart ($test_name, $size);
    #print "paintGroupStart $test_name, $size <br />\n";
    $test = Array ();
    $test[] = TestGroupStart;
    $test[] = $test_name;
    $test[] = $size;
    $this->tests[] = $test;
  }
 
  function paintGroupEnd ($test_name)
  {
    parent::paintGroupEnd ($test_name);
    #print "paintGroupEnd $test_name <br />\n";
  }
##### End name of extracted (or possibly assigned) (sub)group

  function paintStart($test_name, $size)
  {
    parent::paintStart($test_name, $size);
    #print "paintStart $test_name, $size <br />\n";
    $test = Array ();
    $test[] = TestStart;
    $test[] = $test_name;
    $test[] = $size;
    $this->tests[] = $test;
  }
    
  function paintEnd($test_name, $size)
  {
    parent::paintEnd($test_name, $size);
    #print "paintEnd $test_name, $size <br />\n";
  }
    
  function paintPass($message)
  {
    parent::paintPass($message);
    #print "paintPass $message <br />\n";
    if (!$this->onlyErrors) {
      $test = Array ();
      $test[] = TestPass;
      $test[] = $message;
      $this->tests[] = $test;
    }
  }
    
  function paintFail($message) 
  {
    parent::paintFail($message);
    #print "paintFail $message <br />\n";
    $test = Array ();
    $test[] = TestFail;
    $test[] = $message;
    $test[] = $this->getTestList (); // breadcrumb
    $this->tests[] = $test;
  }

  function paintException ($message)
  {
    parent::paintException($message);
#print "paintFail $message <br />\n";
    $test = Array ();
    $test[] = TestException;
    $test[] = $message;
    $test[] = $this->getTestList (); // breadcrumb
    $this->tests[] = $test;
  }

  function getTests()
  {
    return $this->tests;
  }
}
?>