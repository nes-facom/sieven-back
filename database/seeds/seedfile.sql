-- INSERT INTO users (name, email, email_verified_at, password, remember_token, created_at, updated_at, cpf, data_nascimento, foto_perfil, membro_ufms, administrador, situacao_id) 
-- VALUES ('sieven', 'admin@admin', NULL, '$2y$10$Wj.rMPlJ8zdu6OChS1nasexv/RRl/zyre7toxOXyLV.Ry/DbxEtii', NULL, '2023-05-08 18:51:34', '2023-05-08 18:51:34', NULL, NULL, NULL, TRUE, TRUE, 1);

INSERT INTO public.evento (nome, descricao, "local", data_inicial, data_final, created_at, updated_at, created_by_user, edited_by_cargo, situacao_id) VALUES ('Evento 1', 'Descrição do Evento 1', 'local 1', '2023-05-10 08:00:00', '2023-05-14 20:00:00', now(), now(), 1, 1, 1);
INSERT INTO public.evento (nome, descricao, "local", data_inicial, data_final, created_at, updated_at, created_by_user, edited_by_cargo, situacao_id) VALUES ('Evento 2', 'Descrição do Evento 2', 'local 2', '2023-05-15 10:00:00', '2023-05-17 22:00:00', now(), now(), 1, 1, 1);
INSERT INTO public.evento (nome, descricao, "local", data_inicial, data_final, created_at, updated_at, created_by_user, edited_by_cargo, situacao_id) VALUES ('Evento 3', 'Descrição do Evento 3', 'local 3', '2023-05-20 09:00:00', '2023-05-22 21:00:00', now(), now(), 1, 1, 1);
INSERT INTO public.evento (nome, descricao, "local", data_inicial, data_final, created_at, updated_at, created_by_user, edited_by_cargo, situacao_id) VALUES ('Evento 4', 'Descrição do Evento 4', 'local 4', '2023-05-25 12:00:00', '2023-05-28 18:00:00', now(), now(), 1, 1, 1);
INSERT INTO public.evento (nome, descricao, "local", data_inicial, data_final, created_at, updated_at, created_by_user, edited_by_cargo, situacao_id) VALUES ('Evento 5', 'Descrição do Evento 5', 'local 5', '2023-06-01 14:00:00', '2023-06-04 16:00:00', now(), now(), 1, 1, 1);
INSERT INTO public.evento (nome, descricao, "local", data_inicial, data_final, created_at, updated_at, created_by_user, edited_by_cargo, situacao_id) VALUES ('Evento 6', 'Descrição do Evento 6', 'local 6', '2023-06-10 08:00:00', '2023-06-14 20:00:00', now(), now(), 1, 1, 1);
INSERT INTO public.evento (nome, descricao, "local", data_inicial, data_final, created_at, updated_at, created_by_user, edited_by_cargo, situacao_id) VALUES ('Evento 7', 'Descrição do Evento 7', 'local 7', '2023-06-15 10:00:00', '2023-06-17 22:00:00', now(), now(), 1, 1, 1);
INSERT INTO public.evento (nome, descricao, "local", data_inicial, data_final, created_at, updated_at, created_by_user, edited_by_cargo, situacao_id) VALUES ('Evento 8', 'Descrição do Evento 8', 'local 8', '2023-06-20 09:00:00', '2023-06-22 21:00:00', now(), now(), 1, 1, 1);


INSERT INTO public.cargo (user_id, evento_id, nome_cargo, situacao_id, created_at, updated_at) VALUES (1, 4, 'Admin', 1, now(), now());
INSERT INTO public.cargo (user_id, evento_id, nome_cargo, situacao_id, created_at, updated_at) VALUES (1, 5, 'Coordenador', 1, now(), now());
INSERT INTO public.cargo (user_id, evento_id, nome_cargo, situacao_id, created_at, updated_at) VALUES (1, 6, 'Participante', 1, now(), now());


INSERT INTO public.evento (id,nome,modalidade, descricao, data_inicial, data_final, created_at, updated_at, created_by_user, edited_by_cargo, situacao_id) 
VALUES
    (1,'Evento 1','P', 'Descrição do Evento 1', '2023-05-10 08:00:00', '2023-05-14 20:00:00', now(), now(), 1, 1, 1),
    (2,'Evento 2', 'R','Descrição do Evento 2', '2023-05-15 10:00:00', '2023-05-17 22:00:00', now(), now(), 1, 1, 1),
    (3,'Evento 3', 'P','Descrição do Evento 3', '2023-05-20 09:00:00', '2023-05-22 21:00:00', now(), now(), 1, 1, 1),
    (4,'Evento 4','R', 'Descrição do Evento 4', '2023-05-25 12:00:00', '2023-05-28 18:00:00', now(), now(), 1, 1, 1),
    (5,'Evento 5','P', 'Descrição do Evento 5', '2023-06-01 14:00:00', '2023-06-04 16:00:00', now(), now(), 1, 1, 1),
    (6,'Evento 6','P', 'Descrição do Evento 6', '2023-06-10 08:00:00', '2023-06-14 20:00:00', now(), now(), 1, 1, 1),
    (7,'Evento 7','P', 'Descrição do Evento 7', '2023-06-15 10:00:00', '2023-06-17 22:00:00', now(), now(), 1, 1, 1),
    (8,'Evento 8', 'P','Descrição do Evento 8', '2023-06-20 09:00:00', '2023-06-22 21:00:00', now(), now(), 1, 1, 1);


INSERT INTO public.cargo (id,user_id, evento_id, nome_cargo, situacao_id, created_at, updated_at) 
VALUES
    (1,1, 1, 'Admin', 1, now(), now()),
    (2,1, 2, 'Coordenador', 1, now(), now()),
    (3,1, 3, 'Participante', 1, now(), now());


 INSERT INTO atividade (evento_id, nome, descricao, local, horario_inicio, horario_encerramento, palestrante, usuario_alteracao, cargo_cadastro_id, cargo_alteracao_id, quantidade_vagas, requisitos, acessibilidade, situacao_id, created_at, updated_at)
VALUES 
(1, 'Palestra sobre DevOps',    'O Festival Latino-americano de Instalação de Software Livre (FLISOL) é o maior evento da América Latina de divulgação de Software Livre. Ele é realizado desde o ano de 2005, e desde 2008 sua realização acontece no 4o. sábado de abril de cada ano. Seu principal objetivo é promover o uso de Software Livre, mostrando ao público em geral sua filosofia, abrangência, avanços e desenvolvimento.',    'Auditório 1 - Facom',    '2023-05-21 13:00:00',    '2023-05-21 17:00:00',    'Dr.Awdren Fontão',    NULL,    1,    NULL,    NULL,    NULL,    NULL,    1,    NOW(),    NOW()),
(1, 'Workshop de Programação',    'Participe do nosso workshop prático de programação e aprenda as melhores práticas para desenvolver aplicativos web. Não é necessário conhecimento prévio. Venha e aproveite!',    'Sala 302 - Prédio A',    '2023-05-22 09:00:00',    '2023-05-22 12:00:00',    'Engenheiro Carlos Silva',    NULL,    2,    NULL,    30,    'Notebook com sistema operacional Linux',    'A sala está adaptada para cadeirantes.',    1,    NOW(),    NOW()),
(1, 'Oficina de Design Gráfico',    'Venha aprender sobre design gráfico e ferramentas de edição de imagens. A oficina abordará conceitos básicos e práticos para a criação de designs atrativos.',    'Sala 201 - Prédio B',    '2023-05-23 14:00:00',    '2023-05-23 17:00:00',    'Designer Ana Costa',    NULL,    3,    NULL,    20,    'Nenhum requisito específico',    'A sala está equipada com recursos de acessibilidade visual.',    1,    NOW(),    NOW());

INSERT INTO public.atividade (evento_id, usuario_alteracao, cargo_cadastro_id, cargo_alteracao_id, nome, endereco, modalidade, quantidade_vagas, horario_inicio, horario_encerramento, requisitos, acessibilidade, situacao_id, created_at, updated_at)
VALUES (6, 1, 1, 1, 'Atividade 8', 'Rua H', 'modalidade 3', 14, '2023-05-13 14:00:00', '2023-05-13 16:00:00', 'Requisito 8', 'Não acessível', 1, now(), now());