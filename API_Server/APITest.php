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
    $this->assertTrue($response, "create_user returned false instead of true.");
    
    //Check the database to ensure it works
    $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) 
        {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            $this->fail("Couldn't connect to the database. Some database issue?");
        }
    $result = mysqli_query($db, "SELECT * FROM players WHERE username = 'picoriley';");
    
    if ($result == FALSE)
    {
      $this->fail("Query failed! Something is wrong with the input query or the database structure.");
    }
    while($row = mysqli_fetch_array($result))
    {
      $this->assertEquals($row['fName'], 'Pico', $row['fName'].'Did not match Pico');
    }

    mysqli_close($db);
      
  }
  
  /**
  * @depends testCreateUser
  */
  public function testValidatePassword()
  {
    $response = validate_password('picoriley', '12341234');
    $this->assertTrue($response, "validate_password returned false instead of true.");
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