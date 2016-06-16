<?php
class TourImagesCollection extends Collection
{
    protected $table = 'tours_images';
    protected $entity = 'TourImageEntity';
    
    public function save(Entity $entity)
    {
        $data = array(
            'tours_id' => $entity->getToursId(),
            'image'      => $entity->getImage(),
        );

        if ($entity->getId() != null) {
            $this->update($entity->getId(), $data);
        } else {
            $this->insert($data);
        }
    }
}