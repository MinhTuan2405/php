@echo off
REM Railway Deployment Quick Start Script for Windows
REM Chạy script này để chuẩn bị deploy lên Railway

echo ===================================
echo Railway Deployment Setup
echo ===================================
echo.

REM 1. Check if git is initialized
if not exist ".git" (
    echo [ERROR] Git chua duoc khoi tao!
    echo Chay lenh: git init
    exit /b 1
)

REM 2. Generate APP_KEY if not exists
if not exist ".env" (
    echo [WARNING] File .env khong ton tai, tao tu .env.example...
    copy .env.example .env
)

echo [INFO] Generating APP_KEY...
php artisan key:generate

REM Get the key
echo [INFO] Getting APP_KEY value...
php artisan key:generate --show > temp_key.txt
set /p APP_KEY=<temp_key.txt
del temp_key.txt

echo [SUCCESS] APP_KEY: %APP_KEY%
echo [IMPORTANT] Luu key nay de them vao Railway Variables!
echo.

REM 3. Check Dockerfile
if not exist "Dockerfile" (
    echo [ERROR] Khong tim thay Dockerfile!
    exit /b 1
)

REM 4. Check composer.json
if not exist "composer.json" (
    echo [ERROR] Khong tim thay composer.json!
    exit /b 1
)

REM 5. Install dependencies
echo [INFO] Installing PHP dependencies...
composer install --optimize-autoloader

REM 6. Build frontend assets (if needed)
if exist "package.json" (
    echo [INFO] Building frontend assets...
    call npm install
    call npm run build
)

REM 7. Create .railwayignore if not exists
if not exist ".railwayignore" (
    echo [INFO] Creating .railwayignore...
    (
        echo node_modules/
        echo vendor/
        echo storage/logs/*
        echo storage/framework/cache/*
        echo storage/framework/sessions/*
        echo storage/framework/views/*
        echo .env
        echo .env.*
        echo !.env.example
        echo *.log
    ) > .railwayignore
)

echo.
echo ===================================
echo [SUCCESS] Setup hoan tat!
echo ===================================
echo.
echo [NEXT STEPS] Cac buoc tiep theo:
echo 1. Commit va push code len GitHub
echo    git add .
echo    git commit -m "Prepare for Railway deployment"
echo    git push origin main
echo.
echo 2. Truy cap https://railway.app
echo 3. Tao project moi va provision MySQL
echo 4. Deploy tu GitHub repository
echo 5. Them environment variables (xem RAILWAY_DEPLOYMENT.md)
echo 6. Them APP_KEY: %APP_KEY%
echo.
echo [DOCS] Xem huong dan chi tiet tai: RAILWAY_DEPLOYMENT.md
echo.
pause
