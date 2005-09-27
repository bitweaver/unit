<?php
    // $Id: shell_tester_test.php,v 1.1.2.1 2005/09/27 19:57:12 docekal Exp $

    Mock::generate('SimpleShell');
    
    class TestOfShellTestCase extends ShellTestCase {
        var $_mock_shell = false;
        
        function &_getShell() {
            return $this->_mock_shell;
        }
        
        function testGenericEquality() {
            $this->assertEqual('a', 'a');
            $this->assertNotEqual('a', 'A');
        }
        
        function testExitCode() {
            $this->_mock_shell = &new MockSimpleShell($this);
            $this->_mock_shell->setReturnValue('execute', 0);
            $this->_mock_shell->expectOnce('execute', array('ls'));
            $this->assertTrue($this->execute('ls'));
            $this->assertExitCode(0);
            $this->_mock_shell->tally();
        }
        
        function testOutput() {
            $this->_mock_shell = &new MockSimpleShell($this);
            $this->_mock_shell->setReturnValue('execute', 0);
            $this->_mock_shell->setReturnValue('getOutput', "Line 1\nLine 2\n");
            $this->assertOutput("Line 1\nLine 2\n");
        }
        
        function testOutputPatterns() {
            $this->_mock_shell = &new MockSimpleShell($this);
            $this->_mock_shell->setReturnValue('execute', 0);
            $this->_mock_shell->setReturnValue('getOutput', "Line 1\nLine 2\n");
            $this->assertOutputPattern('/line/i');
            $this->assertNoOutputPattern('/line 2/');
        }
    }
?>