<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;

class UsersService extends AbstractService
{
    protected $entity = \Application\Entity\Users::class;

    public function update(int $id, Array $data): AbstractEntity
    {
        if (empty($data['password']))
            unset($data['password']);

        return parent::update($id, $data);
    }
}