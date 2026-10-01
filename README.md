# CodeIgniter POS TFA3

A CodeIgniter 4 Point-of-Sale application demonstrating validated customer and user account creation, record editing, and profile-picture upload with image preparation.

## Features

- Customer and user records stored in a MySQL database
- New Customer form with required full-name validation
- Required and valid email-address validation
- New User form with required and unique username validation
- Pre-filled customer and user edit forms
- Customer and user record updates
- Optional user-avatar upload
- JPG and PNG file validation
- Maximum avatar size of 2 MB
- Uploaded images prepared as 300-by-300-pixel avatars
- Generated avatar filenames stored in the database
- Placeholder image for accounts without uploaded avatars

## Application Pages

| Page | Local URL | Description |
|---|---|---|
| Home | `http://localhost:8081/` | Displays the POS home page |
| About | `http://localhost:8081/about` | Describes the application |
| Customers | `http://localhost:8081/customers` | Displays all customer accounts |
| New Customer | `http://localhost:8081/customers/new` | Creates a validated customer record |
| Users | `http://localhost:8081/users` | Displays user accounts and avatars |
| New User | `http://localhost:8081/users/new` | Creates a validated user account |

## Requirements

- PHP 8.2 or later
- Composer
- MySQL or MariaDB
- PHP MySQLi extension
- PHP GD extension
- XAMPP or another compatible local server

## Installation

1. Clone or download this repository.

2. Open a terminal inside the project folder.

3. Install the dependencies:

```bash
composer install
```

4. Copy or rename the root `env` file to `.env`.

5. Configure `.env`:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8081/'

database.default.hostname = 127.0.0.1
database.default.database = pos_system_tfa3
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

6. Enable the PHP GD extension in `php.ini`:

```ini
extension=gd
```

7. Create a MySQL database named:

```text
pos_system_tfa3
```

8. Import the included database file:

```text
pos_system_tfa3.sql
```

9. Start the CodeIgniter development server:

```bash
php spark serve --port 8081
```

For the Windows/XAMPP configuration used during development:

```powershell
& "D:\Xampp\php\php.exe" spark serve --port 8081
```

10. Open the application:

```text
http://localhost:8081/
```

## Avatar Storage

Prepared avatar images are stored in:

```text
public/uploads/avatars
```

The application accepts JPG and PNG images no larger than 2 MB. Valid images are prepared as centered 300-by-300-pixel avatars. Only the generated filename is stored in the `avatar` column of the `users` table.

Accounts without an uploaded avatar display:

```text
public/uploads/avatars/placeholder.svg
```

## Database Tables

The application uses:

- `customers`
- `users`

The `users` table includes a nullable `avatar` column for the generated image filename.

## Developer

**Janyrose Guelas**

GitHub: [@17jany](https://github.com/17jany)

Developed for the IT0049 TFA3 laboratory activity using CodeIgniter 4, PHP, MySQL, and the GD image library.