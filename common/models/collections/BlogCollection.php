<?php

class BlogCollection extends Collection
{
    protected $table = 'blog';
    protected $entity = 'BlogEntity';

    public function save(Entity $entity)
    {
        // array() = [];
        $data = array(
            'image' => $entity->getImage(),
            'description' =>$entity->getDescription(),
            'name'        => $entity->getName(),
            'user_id'     => $entity->getUserId(),
        );

        if ($entity->getId() != null) {
            $this->update($entity->getId(), $data);
        } else {
            $date = date('Y-m-d H:i:s');
            $data['created_at'] = $date;
            $this->insert($data);
        }

    }

    public function getLast3Posts()
    {
        $sql = "SELECT * FROM {$this->table} Order by id DESC LIMIT 3";
        $result = $this->db->query($sql);

        if (is_null(mysqli_num_rows($result))) {
            $this->db->error();
        }

        $array = array();
        while ($row = $this->db->translate($result)) {
            $entity = new $this->entity();
            $entity->init($row);

            $array[] = $entity;
        }

        return $array;
    }

}