<?php
    require_once("./config.php");
    date_default_timezone_set('America/Boise');

    class Dao{
        // PDO connection using the cleardb url connection
        private function getConnection()
        {
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $host = $url["host"];
            $db   = substr($url["path"], 1);
            $user = $url["user"];
            $pass = $url["pass"];
            $connection = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
            // Turn on exceptions for debugging. Comment this out for
            // production or make sure to use try-catch statements.
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection; 
        }
        
        // DB connection status string
        public function getConnectionStatus()
        {
            $connection = $this->getConnection();
            return $connection->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));
        }

        public function addUser($firstname, $lastname, $username, $birthday, $gender, $acceptingCommissions, $city, $country, $email, $password, $blank)
        {
            $user = $this->getUser($username); // check if there is already a user
            if(!$user){
                $connection = $this->getConnection();
                $query = "INSERT INTO SiteUser(firstName, lastName, handle, birthday, gender, acceptingCommissions, city, country, email, password, profilePicture)
                            VALUES (:firstName, :lastName, :handle, :birthday, :gender, :acceptingCommissions, :city, :country, :email, :password, :blank)";
                $statement = $connection->prepare($query);
                $statement->bindParam(':firstName', $firstname);
                $statement->bindParam(':lastName', $lastname);
                $statement->bindParam(':handle', $username);
                $statement->bindParam(':birthday', $birthday);
                $statement->bindParam(':gender', $gender);
                $statement->bindParam(':acceptingCommissions', $acceptingCommissions);
                $statement->bindParam(':city', $city);
                $statement->bindParam(':country', $country);
                $statement->bindParam(':email', $email);
                $statement->bindParam(':password', $password);
                $statement->bindParam(':blank', $blank);
 
                try{
                    $statement->execute();
                    return true;
                } catch(PDOException $e){
                    echo $e->getMessage();
                    return false;
                }
            }
            else {
                print("User @$username already exists");
            }
        }

        public function getUser($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT * FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();

            return $statement->fetch();
        }

        public function userExists($handle){
            if($this->getUser($handle)){
                return true;
            }
            return false;
        }

        public function passwordCorrect($handle, $password){
            if($this->userExists($handle)){
                $connection = $this->getConnection();
                $statement = $connection->prepare("SELECT password FROM SiteUser WHERE handle = :handle");
                $statement->bindParam(":handle", $handle);
                $statement->execute();
                $resultsRow = $statement->fetch();

                if(!$resultsRow){ // if the row is nonexistent
                    return false;
                }
                $hashword = $resultsRow['password']; // hashed password

                if($hashword == $password){
                    return true;
                }
            }
            return false;
        }

        public function validateUser($handle, $password)
        {
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT password FROM SiteUser WHERE handle = :handle");
            
            $statement->bindParam(':handle', $handle);
            $statement->execute();
            $row = $statement->fetch();
            if(!$row){
                return false;
            }
            $hashword = $row['password'];
            if($password == $hashword){
                return true;
            }
            return false;
        }

        public function getUserHandle($handle)
        {
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT handle FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            return $statement->fetch();
        }

        public function getUserCity($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT city FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();

            return $row['city'];
        }

        public function getUserCityByID($userID){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT city FROM SiteUser WHERE userID = :userID");
            $statement->bindParam(":userID", $userID);
            $statement->execute();
            $row = $statement->fetch();

            return $row['city'];
        }

        public function getUserCountry($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT country FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();

            return $row['country'];
        }

        public function getUserCountryByID($userID){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT country FROM SiteUser WHERE userID = :userID");
            $statement->bindParam(":userID", $userID);
            $statement->execute();
            $row = $statement->fetch();

            return $row['country'];
        }

        public function getArtistQuote($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT quoteOrBio FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();

            if($row['quoteOrBio'] == ""){
                return "I'm a person of few words!";
            }
            return $row['quoteOrBio'];
        }

        public function getArtistQuoteByID($userID){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT quoteOrBio FROM SiteUser WHERE userID = :userID");
            $statement->bindParam(":userID", $userID);
            $statement->execute();
            $row = $statement->fetch();

            if($row['quoteOrBio'] == ""){
                return "I'm a person of few words!";
            }
            return $row['quoteOrBio'];
        }

        public function editUser($handle, $acceptingCommissions, $city, $country, $quoteOrBio, $email, $password){
            $connection = $this->getConnection();
            $statement = $connection->prepare("UPDATE SiteUser SET acceptingCommissions = :acceptingCommissions, city = :city, 
            country = :country, quoteOrBio = :quoteOrBio, email = :email, password = :password WHERE handle = :handle");
            $statement->bindParam(":acceptingCommissions", $acceptingCommissions);
            $statement->bindParam(":city", $city);
            $statement->bindParam(":country", $country);
            $statement->bindParam(":quoteOrBio", $quoteOrBio);
            $statement->bindParam(":email", $email);
            $statement->bindParam(":password", $password);
            $statement->bindParam(":handle", $handle);
            $statement->execute();
        }

        public function uploadProfilePic($handle, $filepath){
            $connection = $this->getConnection();
            $statement = $connection->prepare("UPDATE SiteUser SET profilePicture = :filepath WHERE handle = :handle");
            $statement->bindParam(":filepath", $filepath);
            $statement->bindParam(":handle", $handle);

            $statement->execute();
        }

        public function getProfilePic($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT profilePicture FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);

            $statement->execute();
            $row = $statement->fetch();
            return $row['profilePicture'];
        }

        public function getProfilePicFromID($userID){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT profilePicture FROM SiteUser WHERE userID = :userID");
            $statement->bindParam(":userID", $userID);

            $statement->execute();
            $row = $statement->fetch();
            return $row['profilePicture'];
        }

        public function getUserIDFromHandle($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT userID FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();
            $userID = $row['userID'];

            return $userID;
        }

        public function uploadPost($handle, $filepath, $caption){
            $connection = $this->getConnection();
            // get the id of the user
            // $statement = $connection->prepare("SELECT userID FROM SiteUser WHERE handle = :handle");
            // $statement->execute();
            // $row = $statement->fetch();
            // $userID = $row['userID'];
            $userID = $this->getUserIDFromHandle($handle);
            // upload to post table
            $today = date("Y/m/d H:i:s");
            $statement = $connection->prepare("INSERT INTO Post VALUES (NULL, :today, :caption, :userID, :filepath)");
            $statement->bindParam(":today", $today);
            $statement->bindParam(":caption", $caption);
            $statement->bindParam(":userID", $userID);
            $statement->bindParam(":filepath", $filepath);
            $statement->execute();
        }

        public function retrievePhotos($handle){
            $connection = $this->getConnection();
            $userID = $this->getUserIDFromHandle($handle);
            $statement = $connection->prepare("SELECT imageFilePath FROM Post WHERE author = :userID ORDER BY datePosted desc");
            $statement->bindParam(":userID", $userID);
            $statement->execute();
            $rowArray = $statement->fetchAll(PDO::FETCH_COLUMN);

            if(!empty($rowArray)){
                foreach($rowArray as $key=>$value){
                    echo "<img src=\"".$value."\">";
                }
            }else{
                echo "<p>No posts to show!</p>";
            }
        }

        public function retrievePhotosByID($userID){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT imageFilePath FROM Post WHERE author = :userID ORDER BY datePosted desc");
            $statement->bindParam(":userID", $userID);
            $statement->execute();
            $rowArray = $statement->fetchAll(PDO::FETCH_COLUMN);

            if(!empty($rowArray)){
                foreach($rowArray as $key=>$value){
                    echo "<img src=\"".$value."\">";
                }
            }else{
                echo "<p>No posts to show!</p>";
            }
        }

        public function getAcceptingStatus($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT acceptingCommissions FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();

            if($row['acceptingCommissions'] == 0){
                return "Currently not accepting commissions";
            }else{
                return "Message me to request a commission!";
            }
        }

        public function getAcceptingStatusFromID($userID){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT acceptingCommissions FROM SiteUser WHERE userID = :userID");
            $statement->bindParam(":userID", $userID);
            $statement->execute();
            $row = $statement->fetch();

            if($row['acceptingCommissions'] == 0){
                return "Currently not accepting commissions";
            }else{
                return "Message me to request a commission!";
            }
        }

        public function getAcceptingStatusAsBool($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT acceptingCommissions FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();
            return $row['acceptingCommissions'];
        }

        public function getCity($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT city FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();
            return $row['city'];
        }

        public function getCountry($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT country FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();
            return $row['country'];
        }

        public function getNote($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT quoteOrBio FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();
            return $row['quoteOrBio'];
        }

        public function getEmail($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT email FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();
            return $row['email'];
        }

        public function getPassword($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT password FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();
            return $row['password'];
        }

        public function getHandleFromID($userID){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT handle FROM SiteUser WHERE userID = :userID");
            $statement->bindParam(":userID", $userID);
            $statement->execute();
            $row = $statement->fetch();
            return $row['handle'];
        }

        public function getLocalUsers($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT city, country FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $row = $statement->fetch();
            $city = $row['city'];
            $country = $row['country'];

            $statement = $connection->prepare("SELECT city, country, profilePicture, userID FROM SiteUser WHERE city = :city AND country = :country AND handle != :handle");
            $statement->bindParam(":city", $city);
            $statement->bindParam(":country", $country);
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            $userArray = $statement->fetchAll(PDO::FETCH_CLASS);

            if(!empty($userArray)){
                foreach($userArray as $key=>$value){
                        $profilePic = $value->profilePicture;
                        $id = $value->userID;
                        echo "<a href=\"user.php?$id\"><img src=\"".$profilePic."\"></a>";
                }
            }else{
                echo "<p>No local users to show!</p>";
            }
        }

        function sendMessage($senderID, $receiverID, $timeStamp, $messageContent){
            $connection = $this->getConnection();
            $statement = $connection->prepare("INSERT INTO message(sentStamp, sender, receiver, messageContent)
            VALUES(:sentStamp, :sender, :receiver, :messageContent)");
            $statement->bindParam(':sentStamp', $timeStamp);
            $statement->bindParam(':sender', $senderID);
            $statement->bindParam(':receiver', $receiverID);
            $statement->bindParam(':messageContent', $messageContent);
            $statement->execute();
        }

        function getIDFromHandle($handle){
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT userID from SiteUser WHERE handle = :handle");
            $statement->bindParam(':handle', $handle);
            $statement->execute();
            $row = $statement->fetch();
            return $row['userID'];
        }
    }
?>