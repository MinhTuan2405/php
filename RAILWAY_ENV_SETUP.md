# Hướng Dẫn Import Environment Variables Vào Railway

## Bước 1: Generate APP_KEY

Trước tiên, bạn cần generate APP_KEY. Chạy lệnh local:

```bash
php artisan key:generate --show
```

Sẽ ra kết quả dạng: `base64:abc123xyz...`

## Bước 2: Import Variables Vào Railway

### Cách 1: Copy từ file .env.railway (Khuyến nghị)

1. Mở file `.env.railway` 
2. **CẬP NHẬT** các giá trị sau:
   - `APP_KEY` - Paste key vừa generate ở bước 1
   - `APP_URL` - Domain Railway của bạn (vd: https://php-final-production.up.railway.app)
   - `MAIL_USERNAME`, `MAIL_PASSWORD` - Nếu dùng email
   - `VNPAY_RETURN_URL` - URL Railway của bạn + /vnpay/return
   - PayPal và VNPay credentials nếu cần

3. Vào Railway Dashboard → Service của bạn → **Variables** tab
4. Click **Raw Editor** (góc phải trên)
5. Copy toàn bộ nội dung file `.env.railway` (đã cập nhật)
6. Paste vào Raw Editor
7. Click **Save**

### Cách 2: Import từng biến (Nếu cách 1 không work)

Vào Railway Dashboard → Variables → Add Variable, thêm từng biến sau:

#### Core Settings (Bắt Buộc)
```
APP_NAME=Laravel Course Platform
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.railway.app
APP_TIMEZONE=Asia/Ho_Chi_Minh
```

#### Database (Bắt Buộc)
```
DB_CONNECTION=mysql
DB_HOST=${{RAILWAY_PRIVATE_DOMAIN}}
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=rPXBLqYVhTsYFiVtULaNWriYZZMZJOQI
```

#### Session & Cache (Bắt Buộc)
```
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=public
```

#### Logging (Bắt Buộc)
```
LOG_CHANNEL=stack
LOG_LEVEL=error
```

#### Mail (Tùy chọn - Nếu dùng)
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME=Laravel Course Platform
```

#### PayPal (Tùy chọn)
```
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID=your-client-id
PAYPAL_SANDBOX_SECRET=your-secret
```

#### VNPay (Tùy chọn)
```
VNPAY_TMN_CODE=your-tmn-code
VNPAY_HASH_SECRET=your-hash-secret
VNPAY_URL=https://sandbox.vnpayment.vn/paymentv2/vpcpay.html
VNPAY_RETURN_URL=https://your-app.railway.app/vnpay/return
```

## Bước 3: Verify Variables

Sau khi save, Railway sẽ tự động redeploy. Kiểm tra:

1. Vào **Deployments** tab → Click deployment mới nhất
2. Xem **Logs** để đảm bảo không có lỗi
3. Deployment status phải là **SUCCESS** màu xanh

## Bước 4: Chạy Migration

Nếu migration chưa chạy tự động, vào **Shell** và chạy:

```bash
php artisan migrate --force
php artisan db:seed --force
```

## Bước 5: Test Application

1. Mở URL Railway của bạn
2. Test các chức năng:
   - Homepage load được
   - Login/Register hoạt động
   - Database connection OK
   - Upload image (nếu có)

## Lưu Ý Quan Trọng

### ⚠️ APP_KEY
- **PHẢI** generate bằng `php artisan key:generate --show`
- **KHÔNG** dùng key từ local .env
- Format: `base64:...`

### ⚠️ APP_URL
- Phải là URL đầy đủ với https://
- Ví dụ: `https://php-final-production.up.railway.app`
- Lấy từ Railway → Settings → Domains

### ⚠️ Database Variables
- Railway tự động inject `${{RAILWAY_PRIVATE_DOMAIN}}`
- **KHÔNG** thay đổi `DB_HOST=${{RAILWAY_PRIVATE_DOMAIN}}`
- Password đã được set sẵn trong config

### ⚠️ Mail Configuration
- Nếu dùng Gmail, cần tạo **App Password**
- Không dùng password thông thường
- Hướng dẫn: https://support.google.com/accounts/answer/185833

### ⚠️ Payment URLs
- VNPay return URL phải match với Railway domain
- PayPal: Dùng sandbox cho test, live cho production

## Troubleshooting

### Lỗi "No application encryption key"
```bash
# Generate key local
php artisan key:generate --show
# Copy và thêm vào Railway Variables
```

### Lỗi Database Connection
- Kiểm tra MySQL service đang chạy
- Verify DB_PASSWORD đúng
- Test: `php artisan migrate:status` trong Shell

### 500 Internal Server Error
```bash
# Trong Railway Shell
php artisan config:clear
php artisan cache:clear
php artisan optimize
```

### Variables không update
- Sau khi save variables, Railway tự động redeploy
- Đợi deployment hoàn tất (~2-5 phút)
- Check logs để thấy variables mới

## Quick Commands

### Clear All Caches
```bash
php artisan optimize:clear
```

### Rebuild Caches
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Check Environment
```bash
php artisan about
php artisan env
```

### Database Status
```bash
php artisan migrate:status
php artisan db:show
```

---

✅ Sau khi hoàn tất, ứng dụng của bạn sẽ chạy hoàn toàn trên Railway!
