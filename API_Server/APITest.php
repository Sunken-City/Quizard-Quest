<?php
    /*\
    |*|     :: >>UNIT TESTING ON THE API SERVER FOR QUIZZARD QUEST<< ::
    \*/
include 'API.php';

class APITest extends PHPUnit_Framework_TestCase
{
  //Unit test that attempts to create a user.
  public function testCreateUser()
  {
    $response = create_user('Pico', 'Riley', 'a@a.a', 'picoriley', '12341234', NULL, NULL, 0);
    $this->assertTrue($response);
  }
  
  /**
  * @depends testCreateUser
  */
  public function testValidatePassword()
  {
    $response = validate_password('picoriley', '12341234');
    $this->assertTrue($response);
  }
  
}

?>