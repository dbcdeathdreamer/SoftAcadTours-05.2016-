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

}