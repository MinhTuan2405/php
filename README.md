# PHP_final  Hướng dẫn chạy 
- App: http://localhost:8080
- phpMyAdmin: http://localhost:8081 (user: root / rootpassword)

**Yêu cầu**
- Docker Desktop (Compose v2+)

**(Chạy bằng Docker)**
1. Clone repo và copy .env:
cp .env.example .env
2. Build và chạy containers (image đã chứa vendor):
docker compose up -d --build

3. Khởi tạo DB và cache:
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
`
4. Mở app: http://localhost:8080 và phpMyAdmin: http://localhost:8081.

**Ghi chú **
-vendor/ được cài trong quá trình build và mount vào volume vendor, nên sau docker compose up -d --build thường không cần chạy composer install.
- Nếu có volume *_vendor cũ, xóa nó để Docker populate từ image mới:

docker compose down
docker volume rm "_vendor" || true
docker compose up -d --build

- Cập nhật package (sau khi sửa composer.json):
  - Rebuild image (khuyến nghị):

docker compose build --no-cache app
docker compose up -d

  - Hoặc cập nhật bằng composer trong container:
docker compose run --rm app composer install --ignore-platform-reqs --optimize-autoloader


**Nếu muốn chạy local**
Nếu muốn dùng PHP cục bộ (ví dụ dùng php 8.4 ở C:\php8.4.16\php.exe):

C:\php8.4.16\php.exe composer install
C:\php8.4.16\php.exe artisan key:generate
C:\php8.4.16\php.exe artisan migrate --seed
C:\php8.4.16\php.exe artisan serve --host=127.0.0.1 --port=8000


**Lỗi thường gặp**
- Thiếu vendor: chạy composer trong container hoặc rebuild image.

