<?php
namespace Application\Controller;


use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class CategoriaController extends AbstractRestfulController
{
    // get
    public function getList()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Categorias')->findAll();

        //return $data;

        return new JsonModel();

    }

    // get
    public function get($id)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Categorias')->find($id);

        return $data;
    }

    // post
    public function create($data)
    {
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categorias');
        $nome = $data['nome'];

        $categoria = $serviceCategoria->insert($nome);
        if($categoria) {
            return $categoria;
        } else {
            return array('success'=>false);
        }

    }

    // put
    public function update($id, $data)
    {
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categorias');
        $param['id'] = $id;
        $param['nome'] = $data['nome'];

        $categoria = $serviceCategoria->update($param);
        if($categoria) {
            return $categoria;
        } else {
            return array('success'=>false);
        }
    }

    // delete
    public function delete($id)
    {
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categorias');
        $result = $serviceCategoria->delete($id);
        if ($result) return $result;
    }

}