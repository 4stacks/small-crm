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
├── public/                # Publicly accessible files
│   ├── assets/           # CSS, JS, images
│   ├── index.php         # Front controller
│   └── .htaccess         # Public directory rules
└── .htaccess             # Main URL rewriting rules
```

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server with mod_rewrite enabled
- Composer (for future dependency management)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/4stacks/small-crm.git
   ```

2. Create a MySQL database named 'crm'
   ```sql
   CREATE DATABASE crm;
   ```

3. Import the database schema:
   ```bash
   mysql -u your_username -p crm < crm.sql
   ```

4. Configure your database connection:
   - Edit `/config/config.php` with your database credentials

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