Clone da terminale
GitHub + Laravel

git clone https://github.com/marco987/check_correction_telephone_numbers.git

cd .\check_correction_telephone_numbers\

composer install ; npm install ; cp .env.example .env ; php artisan key:generate ; npm run dev

(!!! Modificare opportunamente il file .env)

php artisan migrate:fresh --seed