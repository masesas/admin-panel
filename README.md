# Super Aggregator Bisnis Web App


## First Step
1. buat database dengan nama `bisnis_aggregate`
2. php artisan migrate:fresh
3. php artisan db:seed --class=DatabaseSeeder
4. php artisan serve
5. jika ada perubahan pada file scss atau css jalankan `npm run watch`

#

## Second Step
1. buka console baru dan jalankan `php artisan serve`
    - tambahkan `--port=xxxx` untuk running di specific port
2. buka console baru dan jalankan `npm run dev`
3. jangan close 2 console yg sudah dirubah
4. untuk menaikkkan ke hosting jalankan `npm run build`
5. updload 1 project laravel ke hosting
