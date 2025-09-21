# Small CRM

A modern Customer Relationship Management (CRM) system built with PHP following the MVC architecture.

## Features

### Authentication System
- User registration with email verification
- Secure login with remember me functionality
- Password reset capability
- Session management
- Role-based access control (Admin/User)

### Ticket Management
- Create and manage support tickets
- Priority levels (Low/Medium/High)
- Status tracking (Open/In Progress/Closed)
- Comment system on tickets
- File attachments support
- Email notifications for updates

### Admin Dashboard
- User management
- Ticket overview and statistics
- Activity monitoring
- System settings

### Security Features
- PDO with prepared statements for DB operations
- Password hashing using PHP's password_hash
- CSRF protection
- XSS prevention
- Input validation and sanitization

## Technical Stack

- PHP 8.1+
- MySQL 8.0+
- Bootstrap 5
- Docker & Docker Compose

## Project Structure

```
small-crm/
├── app/                    # Application core files
│   ├── Controllers/       # Controller classes
│   ├── Models/           # Model classes
│   ├── Views/            # View templates
│   └── Core/             # Core framework classes
├── database/              # Database migrations and seeds
│   ├── migrations/       # Database structure
│   └── seeds/           # Sample data
├── config/                # Configuration files
│   ├── config.php        # Main configuration
│   └── routes.php        # Route definitions
├── public/                # Publicly accessible files
│   ├── assets/           # CSS, JS, images
│   ├── vendor/          # Third-party libraries
│   ├── index.php         # Front controller
│   └── .htaccess         # Public directory rules
├── storage/               # Application storage
├── docker-compose.yml     # Docker configuration
├── Dockerfile            # PHP container definition
├── .env                  # Environment variables
└── .htaccess             # Main URL rewriting rules
```

## Requirements

### Option 1: Docker (Recommended)
- Docker
- Docker Compose

### Option 2: Manual Installation
- PHP 8.1 or higher
- MySQL 8.0 or higher
- Apache web server with mod_rewrite enabled
- Composer (for future dependency management)

## Installation

### Using Docker (Recommended)

1. Clone the repository:
   ```bash
   git clone https://github.com/4stacks/small-crm.git
   cd small-crm
   ```

2. Copy the example environment file:
   ```bash
   cp .env.example .env
   ```

3. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```

4. Set up the database:
   ```bash
   # Run migrations and seed the database
   docker-compose exec app php database/setup.php --fresh --seed
   ```

The application will be available at http://localhost:8080

### Default Login Credentials

After seeding the database, you can log in with these default accounts:

**Admin User:**
- Email: admin@example.com
- Password: admin123

**Regular User:**
- Email: user@example.com
- Password: user123

## Database Configuration

The Docker setup includes a MySQL container with the following default configuration:

```env
DB_HOST=db
DB_PORT=3306
DB_DATABASE=small_crm
DB_USERNAME=crm_user
DB_PASSWORD=crm_password
```

These settings are defined in the `.env` file and can be modified as needed.

## Development

### Rebuilding the Database

To reset the database and reload sample data:

```bash
docker-compose exec app php database/setup.php --fresh --seed
```

### Database Management

The project includes a simple database migration system:

- `database/migrations/migrate.php`: Defines the database structure
- `database/seeds/seed.php`: Provides sample data for testing

### Common Docker Commands

```bash
# Start the containers
docker-compose up -d

# Stop the containers
docker-compose down

# View container logs
docker-compose logs -f

# Access the PHP container shell
docker-compose exec app bash

# Access the MySQL shell
docker-compose exec db mysql -u crm_user -p small_crm
```

## Testing

The application includes several test users and tickets after seeding. You can:

1. Log in as an admin to:
   - Manage users
   - View all tickets
   - Monitor system activity
   - Change system settings

2. Log in as a regular user to:
   - Create and manage tickets
   - Update your profile
   - View your activity history

## Security Notes

1. Change default passwords in production
2. Update the `.env` file with secure credentials
3. Configure proper email settings for notifications
4. Enable HTTPS in production
5. Regularly update dependencies

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

### Docker Commands
- Start containers: `docker-compose up -d`
- Stop containers: `docker-compose down`
- View logs: `docker-compose logs`
- Rebuild containers: `docker-compose up --build`

### Manual Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/4stacks/small-crm.git
   ```

2. Create a MySQL database:
   ```sql
   CREATE DATABASE small_crm;
   ```

3. Import the database schema:
   ```bash
   mysql -u your_username -p small_crm < crm.sql
   ```

4. Configure your database connection:
   - Copy `.env.example` to `.env`
   - Edit `.env` with your database credentials

5. Set up your web server:
   - Point your web root to the `/public` directory
   - Ensure mod_rewrite is enabled
   - Verify .htaccess files are allowed

## Default Credentials

### Admin Panel
- URL: `/admin`
- Username: admin
- Password: admin

### User Panel
- URL: `/`
- Email: demo@example.com
- Password: demo123

## Features

- User Authentication
- User Profile Management
- Support Ticket System
- Quote Request Management
- Admin Dashboard
- User Access Logs
- Responsive Design

## Docker Setup

### Prerequisites
- Docker
- Docker Compose
- Git

### Installation Steps

1. Clone the repository:
```bash
git clone https://github.com/4stacks/small-crm.git
cd small-crm
```

2. Copy environment file:
```bash
cp .env.example .env
```

3. Update the .env file with your desired configuration:
```env
DB_HOST=db
DB_PORT=3306
DB_NAME=small_crm
DB_USER=crm_user
DB_PASS=your_secure_password
```

4. Build and start the Docker containers:
```bash
docker-compose up -d
```

5. Install PHP dependencies:
```bash
docker-compose exec app composer install
```

6. Database Setup and Management:

#### Initial Database Setup
```bash
# Fresh install with sample data
docker-compose exec app php database/setup.php --fresh --seed

# Fresh install without sample data
docker-compose exec app php database/setup.php --fresh

# Run only pending migrations
docker-compose exec app php database/setup.php
```

#### Database Migrations
```bash
# Run specific migration
docker-compose exec app php database/migrations/migrate.php

# Rollback last migration
docker-compose exec app php database/migrations/migrate.php --rollback

# Reset and recreate all tables
docker-compose exec app php database/migrations/migrate.php --fresh

# Show migration status
docker-compose exec app php database/migrations/migrate.php --status
```

#### Database Seeding
```bash
# Seed the database with sample data
docker-compose exec app php database/seeds/seed.php

# Seed specific data
docker-compose exec app php database/seeds/seed.php --class=UsersSeeder
docker-compose exec app php database/seeds/seed.php --class=TicketsSeeder

# Fresh install with specific seeders
docker-compose exec app php database/setup.php --fresh --seed --class=UsersSeeder,TicketsSeeder
```

#### Database Backup and Restore
```bash
# Create backup
docker-compose exec db mysqldump -u root -p small_crm > backup.sql

# Restore from backup
docker-compose exec -T db mysql -u root -p small_crm < backup.sql

# Create backup of specific tables
docker-compose exec db mysqldump -u root -p small_crm users tickets > tables_backup.sql
```

#### Troubleshooting Database Issues
```bash
# Check database status
docker-compose exec db mysql -u root -p -e "SHOW DATABASES;"
docker-compose exec db mysql -u root -p -e "USE small_crm; SHOW TABLES;"

# Reset database user password
docker-compose exec db mysql -u root -p -e "ALTER USER 'crm_user'@'%' IDENTIFIED BY 'new_password';"

# Check database logs
docker-compose logs db
```

7. Access the application at http://localhost:8080

### Docker Container Structure

The application runs in three containers:
- **app**: PHP-FPM 8.0 application server
- **web**: Nginx web server
- **db**: MySQL 8.0 database server

### Useful Docker Commands

```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# View container logs
docker-compose logs -f

# Access PHP container shell
docker-compose exec app bash

# Access MySQL shell
docker-compose exec db mysql -u root -p

# Rebuild containers
docker-compose up -d --build
```

### Common Issues and Solutions

#### Database Connection Issues
```bash
# Check if database container is running
docker-compose ps

# Verify database connection from PHP container
docker-compose exec app php -r "var_dump(mysqli_connect('db', 'root', 'your_password', 'small_crm'));"

# Check database logs
docker-compose logs db
```

#### Permission Issues
```bash
# Fix storage directory permissions
docker-compose exec app chown -R www:www storage/
docker-compose exec app chmod -R 755 storage/

# Fix cache directory permissions
docker-compose exec app php artisan cache:clear
docker-compose exec app chmod -R 775 bootstrap/cache
```

#### Container Issues
```bash
# Remove all containers and volumes (fresh start)
docker-compose down -v

# Rebuild specific container
docker-compose up -d --build app

# Check container logs
docker-compose logs -f app
docker-compose logs -f web
docker-compose logs -f db
```

#### PHP Issues
```bash
# Check PHP version and extensions
docker-compose exec app php -v
docker-compose exec app php -m

# Clear PHP opcode cache
docker-compose exec app php -r "opcache_reset();"

# Check PHP error logs
docker-compose exec app tail -f /var/log/php-fpm/error.log
```

## Security Features

- Password Hashing using PHP's password_hash
- Secure Session Management
- XSS Protection with output escaping
- CSRF Protection with tokens
- SQL Injection Prevention using PDO
- Input Validation and Sanitization
- Secure File Handling with type checking

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

- Original template design by [Template Provider]
- Icons by Font Awesome
- CSS Framework: Bootstrap