<?php

    /*\
    |*|     :: >>API SERVER FOR QUIZZARD QUEST<< ::
    \*/

    //session_start();
    include 'url.php';
    
    
    /***************************/
    /* CREATE AND DELETE DECKS */
    /***************************/
    /*\
    |*|  Creates a deck by inserting the session's userID
    |*|  and the name of the deck chosen by the user into the 
    |*|  decks table. The table auto-increments a deckID for each
    |*|  deck. It returns the deckID.
    \*/
    function create_deck($deckname) {

        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        $userID = $_SESSION['userID'];
        $query = "INSERT INTO decks (userID, name) VALUES ('$userID', '$deckname');";
        if (!mysqli_query($db, $query))
        {
            echo "There was an error creating your deck. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
        }
        
        $deckID = mysqli_query($db,"SELECT deckID FROM decks WHERE (userID = '$userID' AND name = '$deckname');");
	     $idRow = mysqli_fetch_assoc($deckID);
        $id = intval($idRow['deckID'],10);
      
        mysqli_close($db);
        return $id;
    }
    
    
    /*\
    |*|  Deletes a deck given the deckID. Because of the way that primary keys
    |*|  are arranged, this will also get rid of any entry of that deck in any
    |*|  other table, which makes things much easier.
    |*|
    \*/
    function delete_deck($deckID) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        //This also deletes every tuple with this deckID in deckCards, which is awesome
        $query = "DELETE FROM decks WHERE deckID = '$deckID';";
        if (!mysqli_query($db, $query)){
            echo "There was an error deleting your deck. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
        }
        mysqli_close($db);
    }    
      
    /***************/
    /* EDIT A DECK */
    /***************/
    /*\
    |*|  Adds a card to a deck by inserting the deckID and cardID into the deckCards
    |*|  table. This table is a relational table between cards and deck since it is 
    |*|  a many to many relationship between the two. deckCards also autoincrements
    |*|  the ID for each tuple of deckID and cardID.
    \*/
    function add_card_to_deck($deckID, $cardID) {
         $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
         }
        
         $query = "INSERT INTO deckCards (deckID, cardID) VALUES ('$deckID', '$cardID');";        
         if (!mysqli_query($db, $query)) {
            echo "There was an error adding a card to your deck. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
         }
         mysqli_close($db);
    }
    
    /*\
    |*|  Deletes a card from the deck given the deckID and cardID, by deleting 
    |*|  the tuple in deckCards. Since these are foreign keys, the parent 
    |*|  values will not be affected, nor should any other instance of foreign 
    |*|  keys to those parent values.
    \*/    
    function delete_card_from_deck($deckID, $cardID) {
         $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
         }
         
         $query = "DELETE FROM deckCards WHERE deckID = '$deckID' AND cardID = '$cardID';";
         if (!mysqli_query($db, $query)) {
            echo "There was an error deleting a card from your deck. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
         }
         mysqli_close($db);
    }
    
   
    /*******************/
    /* CREATING A USER */
    /*******************/
    /*\
    |*|  This first makes sure that a username is not already present inside of the
    |*|  database. It then checks to see if an email is already present. If both of
    |*|  those checks are passed, the password the user entered is hashed, and then 
    |*|  the hashed password, the salt for the password, and all the other info
    |*|  the user entered is input into the database. Following that, an entry
    |*|  inside all the related tables (achievements, options, stats) is created
    |*|  for the user. If at any point these entries fail, then the user is deleted
    |*|  from the database so that an email and username aren't taken by a failed
    |*|  user creation.
    \*/
    function create_user($firstname, $lastname, $email, $username, $password, $questionID, $answer, $gender = NULL, $grade = NULL, $isAdmin = 0) {

        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        /*make sure user isn't already in the database*/
        $query = "SELECT * FROM players WHERE (username = '$username');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error checking to see if your username already exists. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
        }
        $result = mysqli_query($db,$query);

        if (mysqli_num_rows($result) != 0) {
    	    # header('Location: http://'.url.'/Quizard-Quest/Website/Error.php?err=100');
    	    # echo 'ERROR: That username is already in use';
            $u = "username";
            return $u;
        }
        
        /*make sure email isn't already in the database*/
        $query = "SELECT * FROM players WHERE (email = '$email');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error checking to see if your email already exists. 
            \nPlease return to the previous page.
		      \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
        }
        $result = mysqli_query($db,$query);

        if (mysqli_num_rows($result) != 0) {
    	    // header('Location: http://'.url.'/Quizard-Quest/Website/Error.php?err=101');
    	    // echo 'ERROR: That email is already in use';
            $e = "email";
            return $e;
        }
        // if (mysqli_num_rows($correct_hash) == 0) {
        //     //$authenticated = false;
        //     return false;
        // }

        $salt = create_salt();
        $password = create_hash_with_salt($password, $salt);
        
        $query = "INSERT INTO players (username, password, salt, email, fName, lName, gender, grade, permissions) VALUES ('$username', '$password', '$salt', '$email', '$firstname', '$lastname', '$gender', '$grade', '$isAdmin');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error adding your username to our database. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
        }
        
        $select = mysqli_query($db, "SELECT userID FROM players WHERE players.username = '$username';");
        $result = mysqli_fetch_assoc($select);
        $userID = intval($result['userID'],10);
        
        // If any of the following queries fail, it deletes the entry from the players table
        // so as not to cause subsequent retries from failing because of reusing username
        // and/or email.
        $query = "INSERT INTO options (userID) VALUES ('$userID');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error creating your options. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            $error = mysqli_error($db);
            mysqli_query($db, "DELETE FROM players WHERE userID = '$userID';");
            die('Error: ' . $error);
        }
        
        $query = "INSERT INTO achievements (userID) VALUES ('$userID');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error creating your achievements. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            $error = mysqli_error($db);
            mysqli_query($db, "DELETE FROM players WHERE userID = '$userID';");
            die('Error: ' . $error);
        }
        
        $query = "INSERT INTO stats (userID) VALUES ('$userID');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error creating your stats.
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            $error = mysqli_error($db);
            mysqli_query($db, "DELETE FROM players WHERE userID = '$userID';");
            die('Error: ' . $error);
        }
        
        $query = "INSERT INTO securityQuestions (userID, questionID, answer) VALUES ('$userID', '$questionID', '$answer');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error storing your security question. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            $error = mysqli_error($db);
            mysqli_query($db, "DELETE FROM players WHERE userID = '$userID';");
            die('Error: ' . $error);
        }

        if(!isset($_SESSION)) { 
	       session_start(); 
	    } 
        $_SESSION ['userID'] = $userID;
        $_SESSION ['timeout'] = time();

        mysqli_close($db);
        return true;
    }
    
    function get_userID($username) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        $userIDList = mysqli_query($db, "SELECT userID FROM players WHERE username = '$username';");
        
        return mysqli_fetch_assoc($userIDList);
    
    /****************************/
    /* CREATING/DELETING A CARD */
    /****************************/
    /*\
    |*|  Adds a card to the cards table given the various items necessary
    |*|  for a card to exist. 
    \*/
    function create_card($question, $answer, $category, $subCategory = null, $difficulty) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $userID = $_SESSION['userID'];
        
        $query = "INSERT INTO cards(userID, question, answer, category, subCategory, difficulty) VALUES ('$userID', '$question', '$answer', '$category', '$subCategory', '$difficulty');";

        if (!mysqli_query($db, $query)) {
            echo "There was an error creating your card. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
        }
        mysqli_close($db);
        
    }
    
    /*\
    |*|  Deletes a card from the cards table in a similar manner that decks are
    |*|  deleted. This ensures that cards that when cards are deleted, then
    |*|  entries in deckCards are also deleted, since that card can no longer
    |*|  exist in various decks.
    \*/
    function delete_card($cardID) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        // Also deletes the tuple of deck and card in deckCards if it exists.
        $query = "DELETE FROM cards WHERE cardID = '$cardID';";
        if (!mysqli_query($db, $query)) {
            echo "There was an error deleting your card. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
        }
        mysqli_close($db);
    }
    
    
    /********************/
    /* RETRIEVING CARDS */
    /********************/
    /*\
    |*|  Retrieves all cards that a user has created. The specific user is 
    |*|  determined by the session's userID value. This is mainly used
    |*|  when a user is creating a deck so that they can choose from all
    |*|  the cards they've created.
    \*/
    function get_all_cards() {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $table = array();
        $userID = $_SESSION['userID'];
        
        $cards = mysqli_query($db, "SELECT * FROM cards WHERE userID = '$userID';");
        $x = mysqli_num_rows($cards);
        for ($i = 0; $i < $x; $i++) {
            array_push($table, mysqli_fetch_assoc($cards));
        }
        return $table;
        mysqli_close($db);
    }
    
    /*\
    |*|  Retrieves all the names and deckIDs of the decks that a given user 
    |*|  has. The user is determined through session. This function is
    |*|  mainly used for when a user wants to review a deck, and needs to 
    |*|  choose one to look at.
    \*/
    function get_deck_names() {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $table = array();
        $userID = $_SESSION['userID'];
        $decks = mysqli_query($db, "SELECT deckID, name FROM decks WHERE userID = '$userID';");
        $x = mysqli_num_rows($decks);
        for ($i = 0; $i < $x; $i++) {
            array_push($table, mysqli_fetch_assoc($decks));
        }
        return $table;
        mysqli_close($db);
    }
    
    /*\
    |*|  Similar to get_all_cards, except that it only returns cards from a
    |*|  specific user that have a specific category specified by the user.
    |*|  Mainly used for when a user is creating a deck so as to expedite
    |*|  the process.
    \*/
    function get_category_cards($category) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $table = array();
        $userID = $_SESSION['userID'];
        
        $cards = mysqli_query($db, "SELECT DISTINCT * FROM cards WHERE userID = '$userID' AND category = '$category';");
        $x = mysqli_num_rows($cards);
        for ($i = 0; $i < $x; $i++) {
            array_push($table, mysqli_fetch_assoc($cards));
        }
        return $table;
        mysqli_close($db);
    }
    
    /*\
    |*|  Retrieves all the cards in a specific deck by joining cards and deckCards
    |*|  and looking for where the deckID's match up. This function will be used
    |*|  the most, as it will be needed for a player to play the game and to 
    |*|  review the cards in a deck.
    \*/
    function get_deck_cards($deckID) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $table = array();
        $userID = $_SESSION['userID'];
        
        $cards = mysqli_query($db, "SELECT DISTINCT cards.* FROM cards JOIN deckCards ON cards.cardID = deckCards.cardID WHERE deckCards.deckID = '$deckID';");
        $x = mysqli_num_rows($cards);
        for ($i = 0; $i < $x; $i++) {
            array_push($table, mysqli_fetch_assoc($cards));
        }
        return $table;
        mysqli_close($db);
   }
   
    /*\
    |*|  This retrieves all the cards a user has created that are specifically
    |*|  NOT in the specified deck. This will be used for adding cards to a
    |*|  deck. The reason the query seems so complicated is because cards can
    |*|  be in multiple decks, so it requires a NOT IN and not a simple WHERE
    |*|  deckID != '$deckID'.
    \*/
   function get_non_deck_cards($deckID) {
       $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $table = array();
        $userID = $_SESSION['userID'];
        
        $deckCards = mysqli_query($db, "SELECT DISTINCT cards.* FROM cards WHERE userID = '$userID' AND (cards.cardID NOT IN (SELECT DISTINCT cards.cardID FROM cards JOIN deckCards ON cards.cardID = deckCards.cardID WHERE deckCards.deckID = '$deckID'));");
        $x = mysqli_num_rows($deckCards);
        for ($i = 0; $i < $x; $i++) {
            array_push($table, mysqli_fetch_assoc($deckCards));
        }
        return $table;
        mysqli_close($db);
   }
   
   /********************************/
   /* RETRIEVING/EDITING USER DATA */
   /********************************/
    /*\
    |*|  Retrieves the options that were set by a user. Each user has a single
    |*|  tuple for each entry, so there is no need to have an array.
    \*/
    function get_options() {
	     $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $userID = $_SESSION['userID'];
        $cards = mysqli_query($db, "SELECT * FROM options WHERE userID = '$userID');");
        $result = mysqli_fetch_assoc($cards);
        echo json_encode($result);
        mysqli_close($db);
    }
    
    /*\
    |*|  Retrieves the achievements a player has. Similar to get_options()
    \*/
    function get_achievements() {
	     $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $userID = $_SESSION['userID'];
        $cards = mysqli_query($db, "SELECT * FROM achievements WHERE userID = '$userID');");
        $result = mysqli_fetch_assoc($cards);
        echo json_encode($result);
        mysqli_close($db);
    }
    
    /*\
    |*|  Retreives the stats that a user has acquired. Similar to get_options()
    \*/
    function get_stats() {
	     $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $userID = $_SESSION['userID'];
        $cards = mysqli_query($db, "SELECT * FROM stats WHERE userID = '$userID');");
        $result = mysqli_fetch_assoc($cards);
        echo json_encode($result);
        mysqli_close($db);
    }
    
    function set_options($avatar, $cardBoarder, $bgColor){
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $userID = $_SESSION['userID'];
        
        // This will update all the values. Not all values have to change, since any of the
        // parameters will show their original value if they are not changed. This reduces the
        // number of different functions that have to be called or made. 
        $query = "UPDATE options SET avatar = '$avatar', cardBoarder = '$cardBoarder', bgColor = '$bgColor' WHERE userID = '$userID';";
        if (!mysqli_query($db, $query)) {
            echo "There was an error updating your options. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
        }
        mysqli_close($db);
    }
    
    function set_stats() {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $mathExp = $_SESSION['mathExp'];
        $sciExp = $_SESSION['sciExp'];
        $ssExp = $_SESSION['ssExp'];
        $engExp = $_SESSION['engExp'];
        $langExp = $_SESSION['langExp'];
        $totExp = $_SESSION['totExp'];
        $gold = $_SESSION['gold'];
        $userID = $_SESSION['userID'];
        
        // Same as set_options, not all of the values have to be changed, but because we don't 
        // know which ones will be necessarily, this will cover all of our bases with one function
        // call
        $query = "UPDATE stats SET mathExp = '$mathExp', sciExp = '$sciExp', ssExp = '$ssExp', engExp = '$engExp', langExp = '$langExp', totExp = '$totExp', gold = '$gold' WHERE userID = '$userID';";
        if (!mysqli_query($db, $query)) {
            echo "There was an error adjusting your stats. 
            \nPlease return to the previous page.
            \nHere's the error if you wanted to tell a developer:\n";
            die('Error: ' . mysqli_error($db));
        }
        mysqli_close($db);   
    }

    function check_security_answer($guess) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $userID = $_SESSION['userID'];
        $value = mysqli_query($db, "SELECT answer FROM securityQuestions WHERE userID = '$userID';");
        $answer = mysqli_fetch_assoc($value);
        
        if($answer['answer'] == $guess) {
            return true;
        }
        else {
            return false;
        }
        mysqli_close($db);
    }   
    
    /*\
    |*|     :: >>The following is the password salting and hashing functions we found<< ::
    |*|                    #   on https://crackstation.net/hashing-security.htm
    |*|                    #   Password hashing with PBKDF2.
    |*|                    #   Author: havoc AT defuse.ca
    |*|                    #   www: https://defuse.ca/php-pbkdf2.htm
    |*| 
    \*/

    // These constants may be changed without breaking existing hashes.
    define("PBKDF2_HASH_ALGORITHM", "sha256");
    define("PBKDF2_ITERATIONS", 1000);
    define("PBKDF2_SALT_BYTE_SIZE", 24);
    define("PBKDF2_HASH_BYTE_SIZE", 24);

    define("HASH_SECTIONS", 4);
    define("HASH_ALGORITHM_INDEX", 0);
    define("HASH_ITERATION_INDEX", 1);
    define("HASH_SALT_INDEX", 2);
    define("HASH_PBKDF2_INDEX", 3);

    function create_hash($password) {
        // format: algorithm:iterations:salt:hash
        $salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
        return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  $salt . ":" .
            base64_encode(pbkdf2(
                PBKDF2_HASH_ALGORITHM,
                $password,
                $salt,
                PBKDF2_ITERATIONS,
                PBKDF2_HASH_BYTE_SIZE,
                true
            ));
    }

    function create_salt() {
       $salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
       return $salt;
    }
    
    //A function that creates a hash using an input salt. This method is so we can store it in the database beforehand.
    function create_hash_with_salt($password, $salt) {
        // format: algorithm:iterations:salt:hash
        return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  $salt . ":" .
            base64_encode(pbkdf2(
                PBKDF2_HASH_ALGORITHM,
                $password,
                $salt,
                PBKDF2_ITERATIONS,
                PBKDF2_HASH_BYTE_SIZE,
                true
            ));
    }

    //Covered by unit test
    function validate_password($username, $password) {

        $authenticated = true;

        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
      
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }

        $correct_hash = mysqli_query($db,"SELECT password,userID FROM players WHERE (username = '$username');");

        if (mysqli_num_rows($correct_hash) == 0) {
            //$authenticated = false;
            return false;
        }

        $row_chash = mysqli_fetch_assoc($correct_hash);

        $hash_string = $row_chash['password'];
        $userID = intval($row_chash['userID'],10);

        $params = explode(":", $hash_string);
        if(count($params) < HASH_SECTIONS) {
            mysqli_close($db);
            return false;
        }
        
        if ($authenticated) {

            $pbkdf2 = base64_decode($params[HASH_PBKDF2_INDEX]);
            $authenticated = slow_equals(
                $pbkdf2,
                pbkdf2(
                    $params[HASH_ALGORITHM_INDEX],
                    $password,
                    $params[HASH_SALT_INDEX],
                    (int)$params[HASH_ITERATION_INDEX],
                    strlen($pbkdf2),
                    true
                )
            );
        }  
        //if (isset($_SESSION)) 
        //{
        session_destroy();
        //}
        //if(!isset($_SESSION)) 
	{ 
	    session_start(); 
	} 
        $_SESSION ['userID'] = $userID;
        $_SESSION ['timeout'] = time();

        mysqli_close($db);

        return $authenticated;

    }

    // Compares two strings $a and $b in length-constant time.
    function slow_equals($a, $b)  {

        $diff = strlen($a) ^ strlen($b);
        for($i = 0; $i < strlen($a) && $i < strlen($b); $i++) {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $diff === 0;
    }

    /*\
    |*| 
    |*| :: >>PBKDF2 key derivation function as defined by RSA's PKCS #5: https://www.ietf.org/rfc/rfc2898.txt<< ::
    |*|                 #   $algorithm - The hash algorithm to use. Recommended: SHA256
    |*|                 #   $password - The password.
    |*|                 #   $salt - A salt that is unique to the password.
    |*|                 #   $count - Iteration count. Higher is better, but slower. Recommended: At least 1000.
    |*|                 #   $key_length - The length of the derived key in bytes.
    |*|                 #   $raw_output - If true, the key is returned in raw binary format. Hex encoded otherwise.
    |*|                 #      Returns: A $key_length-byte key derived from the password and salt.
    |*| 
    |*|                 :: Test vectors can be found here: https://www.ietf.org/rfc/rfc6070.txt ::
    |*| 
    |*|                 #   This implementation of PBKDF2 was originally created by https://defuse.ca
    |*|                 #   With improvements by http://www.variations-of-shadow.com
    |*| 
    \*/
    function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false) {

        $algorithm = strtolower($algorithm);
        if(!in_array($algorithm, hash_algos(), true))
            die('PBKDF2 ERROR: Invalid hash algorithm.');
        if($count <= 0 || $key_length <= 0)
            die('PBKDF2 ERROR: Invalid parameters.');

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for($i = 1; $i <= $block_count; $i++) {
            // $i encoded as 4 bytes, big endian.
            $last = $salt . pack("N", $i);
            // first iteration
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            // perform the other $count - 1 iterations
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if($raw_output)
            return substr($output, 0, $key_length);
        else
            return bin2hex(substr($output, 0, $key_length));
    }
?>
