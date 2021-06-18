## Este projeto está utilizando o Laravel Sail. O Sail utiliza o docker composer para criar a infraestrutura basica do projeto, caso não possua o docker instalado, baixar o mysql ou maria db e configurar de acordo com o passo 2.
# Este projeto foi feito com Vuejs no front.

## INSTALAÇÃO - Com Sail
1. composer install
# Cria link simbolico para o laravel sail
2. ln -s ./vendor/laravel/sail/bin/sail sail
# Executa o laravel sail
3. ./sail up -d
# Instala as dependências do front
4. ./sail npm install

# Compila o front
5. ./sail npm run dev

# Renomeia o .env.desenv para o .env
6. cp .env.desenv .env

# Instala  a chave do laravel
7. ./sail php artisan key:generate

# Roda as migrations
8. ./sail php artisan migrate

# Inicia o servidor
9. ./sail php artisan serve

## Sem o Laravel Sail - Precisa baixar o MYSQL OU MARIADB

1. composer install

# Instala as dependências do front
4. npm install

# Compila o front
5. npm run dev

# Renomeia o .env.desenv para o .env
6. cp .env.desenv .env

# Instala  a chave do laravel
7. php artisan key:generate

# Roda as migrations
8. php artisan migrate

# Inicia o servidor
9.  php artisan serve
