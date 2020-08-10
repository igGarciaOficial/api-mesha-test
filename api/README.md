# Projeto backend para teste de seleção da Mesha tecnologia
--------------------------------

## Requerimentos para rodar o projeto.
------------
* PHP com versão 7.2 ou superior;
* Laravel com versão 3.2.0;
* Composer com versão 1.10;
* Postgres 10.13 ou superior;
* Apache 2.0

### Do processo de instalação
----------
Após ter instalado os requerimentos e baixado o repositório. Abra uma janela de comandos (terminal/prompt) e pelo terminal vá até a pasta do repositório. Nela dê o seguinte comando:
        
        php composer.phar install

Isto, instalará as dependências usadas no projeto.
Em seguida, deve-se configurar o banco de dados. (Recomenda-se utilizar alguma ferramenta gráfica, como o [pgAdmin4](https://www.pgadmin.org/), caso não tenha costume com o terminal). As configurações do banco, como nome do banco, senha de acesso e outros, podem ser configurados a seu critério. Tendo em vista, que os arquivos ".env" não são subidos nos repositórios. Porém, para fins de facilidade, neste repositório, já há um arquivo .env, então se preferir, podes pegar as informações do banco lá.

Tendo o banco criado, vá para o terminal, entre no diretório do projeto, entre na pasta api e execute o seguinte comando:

    php artisan migrate
    
Isto, criará as tabelas no seu banco de dados. Em seguida, podés rodar:

    php artisan db:seed
    
Isto inserirá valores no banco de dados.
Pronto, feito tudo isto, basta que rode:

    php artisan serve
    
E agora nosso servidor já está no ar.