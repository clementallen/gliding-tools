<?php

class HandicapTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {

        $this->Handicap = new Handicap();
    }

    protected function tearDown() {

        unset($this->Handicap);
    }

    public function testValidationFailsWithText() {

        $validation = $this->Handicap->validate('text');
        $this->assertEquals('Please enter a number', $validation);
    }

    public function testValidationFailsWithNoContent() {

        $validation = $this->Handicap->validate(null);
        $this->assertEquals('Please enter a value', $validation);
    }

    public function testValidationFailsWithNumberZero() {

        $validation = $this->Handicap->validate(0);
        $this->assertEquals('Please enter a value', $validation);
    }

    public function testValidationPassesWithNumber() {

        $this->assertNull( $this->Handicap->validate(1) );
        $this->assertNull( $this->Handicap->validate(50) );
        $this->assertNull( $this->Handicap->validate(100) );
        $this->assertNull( $this->Handicap->validate(10000) );
        $this->assertNull( $this->Handicap->validate(1000000) );
    }

    public function testCalculatePasses() {

        $this->assertEquals( 69, $this->Handicap->calculate(61.4, 89) );
        $this->assertEquals( 92.8, $this->Handicap->calculate(91.4, 98.5) );
        $this->assertEquals( 74, $this->Handicap->calculate(86.6, 117) );
        $this->assertEquals( 88.6, $this->Handicap->calculate(98.4, 111) );
    }

}