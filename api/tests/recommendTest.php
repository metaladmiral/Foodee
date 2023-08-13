<?php

require_once('recommend.php');
require_once dirname(dirname(__FILE__)) . '../recommend.php'; #works fine

class recommendTest extends \PHPUnit\Framework\TestCase {
    public function testLaunchAPI() :void
    {
        $recommend = new Recommend();
        $resp = $recommend->launchAPI();

        $respArray = json_decode($resp, true);
        $respStatus = $respArray['status'];
        // $respStatus = "1";

        $expectedStatus = "1";

        $this->assertSame($expectedStatus, $respStatus);

    }
}

?>