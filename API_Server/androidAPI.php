<?
    function get_userID($username) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        
        $userIDList = mysqli_query($db, "SELECT userID FROM players WHERE username = '$username';");
        if (mysqli_num_rows($userIDList) == 0)
           return false;
        else
           return mysqli_fetch_assoc($userIDList);
    }
    
    function get_deck_names($userID) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $table = array();
        $decks = mysqli_query($db, "SELECT deckID, name FROM decks WHERE userID = '$userID';");
        $x = mysqli_num_rows($decks);
        for ($i = 0; $i < $x; $i++) {
            array_push($table, mysqli_fetch_assoc($decks));
        }
        return $table;
        mysqli_close($db);   
    }
    
    function get_deck_cards($userID, $deckID) {
        $db = mysqli_connect("localhost", "quizard", "quest", "quizardQuest");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_errno());
            exit();
        }
        $table = array();
        
        $cards = mysqli_query($db, "SELECT DISTINCT cards.* FROM cards JOIN deckCards ON cards.cardID = deckCards.cardID WHERE deckCards.deckID = '$deckID';");
        $x = mysqli_num_rows($cards);
        for ($i = 0; $i < $x; $i++) {
            array_push($table, mysqli_fetch_assoc($cards));
        }
        return $table;
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
