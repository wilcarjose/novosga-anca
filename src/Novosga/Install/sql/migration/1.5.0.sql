
CREATE TABLE tipo_servicos (
    id serial NOT NULL,
    descricao varchar(100) NOT NULL,
    nome varchar(50) NOT NULL,
    status smallint NOT NULL
);

ALTER TABLE servicos ADD tipo_servico_id integer;

ALTER TABLE ONLY tipo_servicos ADD CONSTRAINT tipo_servicos_pkey PRIMARY KEY (id);
ALTER TABLE ONLY servicos ADD FOREIGN KEY (tipo_servico_id) REFERENCES tipo_servicos (id);

INSERT INTO modulos(
            id, chave, nome, descricao, tipo, status)
    VALUES (15, 'sga.tipoServicos', 'Tipos de Servicios', 'Administración de los tipos servicios del sistema', 1, 1);
           

INSERT INTO cargos_mod_perm(
            cargo_id, modulo_id, permissao)
    VALUES (1, 15, 3);