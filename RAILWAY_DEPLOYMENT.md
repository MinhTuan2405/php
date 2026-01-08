# Hướng Dẫn Deploy Laravel Lên Railway

## Bước 1: Chuẩn Bị

### 1.1. Tạo tài khoản Railway
1. Truy cập https://railway.app
2. Đăng ký/Đăng nhập bằng GitHub

### 1.2. Push code lên GitHub
```bash
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/your-username/your-repo.git
git push -u origin main
```

## Bước 2: Tạo Project Trên Railway

### 2.1. Tạo MySQL Database
1. Vào Railway Dashboard → Click "New Project"
2. Chọn "Provision MySQL"
3. Railway sẽ tự động tạo database và cung cấp connection string

### 2.2. Deploy Laravel App
1. Trong cùng project, click "New Service"
2. Chọn "GitHub Repo"
3. Chọn repository của bạn
4. Railway sẽ tự động detect Dockerfile và build

## Bước 3: Cấu Hình Environment Variables

Vào Settings của Laravel service → Variables, thêm các biến sau:

### Biến Bắt Buộc:
```env
APP_NAME=YourAppName
APP_ENV=production
APP_KEY=base64:your-app-key-here
APP_DEBUG=false
APP_URL=https://your-app.railway.app

# Database (Lấy từ MySQL service)
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQL_URL}}
DB_PORT=${{MySQL.MYSQL_PORT}}
DB_DATABASE=${{MySQL.MYSQL_DATABASE}}
DB_USERNAME=${{MySQL.MYSQL_USER}}
DB_PASSWORD=${{MySQL.MYSQL_PASSWORD}}

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_STORE=database
QUEUE_CONNECTION=database

# Filesystem
FILESYSTEM_DISK=public

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error
```

### Biến Tùy Chọn (Mail, Payment):
```env
# Mail (nếu dùng)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com

# PayPal (nếu dùng)
PAYPAL_MODE=live
PAYPAL_SANDBOX_CLIENT_ID=your-sandbox-id
PAYPAL_SANDBOX_SECRET=your-sandbox-secret
PAYPAL_LIVE_CLIENT_ID=your-live-id
PAYPAL_LIVE_SECRET=your-live-secret

# VNPay (nếu dùng)
VNPAY_TMN_CODE=your-tmn-code
VNPAY_HASH_SECRET=your-hash-secret
VNPAY_URL=https://sandbox.vnpayment.vn/paymentv2/vpcpay.html
VNPAY_RETURN_URL=https://your-app.railway.app/vnpay/return
```

## Bước 4: Generate APP_KEY

### Cách 1: Sử dụng Railway Shell
1. Vào service → Settings → Click "Shell"
2. Chạy lệnh:
```bash
php artisan key:generate --show
```
3. Copy key và paste vào biến `APP_KEY`

### Cách 2: Local
```bash
php artisan key:generate --show
# Copy output và thêm vào Railway Variables
```

## Bước 5: Cấu Hình Database và Migration

### 5.1. Kết nối Database giữa các services
Railway tự động tạo private network giữa các service. Dùng biến reference:
- `${{MySQL.MYSQL_URL}}` hoặc hostname của MySQL service
- Hoặc dùng connection string đầy đủ

### 5.2. Run Migrations
Railway sẽ tự động chạy migration khi deploy (theo Dockerfile CMD).

Hoặc chạy thủ công qua Shell:
```bash
php artisan migrate --force
php artisan db:seed --force
```

## Bước 6: Cấu Hình Storage và Public Files

### 6.1. Tạo symbolic link cho storage
Thêm vào file `Dockerfile` (đã có sẵn):
```dockerfile
RUN php artisan storage:link
```

### 6.2. Upload ảnh lên Cloud (Khuyến nghị)
Railway không persistent storage, nên dùng:
- AWS S3
- Cloudinary
- DigitalOcean Spaces

Cài đặt:
```bash
composer require league/flysystem-aws-s3-v3
```

Cấu hình trong `.env`:
```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
```

## Bước 7: Custom Domain (Tùy chọn)

1. Vào Settings → Networking → Generate Domain
2. Railway cung cấp domain miễn phí: `your-app.railway.app`
3. Hoặc thêm custom domain của bạn

## Bước 8: Monitoring và Logs

### Xem Logs:
1. Vào service dashboard
2. Click tab "Logs" để xem real-time logs

### View Metrics:
- CPU, Memory, Network usage trong tab "Metrics"

## Bước 9: Troubleshooting

### Lỗi 500 Internal Server Error:
```bash
# Vào Shell và chạy:
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Database connection error:
- Kiểm tra lại database variables
- Đảm bảo MySQL service đang chạy
- Test connection: `php artisan migrate:status`

### Missing APP_KEY:
```bash
php artisan key:generate
# Copy key từ .env và paste vào Railway Variables
```

### Permission denied (storage):
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Bước 10: Auto Deploy

Railway tự động deploy khi:
- Push code mới lên GitHub branch đã kết nối
- Thay đổi environment variables

Để tắt auto-deploy:
- Vào Settings → turn off "Auto Deploy"

## Lệnh Hữu Ích

### Clear all caches:
```bash
php artisan optimize:clear
```

### Rebuild app:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Check app status:
```bash
php artisan about
```

## Chi Phí

Railway cung cấp:
- **Free tier**: $5 credit/tháng (đủ cho development)
- **Hobby plan**: $5/tháng cho mỗi service
- **Pro plan**: Pay as you go

## Lưu Ý Quan Trọng

1. ⚠️ **APP_DEBUG=false** trong production
2. ⚠️ **Backup database** thường xuyên
3. ⚠️ **Dùng Queue** cho heavy tasks
4. ⚠️ **Monitor logs** để catch errors sớm
5. ⚠️ **Use .railwayignore** để exclude unnecessary files

## Resources

- Railway Docs: https://docs.railway.app
- Laravel Deployment: https://laravel.com/docs/deployment
- Support: Discord Railway community
