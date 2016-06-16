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

    public function getUser($where = array())
    {
        $sql = "SELECT * FROM {$this->table}";
        if (!empty($where)) {
            $sql.= " WHERE 1 ";
            foreach ($where as $key => $value) {
                $sql.= " AND  {$key} = '{$value}' ";
            }
        }

        $result = $this->db->query($sql);

        if (is_null(mysqli_num_rows($result))) {
            $this->db->error();
        }

        $entity = new $this->entity();
        $entity->init($this->db->translate($result));

        if (is_null($entity)) {
            return null;
        }

        return $entity;
    }
}