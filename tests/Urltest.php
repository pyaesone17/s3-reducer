<?php 

namespace Pyaesone17\S3Reducer\Tests;

use PHPUnit\Framework\TestCase;
use Pyaesone17\S3Reducer\Reducer;

class Urltest extends TestCase
{

    public function test_extract_path_should_returns_path()
    {
        $reducer = new Reducer("new-challenges");

        $path = "https://s3-ap-southeast-1.amazonaws.com/new-challenges/212/manawrama5.jpg";
        $assetPath = $reducer->extractPath($path);
        $this->assertEquals($assetPath,"new-challenges/212/manawrama5.jpg");

        $path = "https://new-challenges.s3-ap-southeast-1.amazonaws.com/212/manawrama5.jpg";
        $assetPath = $reducer->extractPath($path);
        $this->assertEquals($assetPath,"new-challenges/212/manawrama5.jpg");


        $path = "212/manawrama5.jpg";
        $assetPath = $reducer->extractPath($path);
        $this->assertEquals($assetPath,"new-challenges/212/manawrama5.jpg");
    }
}
