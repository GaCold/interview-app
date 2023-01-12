- add env
```
cp .env.example .env
```

- connect db in .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=interview
DB_USERNAME=root
DB_PASSWORD=123
```

- install composor
``` 
composer i
```

- migrate & init db
```
php artisan migrate --seed
```

- init jwt
```
php artisan key:generate
php artisan jwt:serect
```

- info user login
```
user@gmail.com
123456
```

- run source local
```
php artisan serve
```

- api info
```
1. login
http://127.0.0.1:8000/api/login

2. product list
http://127.0.0.1:8000/api/products?filter[price][]=157342&filter[price][]=224725
```
