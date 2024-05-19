<?php 
declare(strict_types=1);

class Users {
    public int $id;
    public string $name;
    public string $email;
    public string $phone;
    public string $date;
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

    public function save(PDO $db, string $password): bool {
        $date = new DateTime('now');
        $displayDate = $date->format('Y-m-d');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare('INSERT INTO USERS (username, email, hashedPassword, creationDate) VALUES (?,?,?,?) ');
        return $stmt->execute([$this->name, $this->email, $hashedPassword, $displayDate]);
    }

    public static function getUsersWithPassword(string $email, string $password): ?Users {
        $db = getDatabaseConnection();
        $stmt = $db->prepare('
            SELECT userID, username, email, hashedPassword, creationDate, isAdmin 
            FROM USERS 
            WHERE lower(email) = ?
        ');

        $stmt->execute([strtolower($email)]);
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['hashedPassword'])) {

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

    public static function getUser(PDO $db, int $id): array {

        $stmt = $db->prepare('SELECT userID, username, email, creationDate, isAdmin FROM USERS WHERE userID = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserByEmail(PDO $db, string $email): ?array {
    $stmt = $db->prepare('SELECT userID, username, email, creationDate, hashedPassword, isAdmin FROM USERS WHERE email = ?');
    $stmt->execute([$email]);

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userData === false) {
        return null;
    }

    return $userData;
}


    public static function isEmailAvailable(PDO $db, string $newEmail): bool {

        $stmt = $db->prepare('SELECT COUNT(*) FROM USERS WHERE email = ?');
        $stmt->execute([$newEmail]);
        return $stmt->fetchColumn() == 0;
    }

    public static function updateUserEmail(PDO $db, int $id, string $newEmail): bool {

        try {
            $stmt = $db->prepare('UPDATE USERS SET email = ? WHERE userID = ?');
            return $stmt->execute([$newEmail, $id]);
        } catch (PDOException $e) {
            // Log the error
            error_log('Failed to update email: ' . $e->getMessage());
            return false;
        }
    }

    public static function isUsernameAvailable(PDO $db, string $newUsername): bool {

        $stmt = $db->prepare('SELECT COUNT(*) FROM USERS WHERE username = ?');
        $stmt->execute([$newUsername]);
        return $stmt->fetchColumn() == 0;
    }

    public static function updateUserName(PDO $db, int $id, string $newUsername): bool {
        try {
            $stmt = $db->prepare('UPDATE USERS SET username = ? WHERE userID = ?');
            return $stmt->execute([$newUsername, $id]);
        } catch (PDOException $e) {
            // Log the error
            error_log('Failed to update username: ' . $e->getMessage());
            return false;
        }
    }

    public static function updateUserPassword(PDO $db, int $id, string $newPassword): bool {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $db->prepare('UPDATE USERS SET hashedPassword = ? WHERE userID = ?');
            return $stmt->execute([$hashedPassword, $id]);
        } catch (PDOException $e) {
            // Log the error
            error_log('Failed to update password: ' . $e->getMessage());
            return false;
        }
    }

    public static function removeUser(PDO $db, string $name): bool {
        $stmt = $db->prepare('DELETE FROM USERS WHERE isAdmin = 0 AND username = ?');
        return $stmt->execute([$name]);
    }

    public static function makeAdmin(PDO $db, string $name): bool {
        $stmt = $db->prepare('UPDATE USERS SET isAdmin = 1 WHERE username = ?');
        return $stmt->execute([$name]);
    }

    public static function removeAdmin(PDO $db, string $name): bool {
        $stmt = $db->prepare('UPDATE USERS SET isAdmin = 0 WHERE username = ?');
        return $stmt->execute([$name]);
    }

    public static function verifyUserPassword(PDO $db, string $email, string $password): bool {
        $stmt = $db->prepare('SELECT hashedPassword FROM USERS WHERE lower(email) = ?');
        $stmt->execute([strtolower($email)]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user && password_verify($password, $user['hashedPassword']);
    }
}
?>
