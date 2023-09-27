## Install
```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan sail:add mysql
php artisan sail:add mailpit
sail up -d
sail artisan migrate
sail artisan db:seed
```