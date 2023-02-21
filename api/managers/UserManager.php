<?php

class UserManager extends AbstractManager {

    public function getAllUsers() : array
    {
        // get all the users from the database
            $query = $this->db->prepare("SELECT * FROM users");
            $query->execute([]);
            $users = $query->fetchAll(PDO::FETCH_ASSOC);
          
            foreach ($users as $user)
            {
                $newuser= new User ($user["id"],$user["username"],$user["first_name"],$user["last_name"],$user["email"]);
                $newuser->setId($user["id"]);
                $return[]=$newuser;
                
            }
            return $return;
    }

    public function getUserById(int $id) : User
    {
        // get the user with $id from the database
        $query = $this->db->prepare("SELECT * FROM users WHERE id=:id");
        $parameters = [
            'id'=>$id
        ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $return = new User ($user["id"],$user["username"],$user["first_name"],$user["last_name"],$user["email"]);
        $return->setId($user["id"]);
        return $return;
        
    }

    public function createUser(User $user) : User
    {
        // create the user from the database

        // return it with its id
    
        $query = $this->db->prepare('INSERT INTO users VALUES (null, :value1, :value2, :value3, :value4)');
        $parameter = [
        'value1' => $user->getUsername(),
        'value2' => $user->getFirstName(),
        'value3' => $user->getLastName(),
        'value4' => $user->getEmail()
        ];
        $query->execute($parameter);
        
        $query = $this->db->prepare("SELECT * FROM users WHERE id=:value");
        $parameters = ['value' => $user->getId()];
        $query->execute($parameters);
        $users = $query->fetch(PDO::FETCH_ASSOC);
        $UserToReturn = new User ($users["id"],$users["username"],$users["first_name"],$users["last_name"],$users["email"]);
        $UserToReturn->setId($users["id"]);
        return $UserToReturn ;
    
    }

    public function updateUser(User $user) : User
    {
        // update the user in the database

        // return it
        $query = $this->db->prepare("UPDATE users SET username=:username, first_name=:first_name , last_name=:last_name, 
        email=:email WHERE users.id=:id");
        $parameters = [
            'id'=>$user->getId(),
            'email'=>$user->getEmail(),
            'username'=>$user->getUsername(),
            'password'=>$user->getFirstName(),
            'last_name'=>$user->getLastName()
        ];
        $query->execute($parameters);
    }



    public function deleteUser(User $user) : array
    {
        // delete the user from the database

        // return the full list of users
     
    $query = $this->db->prepare("DELETE FROM users WHERE users.id=:id");
    $parameters = [
        'id'=>$user->getId()
    ];
    $query->execute($parameters);
    // get all users
    $query = $this->db->prepare("SELECT * FROM users");
            $query->execute([]);
            $users = $query->fetchAll(PDO::FETCH_ASSOC);
          
            foreach ($users as $user)
            {
                $newuser= new User ($user["id"],$user["username"],$user["first_name"],$user["last_name"],$user["email"]);
                $newuser->setId($user["id"]);
                $return[]=$newuser;
                
            }
            return $return;
    }
}