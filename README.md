# eLibrary

Instalacija projekta

### 1.Komande za instalaciju i postavku projekta

```
git clone https://github.com/glogi32/eLibrary.git
cd eLibrary
composer install
cp .env.example .env
php artisan key:generate
```
### 2.Komande za kreaciju baze i pokretanje projekta

```
php artisan migrate
php artisan serve
```

### 3. Pokretanje seedera za popunu baze podacima

```
php artisan db:seed
```
