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

    public function __construct(string $name, string $email, int $id = 0, string $phone = '', string $date = '', string $address = '', int $location = 0, bool $isAdmin = false) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->date = $date;
        $this->address = $address;
        $this->location = $location;
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
            SELECT userID, username, email, phoneNumber, hashedPassword, creationDate, address, locationID, isAdmin 
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
                $phoneNumber,
                $user['creationDate'],
                $address,
                $locationID,
                $user['isAdmin'] == '1' ? true : false
            );
        } else return null;
    }

    public static function getUser(PDO $db, $id) : array {
        $stmt = $db->prepare('
            SELECT userID, username, email, phoneNumber, creationDate, address, locationID, isAdmin 
            FROM USERS 
            WHERE userID = ?
        ');
        
        $stmt->execute(array($id));

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
}
?>
