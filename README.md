# Small CRM

A small Customer Relationship Management (CRM) system built with PHP following the MVC pattern.

## Project Structure

```
small-crm/
├── app/                    # Application core files
│   ├── Controllers/       # Controller classes
│   ├── Models/           # Model classes
│   ├── Views/            # View templates
│   └── Core/             # Core framework classes
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

2. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```

The application will be available at http://localhost:8080

Database connection details:
- Host: localhost
- Port: 3306
- Database: small_crm
- Username: crm_user
- Password: crm_password

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

## Security Features

- Password Hashing
- Session Management
- XSS Protection
- CSRF Protection
- SQL Injection Prevention
- Input Validation
- Secure File Handling

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