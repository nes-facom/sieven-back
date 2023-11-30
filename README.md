# SIEVEN : Back-end 



## Estrutura do documento

- [Descrição do projeto](#descri%C3%A7%C3%A3o-do-projeto)
- [Funcionalidades](#funcionalidades)
- [Requisitos](#requisitos)
- [Instalação (local)](#instalação-local)
- [Instalação (Docker)](#instalação-docker)
- [Primeiros passos](#primeiros-passos)
- [Autores e histórico](#autores)


## Descrição do projeto
Este repositório contém uma aplicação Laravel para o back-end do projeto SIEVEN. O SIEVEN é uma plataforma para gerenciamento de eventos e atividades.

## Funcionalidades
### CRUD de Eventos e Atividades
### Eventos

- **GET /evento**: Retorna uma lista de eventos existentes.
- **GET /evento/{id}**: Retorna os detalhes de um evento específico com o ID correspondente.
- **GET /evento/{id}/detalhes**: Mostra todas as atividades de um evento.
- **GET /eventos-pagina-inicial**: Popula a pagina inicial
- **POST /evento/criar-evento**: Cria um novo evento com base nos dados fornecidos.
- **PUT /evento/{id}**: Atualiza um evento existente com o ID correspondente, utilizando os dados fornecidos.
- **DELETE /evento/{id}**: Exclui um evento existente com o ID correspondente.

### Atividades

- **GET /atividade**: Retorna uma lista de atividades existentes.
- **GET /atividade/{id}**: Retorna os detalhes de uma atividade específica com o ID correspondente.
- **GET /atividade/{id}/checkin**: Mostra a atividade que vai ser realizado o check-in.
- **GET /atividade/{id}/gerar-relatorio** : Gera um relatorio com todas as inscricaos que tem o checkin true de uma atividade especifica.
- **POST /atividade/criar-atividade**: Cria uma nova atividade com base nos dados fornecidos.
- **PUT /atividade/{id}**: Atualiza uma atividade existente com o ID correspondente, utilizando os dados fornecidos.
- **DELETE /atividade/{id}**: Exclui uma atividade existente com o ID correspondente.

## Inscrição

- **PUT /inscricao/{uuid}** : Cria uma inscricao com ID unico

## Tipo

- **GET /tipo**: Mostra todos os tipos.

## Categoria

- **GET /categoria**: Mostra todas as categorias.

## Modalidade

- **GET /modalidade**: Mostra todas as modalidades.


## Requisitos
 Requisitos mínimos necessários para executar a aplicação
 - PHP (Versão minima 7.4)
 - Composer instalado
 - Banco de dados configurado (postgres)   

## Ferramentas
- Docker
- Laravel
- Composer
- Postgres

## Instalação-local

Clone este repositório
```
git clone https://github.com/seu-usuario/seu-projeto.git`.
```
Instale as dependências do PHP com o Composer
```
 composer install
```
Copie o arquivo de ambiente e configure as variáveis de ambiente, como o DB_HOST E DB_PASSWORD
 
```
cp .env.example .env
```
Descomente no php.ini a `extension=pgsql` e `extension=gd`

Substitua a parte de MAIL que contem no .env pelo seguinte trecho:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=sieven.nes@gmail.com
MAIL_PASSWORD='rmes onbh zkxf tcfg'
MAIL_FROM_ADDRESS=sieven.nes@gmail.com
CLOUDINARY_URL=cloudinary://628234936799186:bU1zgiBvRo17LO_ULdzoLw5aW5E@dzgahmu0x
```
Crie um database no PostgresSQL com o nome `sieven` e realize as migrations:

```
php artisan migrate:fresh --seed
```
Gere uma chave de aplicação:

 ```
php artisan key:generate
```
Gera um secret para o JWT:

```
php artisan jwt:secret
```

Inicie o servidor de desenvolvimento do Laravel na porta 8000: 
```
php aritsan serve --port 8000
```
 
Acesse a aplicação no navegador: `http://127.0.0.1:8000`.


## Instalação-docker
 
```
cp .env.example
```
Copie o arquivo `.env.example` para um novo arquivo chamado `.env`. O arquivo `.env` é usado para definir variáveis de ambiente para a aplicação, como informações do banco de dados e chaves de API.

```
docker-compose build
```

Crie as imagens Docker para os serviços especificados no arquivo `docker-compose.yml`. Isso é necessário apenas na primeira vez em que você executa a aplicação ou sempre que houver alterações significativas no código ou nas dependências.

```
docker-compose up -d
```

Inicie os serviços especificados no arquivo `docker-compose.yml`. O parâmetro `-d` é usado para executar os serviços em segundo plano.

```
docker-compose exec app composer update
docker-compose exec app composer install
```

Execute o comando `composer install` no serviço `app`. O serviço `app` é o serviço que contém a aplicação Laravel. O comando `composer install` instala as dependências do PHP especificadas no arquivo `composer.json` e as salva em `vendor/`.

```
docker-compose exec app php artisan key:generate
```

Execute o comando `php artisan key:generate` no serviço `app`. O comando `php artisan key:generate` gera uma chave de criptografia aleatória que é usada para proteger as informações da sessão e cookies da aplicação.

```
docker-compose exec app php artisan migrate
```

Execute o comando `php artisan migrate` no serviço `app`. O comando `php artisan migrate` executa as migrações do banco de dados que foram definidas na aplicação Laravel. As migrações são usadas para criar as tabelas e colunas no banco de dados.


## Primeiros passos
Após a execução da aplicação, o login do administrador é:
```
login: admin@mail.com
senha: admin
```

## Autores 
Esta parte do sistema foi desenvolvido pela seguinte equipe:

- [Joao Brigido](https://github.com/jvbrigido2) (joao_brigido@ufms.br)
- [Bruno Lewin](https://github.com/AgenteVIIX) (brunno.lewin@ufms.br)
- [Larissa Leal](https://github.com/larisleal) (larissa.leal@ufms.br)
- [Arthur Cabral](https://github.com/arthcabral) (arthur.cabral@ufms.br)
  

 
