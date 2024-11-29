# Inicie API

## Ambiente de desenvolvimento

1. Clonar repositório:
   ```bash
   git@github.com:danie1net0/inicie-api.git
    ```
2. Instalar dependências do Composer:
   ```bash
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
   ```

3. Criar arquivos de ambiente:
   ```bash
   cp .env.example .env
   ```
    > Alterar as portas da aplicação e do banco de dados conforme necessário.

4. Inicializar containers:
   ```bash
   ./vendor/bin/sail up -d
   ```

5. Criar chave da aplicação:
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

6. Executar migrações:
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```
