<?php 
declare(strict_types=1);

class Users {
    public int $id;
    public string $name;
    public string $email;
    public string $phone;
    public string $date;
    public string $address;
    public string $location;
    public bool $isAdmin;

    public function __construct(int $id, string $name, string $email, string $phone, string $date, string $address, string $location, bool $isAdmin) {
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
        $stmt->execute([$this->name, $this->email, $password, $displayDate]);
    }

    public static function getUsersWithPassword( string $email, string $password): ?Users {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT userId, username, email, phoneNumber, hashedPassword, creationDate, address, locationID, isAdmin FROM USERS WHERE LOWER(email) = ?');
        $stmt->execute([strtolower($email)]);
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['hashedPassword'])) {
            return new Users(
                $user['userId'],
                $user['username'],
                $user['email'],
                $user['phoneNumber'],
                $user['creationDate'],
                $user['address'],
                $user['locationID'],
                $user['isAdmin'] == '1' ? true : false
            );
        } else return null;
    }

    public static function getUser(PDO $db, int $id) : ?Users {
        $stmt = $db->prepare('SELECT userId, username, email, phoneNumber, creationDate, address, locationID, isAdmin FROM USERS WHERE userId = ?');
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            return new Users(
                $user['userId'],
                $user['username'],
                $user['email'],
                $user['phoneNumber'],
                $user['creationDate'],
                $user['address'],
                $user['locationID'],
                $user['isAdmin'] == '1' ? true : false
            );
        } else return null;
    }
}
?>
