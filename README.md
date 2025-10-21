# Small CRM System

A simple Customer Relationship Management (CRM) system built with PHP and MySQL.

## Features

- User Authentication and Management
- Ticket Management System
- Product/Service Quote Requests
- User Activity Tracking
- Admin Dashboard
- User Dashboard

## Requirements

- Docker
- Docker Compose

## Setup Instructions

1. Clone the repository:
```bash
git clone https://github.com/4stacks/small-crm.git
cd small-crm
```

2. Create a `.env` file in the root directory with the following content (replace the values in curly braces):
```env
# MySQL
MYSQL_DATABASE=crm
MYSQL_ROOT_PASSWORD={your_root_password}
MYSQL_USER={your_username}
MYSQL_PASSWORD={your_password}

# PHP
PHP_VERSION=8.2

# Nginx
NGINX_PORT=80

# Application
APP_NAME=crm
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost
```

3. Build and start the Docker containers:
```bash
docker compose up --build -d
```

4. Access the application:
- Main application: http://localhost
- Admin login: http://localhost/admin

### Default Credentials

**Admin Panel:**
- Username: admin
- Password: admin

**User Panel:**
- Username: phpgurukulteam@gmail.com
- Password: Demo@123

## Docker Components

The application runs in three Docker containers:

1. **MySQL Database (db)**
   - MySQL 8.0
   - Automatically initialized with required tables
   - Data persisted in a named volume

2. **PHP Application (app)**
   - PHP 8.2-FPM
   - Required extensions: pdo_mysql, zip
   - Application code mounted from host

3. **Nginx Web Server (nginx)**
   - Latest Alpine-based Nginx
   - Serves static files
   - Proxies PHP requests to the app container

## Development

The Docker setup is configured for development with:
- Hot reload for PHP files
- Persistent MySQL data
- Environment variable configuration
- Nginx configured for PHP-FPM

## Security Notes

- Change the default admin password after first login
- In production, modify the `.env` file with secure credentials
- Consider enabling HTTPS in production

## License

This project is licensed under the MIT License - see the LICENSE file for details