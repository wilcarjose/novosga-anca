<?php

namespace modules\sga\tiposervicos;

use Novosga\Context;
use Novosga\Controller\CrudController;
use Novosga\Model\SequencialModel;
use Novosga\Model\TipoServico;

/**
 * TipoServicosController.
 *
 * @author Wilcar Jose Angulo <wilcarjose@gmail.com>
 */
class TipoServicosController extends CrudController
{
    protected function createModel()
    {
        $tipoServico = new TipoServico();

        return $tipoServico;
    }

    protected function requiredFields()
    {
        return ['nome', 'descricao', 'status'];
    }

    protected function preSave(Context $context, SequencialModel $model)
    {
    }

    protected function search($arg)
    {
        $query = $this->em()->createQuery("
            SELECT
                e
            FROM
                Novosga\Model\TipoServico e
            WHERE
                (
                    UPPER(e.nome) LIKE :arg OR
                    UPPER(e.descricao) LIKE :arg
                )
            ORDER BY
                e.nome
        ");
        $query->setParameter('arg', $arg);

        return $query;
    }

    public function edit(Context $context, $id = 0)
    {
        parent::edit($context, $id);
        $this->app()->view();
    }

    protected function postSave(Context $context, SequencialModel $model)
    {        
    }

    /**
     * Verifica se já existe unidade usando o serviço.
     *
     * @param Novosga\Model\SequencialModel $model
     */
    protected function preDelete(Context $context, SequencialModel $model)
    {
        $error = _('Existen servicios asociados a el registro que desea eliminar');
        // quantidade de atendimentos do servico
        $query = $this->em()->createQuery("SELECT COUNT(e) as total FROM Novosga\Model\Servico e 
                 WHERE e.tipoServico = :tipoServico");
        $query->setParameter('tipoServico', $model->getId());
        $rs = $query->getSingleResult();
        if ($rs['total'] > 0) { 
            throw new \Exception($error);
        }

        $this->em()->beginTransaction();

    }

    protected function postDelete(Context $context, SequencialModel $model)
    {
        $this->em()->commit();
    }

}
