# Laravel Project

## Installation

1. **Clone the repository**
   ```sh
   git clone https://github.com/Muniraj132/E-Commerce-Management.git
   cd your-repository
   ```

2. **Install dependencies**
   ```sh
   composer install
   npm install
   npm run dev
   ```

3. **Copy environment file**
   ```sh
   cp .env.example .env
   ```

4. **Generate application key**
   ```sh
   php artisan key:generate
   ```

5. **Configure the `.env` file** (Set database credentials and other environment variables)
   ```env
   APP_NAME=Laravel
   APP_ENV=local
   APP_KEY=base64:...
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run database migrations**
   ```sh
   php artisan migrate --seed
   ```

7. **Run the development server**
   ```sh
   php artisan serve
   ```

## Additional Configuration

- **Storage linking** (For file uploads)
  ```sh
  php artisan storage:link
  ```
## User Credentials
### Admin
```sh
email: admin@admin.com
password: password
```

### User
```sh
email: user@user.com
password: password
```
