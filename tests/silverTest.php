<?php

class SilverTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {

        $this->Silver = new Silver();
    }

    protected function tearDown() {

        unset($this->Silver);
    }

    public function testValidationFailsWithText() {

        $validation = $this->Silver->validate('text');
        $this->assertEquals('Please enter a number', $validation);
    }

    public function testValidationFailsWithNoContent() {

        $validation = $this->Silver->validate(null);
        $this->assertEquals('Please enter a value', $validation);
    }

    public function testValidationFailsWithNumberZero() {

        $validation = $this->Silver->validate(0);
        $this->assertEquals('Please enter a value', $validation);
    }

    public function testValidationPassesWithNumber() {

        $this->assertNull( $this->Silver->validate(1) );
        $this->assertNull( $this->Silver->validate(50) );
        $this->assertNull( $this->Silver->validate(100) );
        $this->assertNull( $this->Silver->validate(10000) );
        $this->assertNull( $this->Silver->validate(1000000) );
    }

    public function testLaunchHeightPasses() {

        $this->assertEquals(3281, $this->Silver->launchHeight(100) );
        $this->assertEquals(6562, $this->Silver->launchHeight(200) );
        $this->assertEquals(9843, $this->Silver->launchHeight(300) );
        $this->assertEquals(13124, $this->Silver->launchHeight(400) );
    }

    public function testAirfieldHeightPasses() {

        $this->assertEquals(2881, $this->Silver->airfieldHeight(3281, 500, 100) );
        $this->assertEquals(6962, $this->Silver->airfieldHeight(6562, 100, 500) );
        $this->assertEquals(9643, $this->Silver->airfieldHeight(9843, 400, 200) );
        $this->assertEquals(13324, $this->Silver->airfieldHeight(13124, 200, 400) );
    }


}