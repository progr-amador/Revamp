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
        public boolean $isAdmin;  //confirmar

        public function __construct(int $id, string $name, string $email, string $phone, string $date, string $address, string $location, boolean $isAdmin){
            this->id =$id;
            this->name =$name;
            this->email =$email;
            this->phone =$phone;
            this->date =$date;
            this->address =$address;
            this->location =$location;
            this->isAdmin =$isAdmin;
        }

        function name(){
            return this->name;
        }

        function save($db) {
            $stmt = $db->prepare('
            UPDATE USERS SET username = ?
            WHERE userID = ?');

            $stmt->execute(array($this->name,this->id));
        }

    }
?>