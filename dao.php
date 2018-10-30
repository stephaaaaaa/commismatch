<?php
    require_once("./config.php");

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

        public function addUser($firstname, $lastname, $username, $birthday, $gender, $acceptingCommissions, $city, $country, $email, $password)
        {
            $user = $this->getUser($username); // check if there is already a user
            if(!$user){
                $connection = $this->getConnection();
                $query = "INSERT INTO SiteUser(firstName, lastName, handle, birthday, gender, acceptingCommissions, city, country, email, password)
                            VALUES (:firstName, :lastName, :handle, :birthday, :gender, :acceptingCommissions, :city, :country, :email, :password)";
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
                // $statement->bindParam(":password", $password);
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

        public function getUserInfo($handle)
        {
            $connection = $this->getConnection();
            $statement = $connection->prepare("SELECT userID FROM SiteUser WHERE handle = :handle");
            $statement->bindParam(":handle", $handle);
            $statement->execute();
            return $statement->fetch();
        }
    }

?>