<?php

require_once 'Auth/BrowserID.php';

class OkayTest extends PHPUnit_Framework_TestCase
{
    public function testFailureNoAssertion()
    {
        $verifier = new Auth_BrowserID('http://localhost:8080');
        $result = $verifier->verifyAssertion('assertion');

        $this->assertEquals('failure', $result->status);
        $this->assertEquals('no certificates provided', $result->reason);
    }

    public function testFailureRemoteNoAssertion()
    {
        $verifier = new Auth_BrowserID('http://localhost:8080', $type = 'remote');
        $result = $verifier->verifyAssertion('assertion');

        $this->assertEquals('failure', $result->status);
        $this->assertEquals('no certificates provided', $result->reason);
    }

    /**
     * @expectedExceptionMessage Not implemented.
     */
    public function testFailureLocalNoAssertion()
    {
        $verifier = new Auth_BrowserID('http://localhost:8080', $type = 'local');
    }
}

?>
