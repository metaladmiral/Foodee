<?php

class recommendTest extends PHPUnit\Framework\TestCase {
    public function testLaunchAPI() :void
    {
        $url = "http://foodee.test/api/recommend.php";

        $postData = array(
            'foodtype_user' => 'veg',
            'food_time_type' => 'breakfast',
            'declined_food_array' => '[]',
            'specialday' => '0'
        );

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData)); // Convert data to URL-encoded format
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'cURL Error: ' . curl_error($ch);
        }

        curl_close($ch);
        $resp = $response;
        $respObj = json_decode($resp, true);
        $statusResp = $respObj['status'];

        $expected = "1";

        $this->assertSame($expected, $statusResp);

    }
}

?>