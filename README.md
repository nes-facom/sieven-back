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

- **GET /eventos**: Retorna uma lista de eventos existentes.
- **GET /eventos/{id}**: Retorna os detalhes de um evento específico com o ID correspondente.
- **POST /eventos**: Cria um novo evento com base nos dados fornecidos.
- **PUT /eventos/{id}**: Atualiza um evento existente com o ID correspondente, utilizando os dados fornecidos.
- **DELETE /eventos/{id}**: Exclui um evento existente com o ID correspondente.

### Atividades

- **GET /atividades**: Retorna uma lista de atividades existentes.
- **GET /atividades/{id}**: Retorna os detalhes de uma atividade específica com o ID correspondente.
- **GET /atividades/evento/{eventoId}**: Retorna uma lista de atividades para um evento específico com o ID correspondente.
- **POST /atividades**: Cria uma nova atividade com base nos dados fornecidos.
- **PUT /atividades/{id}**: Atualiza uma atividade existente com o ID correspondente, utilizando os dados fornecidos.
- **DELETE /atividades/{id}**: Exclui uma atividade existente com o ID correspondente.

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
1. Clone este repositório: `git clone https://github.com/seu-usuario/seu-projeto.git`.
2. Instale as dependências do PHP com o Composer: `composer install`.
3. Copie o arquivo de ambiente `.env.example` para `.env` e configure as variáveis de ambiente, como a conexão com o banco de dados.
4. Gere uma chave de aplicação: `php artisan key:generate`.
5. Execute as migrações do banco de dados: `php artisan migrate`.
6. Inicie o servidor de desenvolvimento do Laravel: `php artisan serve`.
7. Acesse a aplicação no navegador: `http://127.0.0.1:80`.


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
Após a execução da aplicação, é necessário cadastrar um um usuário através da rota `http://127.0.0.1/register` para ter acesso ao dashboard

## Autores 
Esta parte do sistema foi desenvolvido pela seguinte equipe:
- [David Gama](https://github.com/davidgamaserrate1) (david.gama@ufms.br)
- [Henrique Yule](https://github.com/HenriqueYuleZ) (henrique.y@ufms.br)
- [Pedro Arantes](https://github.com/pedrorodriguesarantes) (pedro.arantes@ufms.br)
  

 
