# ✅ Railway Deployment Checklist

## Trước Khi Deploy

- [ ] Code đã được test kỹ lưỡng ở local
- [ ] File `.env.example` đã có đầy đủ các biến cần thiết
- [ ] Dockerfile hoạt động tốt (test local: `docker build -t test .`)
- [ ] Frontend assets đã được build (`npm run build`)
- [ ] Composer dependencies đã được cài (`composer install`)
- [ ] Git repository đã được push lên GitHub

## Chuẩn Bị Railway

- [ ] Tạo tài khoản Railway (https://railway.app)
- [ ] Liên kết GitHub với Railway
- [ ] Tạo project mới trên Railway

## Cấu Hình Database

- [ ] Provision MySQL database trong Railway project
- [ ] Lưu lại MySQL connection details
- [ ] Test connection từ local (optional)

## Deploy Application

- [ ] Tạo service mới từ GitHub repo
- [ ] Railway đã detect Dockerfile và build thành công
- [ ] Service đang running (check status)

## Environment Variables

### Cốt Lõi (Bắt Buộc)
- [ ] `APP_NAME` - Tên ứng dụng
- [ ] `APP_ENV=production`
- [ ] `APP_KEY` - Generate từ `php artisan key:generate --show`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` - URL từ Railway (https://your-app.railway.app)

### Database (Bắt Buộc)
- [ ] `DB_CONNECTION=mysql`
- [ ] `DB_HOST` - Từ MySQL service
- [ ] `DB_PORT` - Từ MySQL service
- [ ] `DB_DATABASE` - Từ MySQL service
- [ ] `DB_USERNAME` - Từ MySQL service
- [ ] `DB_PASSWORD` - Từ MySQL service

### Session & Cache
- [ ] `SESSION_DRIVER=database`
- [ ] `CACHE_STORE=database`
- [ ] `QUEUE_CONNECTION=database`

### Mail (Nếu Dùng)
- [ ] `MAIL_MAILER=smtp`
- [ ] `MAIL_HOST`
- [ ] `MAIL_PORT`
- [ ] `MAIL_USERNAME`
- [ ] `MAIL_PASSWORD`
- [ ] `MAIL_ENCRYPTION=tls`
- [ ] `MAIL_FROM_ADDRESS`

### Payment (Nếu Dùng)
- [ ] PayPal credentials
- [ ] VNPay credentials
- [ ] Update return URLs với Railway domain

## Post-Deployment

- [ ] Migration chạy thành công
  ```bash
  php artisan migrate:status
  ```

- [ ] Seed database nếu cần
  ```bash
  php artisan db:seed --force
  ```

- [ ] Test các routes chính
  - [ ] Homepage
  - [ ] Login/Register
  - [ ] Dashboard
  - [ ] Courses
  - [ ] Cart
  - [ ] Checkout

- [ ] Test upload files/images

- [ ] Test payment integration

- [ ] Check logs không có error
  - Railway Dashboard → Logs tab

## Optimization

- [ ] Cache đã được clear
  ```bash
  php artisan optimize
  ```

- [ ] Config cached
  ```bash
  php artisan config:cache
  ```

- [ ] Routes cached
  ```bash
  php artisan route:cache
  ```

- [ ] Views cached
  ```bash
  php artisan view:cache
  ```

## Security

- [ ] `APP_DEBUG=false` trong production
- [ ] HTTPS được enable (Railway tự động)
- [ ] Sensitive data không có trong git history
- [ ] `.env` trong `.gitignore`
- [ ] CORS configured đúng (nếu có API)

## Monitoring

- [ ] Setup error tracking (Sentry, Bugsnag)
- [ ] Monitor Railway metrics
- [ ] Setup uptime monitoring
- [ ] Configure log rotation

## Domain & SSL

- [ ] Sử dụng Railway domain hoặc
- [ ] Configure custom domain
- [ ] SSL certificate active (auto với Railway)

## Backup

- [ ] Setup database backup schedule
- [ ] Backup environment variables
- [ ] Document deployment process

## Performance

- [ ] Enable OPcache
- [ ] Use CDN cho static assets
- [ ] Optimize images
- [ ] Enable gzip compression

## Final Checks

- [ ] Website accessible công khai
- [ ] Không có 500 errors
- [ ] Assets loading correctly
- [ ] Database queries working
- [ ] Authentication working
- [ ] Email sending (test)
- [ ] Payment processing (test)

## Common Issues & Fixes

### 500 Error
```bash
php artisan optimize:clear
php artisan config:cache
```

### Missing APP_KEY
```bash
php artisan key:generate --show
# Add to Railway Variables
```

### Storage Permission
```bash
chmod -R 775 storage bootstrap/cache
```

### Database Connection
- Check MySQL service is running
- Verify environment variables
- Test: `php artisan migrate:status`

---

📝 **Note**: Sau mỗi thay đổi code, Railway sẽ tự động redeploy.

📖 **Full Guide**: Xem `RAILWAY_DEPLOYMENT.md` để biết chi tiết.
