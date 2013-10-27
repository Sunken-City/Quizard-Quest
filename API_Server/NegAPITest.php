<?php
    /*\
    |*|     :: >>NEGATIVE UNIT TESTING ON THE API SERVER FOR QUIZZARD QUEST<< ::
    \*/
include 'API.php';

class NegAPITest extends PHPUnit_Framework_TestCase
{
  //Unit test that attempts to create a user. This is positive so that other tests will work
  public function testCreateUser()
  {
    $response = create_user('Rico', 'Piley', 'z@z.z', 'ricopiley', '43214321', NULL, NULL, 0);
    $this->assertTrue($response);
    
    //Check the database to ensure it worked
    $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) 
        {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            $this->fail("Couldn't connect to the database. Some database issue?");
        }
    $result = mysqli_query($db, "SELECT * FROM players WHERE username = 'ricopiley';");
    
    if ($result == FALSE)
    {
      $this->fail("Query failed! Something is wrong with the input query or the database structure.");
    }
    while($row = mysqli_fetch_array($result))
    {
      $this->assertEquals($row['fName'], 'Rico', $row['fName'].' did not match Rico');
      $this->assertEquals($row['lName'], 'Piley', $row['lName'].' did not match Piley');
    }

    mysqli_close($db);
  }
  
  /**
  * @depends testCreateUser
  */
  public function testValidateBadPassword()
  {
    $response = validate_password('ricopiley', 'THISAINTMYPASSWORDLOL');
    //Assert that this is an invalid password.
    $this->assertFalse($response);
  }
  
  /**
  * @depends testCreateUser
  */
  public function testValidateSQLInjectionPassword()
  {
    $response = validate_password('ricopiley', '\' OR 1=1 -- ');
    //Assert that this is an invalid password.
    $this->assertFalse($response);
  }
}
?>