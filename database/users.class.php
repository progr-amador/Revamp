<?php 
declare(strict_types=1);

class Users {
    public int $id;
    public string $name;
    public string $email;
    public string $phone;
    public string $date;
    public string $address;
    public int $location;
    public bool $isAdmin;

    public function __construct(string $name, string $email, int $id = 0, string $date = '', bool $isAdmin = false) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        
        $this->date = $date;
        
        $this->isAdmin = $isAdmin;
    }

    public function getName() : string {
        return $this->name;
    }

    public function save(PDO $db, string $password) {
        $date = new DateTime('now');
        $displayDate = $date->format('Y-m-d');
        $stmt = $db->prepare('INSERT INTO USERS (username, email, hashedPassword, creationDate) VALUES (?,?,?,?) ');
        $stmt->execute([$this->name, $this->email, sha1($password), $displayDate]);
    }

    public static function getUsersWithPassword(string $email, string $password): ?Users {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('
            SELECT userID, username, email, hashedPassword, creationDate, isAdmin 
            FROM USERS 
            WHERE lower(email) = ? AND hashedPassword = ?
        ');
        $stmt->execute(array(strtolower($email), sha1($password)));
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {

            $phoneNumber = $user['phoneNumber'] ?? '';
            $address = $user['address'] ?? '';
            $locationID = $user['locationID'] ?? 0;
            
            return new Users(
                $user['username'],
                $user['email'],
                $user['userID'],
                $user['creationDate'],
                $user['isAdmin'] == '1' ? true : false
            );
        } else return null;
    }

    public static function getUser(PDO $db, $id) : array {
        $stmt = $db->prepare('
            SELECT userID, username, email, creationDate, isAdmin 
            FROM USERS 
            WHERE userID = ?
        ');
        
        $stmt->execute(array($id));

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public static function isEmailAvailable(PDO $db,string $newEmail) : bool {

        $stmt = $db->prepare('SELECT COUNT(*) FROM USERS WHERE email = :email');
        $stmt->bindParam(':email', $newEmail, PDO::PARAM_STR);
        $stmt->execute();
        
        $count = $stmt->fetchColumn();
        
        return $count == 0; 
    }

    public static function updateUserEmail(PDO $db,int $id, string $newEmail) : bool {

        try {
            $stmt = $db->prepare('UPDATE USERS SET email = :newEmail WHERE userID = :userId');
            $stmt->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $id, PDO::PARAM_INT);
            return $stmt->execute(); 
        } catch (PDOException $e) {
            
            return false;
        }
    }

    public static function isUsernameAvailable(PDO $db,string $newUsername) : bool {

        $stmt = $db->prepare('SELECT COUNT(*) FROM USERS WHERE username = :username');
        $stmt->bindParam(':username', $newUsername, PDO::PARAM_STR);
        $stmt->execute();
        
        $count = $stmt->fetchColumn();
        
        return $count == 0;
    }

    public static function updateUserName(PDO $db,int $id, string $newUsername) : bool {

        try {
            $stmt = $db->prepare('UPDATE USERS SET username = :newUsername WHERE userID = :userId');
            $stmt->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $id, PDO::PARAM_INT);
            return $stmt->execute(); 
        } catch (PDOException $e) {
            
            return false;
        }
    }

    public static function updateUserPassword(PDO $db, int $id, string $hashedNewPassword): bool {
        try {
            $stmt = $db->prepare('UPDATE USERS SET hashedPassword = :newPassword WHERE userID = :userId');
            $stmt->bindParam(':newPassword', $hashedNewPassword, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }





    static function removeUser(PDO $db, $name) {
        $stmt = $db->prepare('
          DELETE FROM USERS
          WHERE (isAdmin = 0) and (username = ?)
        ');

        $stmt->execute(array($name));
    }

    static function makeAdmin(PDO $db, $name) {
        $stmt = $db->prepare('
            UPDATE USERS 
            SET isAdmin = 1
            WHERE username = ?;
        ');

        $stmt->execute(array($name));
    }

    static function removeAdmin(PDO $db, $name) {
        $stmt = $db->prepare('
            UPDATE USERS 
            SET isAdmin = 0
            WHERE username = ?;
        ');

        $stmt->execute(array($name));
    }
}
?>
