<?php

class UsersCollection extends Collection
{
    
    protected $table = 'users';
    protected $entity = 'UserEntity';

    public function save(Entity $entity)
    {
        $data = array(
            'username' => $entity->getUsername(),
            'description' => $entity->getDescription(),
            'email'       => $entity->getEmail(),
        );

        if ($entity->getId() != null) {
            $this->update($entity->getId(), $data);
        } else {
            $data['password'] = $entity->getPassword();
            $this->insert($data);
        }
    }
    
}