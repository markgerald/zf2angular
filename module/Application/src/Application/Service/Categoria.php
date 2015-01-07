<?php

namespace Application\Service;

use Application\Entity\Categorias;
use Doctrine\ORM\EntityManager;
use Application\Entity\Categoria as CategoriaEntity;

class Categoria
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert($dados)
    {

        $hydrator = new DoctrineHydrator($this->em);
        $entity = new Categorias;
        $entity = $hydrator->hydrate($dados, $entity);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function update($dados)
    {
        $hydrator = new DoctrineHydrator($this->em);
        $entity = $this->em
            ->getReference('Application\Entity\Categorias', $dados['id']);
        $entity = $hydrator->hydrate($dados, $entity);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->em
            ->getReference('Application\Entity\Categorias', $id);

        $this->em->remove($entity);
        $this->em->flush();
        return $id;
    }

} 