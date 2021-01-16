<?php

namespace App\Service;

use PHPUnit\Framework\TestCase;

class ArrayUtilsTest extends TestCase
{

    public function testSearchArrayByValue()
    {
        $items = [
            ["pref" => "aomori", "name" => "okada"],
            ["pref" => "aomori", "name" => "sato"],
            ["pref" => "chiba", "name" => "okada"],
            ["pref" => "chiba", "name" => "satoshi"]
        ];
        $this->assertEquals(1, count(ArrayUtils::SearchArrayByValue($items, ["pref" => "aomori", "name" => "okada"])));
        $this->assertEquals(1, count(ArrayUtils::SearchArrayByValue($items, ["pref" => "chiba", "name" => "satoshi"])));
        $this->assertEquals(2, count(ArrayUtils::SearchArrayByValue($items, ["pref" => "aomori"])));
        $this->assertEquals(0, count(ArrayUtils::SearchArrayByValue($items, ["pref" => "xxxxx"])));
    }
}
