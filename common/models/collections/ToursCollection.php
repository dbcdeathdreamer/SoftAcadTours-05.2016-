<?php

class ToursCollection extends Collection
{
    protected $table = 'tours';
    protected $entity = 'TourEntity';

    public function get($where = array(), $limit = -1, $offset = 0, $like = '', $orderBy = array())
    {
        $sql = "
            SELECT
              t.*,
              c.name as category_name
            FROM {$this->table} as t";
        $sql .= " JOIN categories as c ON c.id = t.category_id ";
        if (!empty($where)) {
            $sql.= " WHERE 1 ";
            foreach ($where as $key => $value) {
                $sql.= " AND  {$key} = '{$value}' ";
            }
        }

        if ($like != '') {
            $sql .= " AND t.name LIKE '%{$like}%' ";
        }
       

        if (!empty($orderBy)) {
            $sql .= " ORDER BY {$orderBy[0]} {$orderBy[1]}  ";
        }


        if($limit > -1 && $offset > 0) {
            $sql .= " LIMIT {$limit} , {$offset} ";
        }


        $result = $this->db->query($sql);

        if (!$result) {
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

    public function save(Entity $entity)
    {
        $data = array(
            'name' =>$entity->getName(),
            'description' => $entity->getDescription(),
            'image'      => $entity->getImage(),
            'category_id' => $entity->getCategoryId(),
        );
        
        if ($entity->getId() != null) {
            $this->update($entity->getId(), $data);
        } else {
            $this->insert($data);
        }
    }


    public function getRandomTours($limit = 6)
    {
        $sql = "SELECT * FROM {$this->table} Order by RAND() LIMIT {$limit}";
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