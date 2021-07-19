# Desafio 215 Desenvolvedor JR. 
## Api para loja de confecção do João

### Configurando o banco
1º Realizar a execução do script responsável por criar o banco de dados.

### Configurando o Laravel
1º Realizar o download do projeto
2º Rodar o comando "composer install" (esta operação deve ser feita via terminal, é importante se certificar de que está dentro da pasta qual o projeto esteja localizado)
3º Realizar uma cópia do arquivo .env.example o renomeando para .env
4º Rodar o comando php artisan key:generate para criar a chave da aplicação
5º Configurar a conexão com o banco de dados e apontar para o schema loja_joao
6º Executar as migrations com o comando php artisan migrate

#### Códigos de erros
Código | Descrição
-------|----------
404| Rota ou recurso inválido
405| Método não encontrado
406| Não aceitável
422| Entidade não processada

#### Ambiente
Inicialize o servidor utilizando o comando php artisan serve

#### Fluxo de utilização da API
1º criar um usuário
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/register | POST | string - nome, email, senha.

2º Recuperar o token de acesso
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/login | POST | string - email, password.

--------------------------------------------------------
# Observações
#### Todas as rotas de CRUD necessitam do token. O token deve ser informado via bearer token
#### Rotas do tipo PATCH devem usar o verbo POST enviando como parâmetro _method=PATCH
#### Para enviar arquivos utilize a estrutura Multipart Form

Parâmetro para rota PATCH
Tipo | Nome | Valor | Obrigatório
-------|-------|----------|--------
string | _method | PATCH | Sim
--------------------------------------------------------
# Rotas para entidade Produto
Lita de parâmetros da API para a entidade Produto
Tipo | Nome | Exemplo | Obrigatório
-------|-------|----------|--------
string | codigo | CMS01| Sim
string | categoria | fit| Sim
float | preco | 39.25| Sim
string | composicao | Tecido de algodão| Sim
string | tamanho | m| Sim
int | quantidade | 5| Sim
string | nome | Camisa Cinza| Sim
int | id | 1 | Somente em rotas de edição e exclusão

## Para realizar o cadastro do Produto
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/produto/ | POST | Verificar parâmetros da entidade Produto.

## Para realizar a edição do Produto
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/produto/{id} | PATCH | Verificar parâmetros da entidade Produto.

## Para realizar a exclusão do PRODUTO
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/produto/{id} | DELETE | id.

## Para buscar através do ID
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/produto/{id} | GET | id.

--------------------------------------------------------
# Rotas para entidade Imagem

Lita de parâmetros da API para a entidade Imagem
Tipo | Nome | Exemplo | Obrigatório
-------|-------|----------|--------
file | imagem | helloword.jpg | Sim
int | produtos_id | 1 | Sim
int | id | 1 | Somente em rotas de edição e exclusão

## Para realizar o cadastro da Imagem
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/imagem | POST | Verificar parâmetros da entidade Imagem.

## Para realizar a edição da Imagem
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/imagem/{id} | PATCH | Verificar parâmetros da entidade Produto.

## Para realizar a exclusão da Imagem
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/imagem/{id} | DELETE | id.

## Para buscar através do ID
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/imagem/{id} | GET | id.

-----------------------------------------------------------------------
# Rotas para entidade Histórico dos produtos

Lita de parâmetros da API para a entidade Imagem
Tipo | Nome | Exemplo | Obrigatório
-------|-------|----------|--------
int | id | 1 | Sim
##### Observação o ID informado deve ser do produto

## Para buscar através do ID
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/historico/produto/{id} | GET | id.

## Para buscar todos os registros
Rota | Método | Parâmetros
-------|-------|----------
http://127.0.0.1:8000/api/historico/produtos | GET | id.