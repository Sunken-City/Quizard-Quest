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
  
  /**
  * depends testCreateUser
  
  public function testCreateCard()
  {
    create_card('picoriley', 'sqrt(onions)', "shallots", 1, null, 2);
    $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) 
        {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            assert
        }
    mysqli_query($db, "SELECT * FROM cards WHERE userID = '$userID';");
  }*/

  
}

?>