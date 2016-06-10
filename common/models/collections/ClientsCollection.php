<?php
class ClientsCollection extends Collection
{
    protected $table = 'clients';
    protected $entity = 'ClientEntity';

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