<?php

namespace Novosga\Model;

/**
 * @Entity
 * @Table(name="tipo_servicos")
 */
class TipoServico extends SequencialModel
{
    /**
     * @Column(type="string", name="nome", length=50, nullable=false)
     */
    protected $nome;

    /**
     * @Column(type="string", name="descricao", length=100, nullable=false)
     */
    protected $descricao;

    /**
     * @Column(type="smallint", name="status", nullable=false)
     */
    protected $status;

    public function __construct()
    {
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setDescricao($desc)
    {
        $this->descricao = $desc;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function toString()
    {
        return $this->nome;
    }

    public function jsonSerialize()
    {
        return [
            'id'          => $this->getId(),
            'nome'        => $this->getNome(),
            'descricao'   => $this->getDescricao(),
            'status'      => $this->getStatus(),
        ];
    }
}
