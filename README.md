POS graduação

Curso: Desenvolvimento Web Full Stack

Disciplina: Frameworks back end: PHP

Professor: Tales Santos 

Trabalho: Blog API

Aluno: André Guilherme de Almeida Santos

### Comandos básicos

- COMANDO para instalar dependências:
```
  composer install
```  

- COMANDO para executar testes:
```
  php bin/phpunit
```  

- COMANDO para criar a tabela do banco de dados:
```
  php bin/console doctrine:schema:create
```  

- COMANDO para subir a API na porta 8080:
```
  php -S 127.0.0.1:8080 -t public/
```  

### SERVIÇOS DA API 
* Recupera todos os posts:
```
  GET localhost:8080/posts
```    
  
    
* Recupera um post específico:
```
  GET localhost:8080/posts/{id_post}
```  
    Exemplo para recuperar o post de id = 1:  
    localhost:8080/posts/1
  
    
  * Cria um novo post (JSON obrigatório):
```
  POST localhost:8080/posts
```  
    Exemplo de JSON:
    {
      "title" : "Novo título",
      "description" : "Nova descrição"
    }
  
  
* Atualiza um post específico (JSON obrigatório):
```
  PUT localhost:8080/posts/{id_post}
```  
    Exemplo para atualizar o post de id = 1:  
    localhost:8080/posts/1    
    
    Exemplo de JSON:
    {
      "title" : "Título atualizado",
      "description" : "Descrição atualizada"
    }
  
  
* Deleta um post específico:
```
  DELETE localhost:8080/posts/{id_post}
```  
    Exemplo para deletar o post de id = 1:  
    localhost:8080/posts/1  
  
  
