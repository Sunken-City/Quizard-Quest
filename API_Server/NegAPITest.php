<?php
    /*\
    |*|     :: >>NEGATIVE UNIT TESTING ON THE API SERVER FOR QUIZZARD QUEST<< ::
    \*/
include 'API.php';

class NegAPITest extends PHPUnit_Framework_TestCase
{
  //Unit test that attempts to create a user.
  public function testCreateUser()
  {
    $response = create_user('Rico', 'Piley', 'z@z.z', 'ricopiley', '43214321', NULL, NULL, 0);
    $this->assertTrue($response);
  }
  
  /**
  * @depends testCreateUser
  */
  public function testValidateBadPassword()
  {
    $response = validate_password('ricopiley', 'THISAINTMYPASSWORDLOL');
    //Assert that this is an invalid password.
    $this->assertTrue(!$response);
  }
  
  /**
  * @depends testCreateUser
  */
  public function testValidateSQLInjectionPassword()
  {
    $response = validate_password('ricopiley', '\' OR 1=1 -- ');
    //Assert that this is an invalid password.
    $this->assertTrue(!$response);
  }
}
?>