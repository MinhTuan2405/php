#!/bin/bash

# Railway Deployment Quick Start Script
# Chạy script này để chuẩn bị deploy lên Railway

echo "==================================="
echo "Railway Deployment Setup"
echo "==================================="

# 1. Check if git is initialized
if [ ! -d ".git" ]; then
    echo "❌ Git chưa được khởi tạo!"
    echo "Chạy lệnh: git init"
    exit 1
fi

# 2. Generate APP_KEY if not exists
if [ ! -f ".env" ]; then
    echo "⚠️  File .env không tồn tại, tạo từ .env.example..."
    cp .env.example .env
fi

echo "📝 Generating APP_KEY..."
php artisan key:generate

# Get the key
APP_KEY=$(php artisan key:generate --show)
echo "✅ APP_KEY: $APP_KEY"
echo "💾 Lưu key này để thêm vào Railway Variables!"

# 3. Check Dockerfile
if [ ! -f "Dockerfile" ]; then
    echo "❌ Không tìm thấy Dockerfile!"
    exit 1
fi

# 4. Check composer.json
if [ ! -f "composer.json" ]; then
    echo "❌ Không tìm thấy composer.json!"
    exit 1
fi

# 5. Install dependencies
echo "📦 Installing PHP dependencies..."
composer install --optimize-autoloader

# 6. Build frontend assets (if needed)
if [ -f "package.json" ]; then
    echo "🎨 Building frontend assets..."
    npm install
    npm run build
fi

# 7. Create .railwayignore if not exists
if [ ! -f ".railwayignore" ]; then
    echo "📄 Creating .railwayignore..."
    cat > .railwayignore << EOL
node_modules/
vendor/
storage/logs/*
storage/framework/cache/*
storage/framework/sessions/*
storage/framework/views/*
.env
.env.*
!.env.example
*.log
EOL
fi

echo ""
echo "==================================="
echo "✅ Setup hoàn tất!"
echo "==================================="
echo ""
echo "📋 Các bước tiếp theo:"
echo "1. Commit và push code lên GitHub"
echo "   git add ."
echo "   git commit -m 'Prepare for Railway deployment'"
echo "   git push origin main"
echo ""
echo "2. Truy cập https://railway.app"
echo "3. Tạo project mới và provision MySQL"
echo "4. Deploy từ GitHub repository"
echo "5. Thêm environment variables (xem RAILWAY_DEPLOYMENT.md)"
echo "6. Thêm APP_KEY: $APP_KEY"
echo ""
echo "📖 Xem hướng dẫn chi tiết tại: RAILWAY_DEPLOYMENT.md"
echo ""
