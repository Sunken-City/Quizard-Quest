<?php

    /*\
    |*|     :: >>API SERVER FOR QUIZZARD QUEST<< ::
    \*/

    //session_start();
    
    
    /***************************/
    /* CREATE AND DELETE DECKS */
    /***************************/
    //ISSUES: Doesn't return the deck ID properly (returns 0), and throws warnings.
    function create_deck($deckname) {

        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        $userID = $_SESSION['userID'];
        $query = "INSERT INTO decks (userID, name) VALUES ('$userID', '$deckname');";
        //If the query fails, 
        if (!mysqli_query($db, $query))
        {
            echo "There was an error creating your deck. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            die('Error: ' . mysqli_error($db));
        }
        
        $deckID = mysqli_query($db,"SELECT decks.deckID FROM cards WHERE (userID = '$userID' AND name = '$deckname');");
	     $fetch = mysqli_fetch_array($deckID);
        $idRow = mysqli_fetch_assoc($fetch);
        $id = intval($idRow['decks.deckID'],10);
      
        mysqli_close($db);
        return $id;
    }
    
    function delete_deck($deckID) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        //This also deletes every tuple with this deckID in deckCards, which is awesome
        $query = "DELETE FROM decks WHERE deckID = '$deckID';";
        if (!mysqli_query($db, $query)){
            echo "There was an error deleting your deck. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            die('Error: ' . mysqli_error($db));
        }
        mysqli_close($db);
    }
    
      
    /***************/
    /* EDIT A DECK */
    /***************/
    //It protects from bad values, but not very gracefully.
    function add_card_to_deck($deckID, $cardID) {
         $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
         }
        
         $query = "INSERT INTO deckCards (deckID, cardID) VALUES ('$deckID', '$cardID');";        
         if (!mysqli_query($db, $query)) {
            echo "There was an error adding a card to your deck. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            die('Error: ' . mysqli_error($db));
         }
         mysqli_close($db);
    }
    
    function delete_card_from_deck($deckID, $cardID) {
         $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
         if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
         }
         
         $query = "DELETE FROM deckCards WHERE deckID = '$deckID' AND cardID = '$cardID';";
         if (!mysqli_query($db, $query)) {
            echo "There was an error deleting a card from your deck. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            die('Error: ' . mysqli_error($db));
         }
         mysqli_close($db);
    }
    
   
    /*******************/
    /* CREATING A USER */
    /*******************/
    function create_user($firstname, $lastname, $email, $username, $password, $gender = NULL, $grade = NULL, $isAdmin = 0) {

        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        /*make sure user isn't already in the database*/
        $query = "SELECT * FROM players WHERE (username = '$username');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error checking to see if your username already exists. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            die('Error: ' . mysqli_error($db));
        }
        $result = mysqli_query($db,$query);

        if (!(mysqli_num_rows($result) == 0)) {
            die('The username you entered is already associated with a user.
                 Please return to the previous page and log in with your 
                 password or use a different username.');
            return false;
        }

        $salt = create_salt();
        $password = create_hash_with_salt($password, $salt);
        
        $query = "INSERT INTO players (username, password, salt, email, fName, lName, gender, grade, permissions) VALUES ('$username', '$password', '$salt', '$email', '$firstname', '$lastname', '$gender', '$grade', '$isAdmin');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error adding your username to our database. Please return to the previous page.
            Here's the error if you wanted to know:\n";
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
            echo "There was an error creating your options. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            mysqli_query($db, "DELETE FROM players WHERE userID = '$userID';");
            die('Error: ' . mysqli_error($db));
        }
        
        $query = "INSERT INTO achievements (userID) VALUES ('$userID');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error creating your achievements. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            mysqli_query($db, "DELETE FROM players WHERE userID = '$userID';");
            die('Error: ' . mysqli_error($db));
        }
        
        $query = "INSERT INTO stats (userID) VALUES ('$userID');";
        if (!mysqli_query($db, $query)) {
            echo "There was an error creating your stats. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            mysqli_query($db, "DELETE FROM players WHERE userID = '$userID';");
            die('Error: ' . mysqli_error($db));
        }

        if(!isset($_SESSION)) { 
	       session_start(); 
	    } 
        $_SESSION ['userID'] = $userID;

        mysqli_close($db);
        return true;
    }
    
    
    /****************************/
    /* CREATING/DELETING A CARD */
    /****************************/
    function create_card($question, $answer, $category, $subCategory = null, $difficulty) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $userID = $_SESSION['userID'];
        
        $query = "INSERT INTO cards(userID, question, answer, category, subCategory, difficulty) VALUES ('$userID', '$question', '$answer', '$category', '$subCategory', '$difficulty');";

        if (!mysqli_query($db, $query)) {
            echo "There was an error creating your card. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            die('Error: ' . mysqli_error($db));
        }
        mysqli_close($db);
        
    }
    
    function delete_card($cardID) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        // Also deletes the tuple of deck and card in deckCards if it exists.
        $query = "DELETE FROM cards WHERE cardID = '$cardID';";
        if (!mysqli_query($db, $query)) {
            echo "There was an error deleting your card. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            die('Error: ' . mysqli_error($db));
        }
        mysqli_close($db);
    }
    
    
    /********************/
    /* RETRIEVING CARDS */
    /********************/
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
        echo json_encode($table);
        mysqli_close($db);
    }
    
    //ISSUES: Another Warning with the fetch_assoc. Doesn't return anything because of it.
    function get_category_cards($category) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $table = array();
        $userID = $_SESSION['userID'];
        
        $cards = mysqli_query($db, "SELECT * FROM cards WHERE userID = '$userID' AND category = '$category';");
        $x = mysqli_num_rows($cards);
        for ($i = 0; $i < $x; $i++) {
            array_push($table, mysqli_fetch_assoc($cards));
        }
        echo json_encode($table);
        mysqli_close($db);
    }
   
   
   /********************************/
   /* RETRIEVING/EDITING USER DATA */
   /********************************/
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
        $query = "UPDATE options SET avatar = '$avatar', cardBoarder = '$cardBoarder', bgColor = '$bgColor' WHERE userID = '$userID';"
        if (!mysqli_query($db, $query)) {
            echo "There was an error updating your options. Please return to the previous page.
            Here's the error if you wanted to know:\n";
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
            echo "There was an error adjusting your stats. Please return to the previous page.
            Here's the error if you wanted to know:\n";
            die('Error: ' . mysqli_error($db));
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
