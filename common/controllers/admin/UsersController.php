<?php

class UsersController extends Controller
{

    public function index() {
        $data =array();
        
        $usersCollection = new UsersCollection();
        $users = $usersCollection->get();
        
        $data['users'] = $users;
        
        $this->loadView('users/list.php', $data);
    }
}