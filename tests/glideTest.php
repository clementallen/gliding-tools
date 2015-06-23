<?php

class GlideTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {

        $this->Glide = new Glide();
    }

    protected function tearDown() {

        unset($this->Glide);
    }

    public function testValidationFailsWithText() {

        $validation = $this->Glide->validate('text');
        $this->assertEquals('Please enter a number', $validation);
    }

    public function testValidationFailsWithNoContent() {

        $validation = $this->Glide->validate(null);
        $this->assertEquals('Please enter a value', $validation);
    }

    public function testValidationFailsWithTooHighNumber() {

        $validation = $this->Glide->validate(40001);
        $this->assertEquals('Come on, make it sensible!', $validation);
    }

    public function testValidationFailsWithNegativeNumber() {

        $validation = $this->Glide->validate(-1);
        $this->assertEquals('Come on, make it sensible!', $validation);
    }

    public function testValidationFailsWithNumberZero() {

        $validation = $this->Glide->validate(0);
        $this->assertEquals('Please enter a value', $validation);
    }

    public function testValidationsPassesWithNumber() {

        $this->assertNull( $this->Glide->validate(1) );
        $this->assertNull( $this->Glide->validate(50) );
        $this->assertNull( $this->Glide->validate(100) );
        $this->assertNull( $this->Glide->validate(40000) );
    }

    public function testCalculateRangePasses() {

        $this->assertEquals(46.33, $this->Glide->calculateRange(4000, 38) );
        $this->assertEquals(59.44, $this->Glide->calculateRange(3000, 65) );
        $this->assertEquals(20.73, $this->Glide->calculateRange(2000, 34) );
        $this->assertEquals(14.48, $this->Glide->calculateRange(1000, 47.5) );
    }

    public function testCalculateHeightLossPasses() {

        $this->assertEquals(86, $this->Glide->calculateHeightLoss(4000, 46.33) );
        $this->assertEquals(50, $this->Glide->calculateHeightLoss(3000, 59.44) );
        $this->assertEquals(96, $this->Glide->calculateHeightLoss(2000, 20.73) );
        $this->assertEquals(69, $this->Glide->calculateHeightLoss(1000, 14.48) );
    }

    public function testCalculateDurationPasses() {

        $this->assertEquals(29, $this->Glide->calculateDuration(4000, 140) );
        $this->assertEquals(38, $this->Glide->calculateDuration(3000, 78) );
        $this->assertEquals(16, $this->Glide->calculateDuration(2000, 126) );
        $this->assertEquals(10, $this->Glide->calculateDuration(1000, 96) );
    }

}