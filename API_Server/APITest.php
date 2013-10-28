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
    
    //Check the database to ensure it worked
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
      $this->assertEquals($row['fName'], 'Pico', $row['fName'].' did not match Pico');
      $this->assertEquals($row['lName'], 'Riley', $row['lName'].' did not match Riley');
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
  * @depends testValidatePassword
  */
  public function testCreateCard()
  {
    //This function call ensures that we have a session for the subsequent calls.
    validate_password('picoriley', '12341234');
    
    create_card('sqrt(onions)', "shallots", 1, null, 2);
    
    //Check the database to ensure it worked
    $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) 
        {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            $this->fail("Couldn't connect to the database. Some database issue?");
        }
    $result = mysqli_query($db, "SELECT * FROM cards WHERE userID = 1;");
    
    if ($result == FALSE)
    {
      $this->fail("Query failed! Something is wrong with the input query or the database structure.");
    }
    while($row = mysqli_fetch_array($result))
    {
      $this->assertEquals($row['question'], 'sqrt(onions)', $row['question'].' did not match sqrt(onions)');
      $this->assertEquals($row['answer'], 'shallots', $row['answer'].' did not match shallots');
    }

    mysqli_close($db);
  }
  
  /**
  * @depends testCreateCard
  */
  public function testDeleteCard()
  {
    //This function call ensures that we have a session for the subsequent calls.
    validate_password('picoriley', '12341234');
    
    delete_card('1');
    
    //Check the database to ensure it worked
    $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) 
        {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            $this->fail("Couldn't connect to the database. Some database issue?");
        }
    $result = mysqli_query($db, "SELECT * FROM cards WHERE cardID = 1;");
    
    $this->assertTrue(0 == mysqli_num_rows($result));

    mysqli_close($db);
  }

}

?>