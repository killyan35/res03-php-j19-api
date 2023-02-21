<?php

class UserController extends AbstractController {
    private UserManager $um;

    public function __construct()
    {
        $this->um = new UserManager();
    }

    public function getUsers()
    {
        // get all the users from the manager

        // render
        $Users=$this->um->getAllUsers();
        $tab = [];
        foreach($Users as $users)
        {
            $tab[]= $users->toArray();
        }
        $this->render($tab);
        
    }
    public function getUser(string $get)
    {
        // get the user from the manager
        // either by email or by id
        // render
        $id= intval($get);
        $tab = [];
        $user=$this->um->getUserById($id);
        $tab[] = $user->toArray();
        $this->render($tab);
        var_dump($tab);
    }

    public function createUser(array $post)
    {
        // create the user in the manager

        // render the created user
        $tab = []; 
        $userToAdd = new User ($post["id"],$post["username"],$post["first_name"],$post["last_name"],$post["email"]);
        $newuser=$this->um->createUser($userToAdd);
        $tab[]=$newuser->toArray();
        $this->render($tab);
        var_dump($tab);
    }

    public function updateUser(array $post)
    {
        // update the user in the manager

        // render the updated user
        $tab = []; 
        $userToUpdate = new User ($post["id"],$post["username"],$post["first_name"],$post["last_name"],$post["email"]);
        $UpdateUser=$this->um->createUser($userToUpdate);
        $tab[]=$UpdateUser->toArray();
        $this->render($tab);
        var_dump($tab);
    }

    public function deleteUser(array $post)
    {
        // delete the user in the manager

        // render the list of all users
        $tab = [];
        $userToDelete = new User ($post["id"],$post["username"],$post["first_name"],$post["last_name"],$post["email"]);
        $DeleteUser=$this->um->deleteUser($userToDelete);
        $tab[]=$DeleteUser->toArray();
        $this->render($tab);
        var_dump($tab);
    }
}