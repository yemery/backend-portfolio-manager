
# Developer Portfolio Backend

This repository contains the backend code for managing portfolios of developers across various domains. It includes endpoints for managing projects, skills, blogs, personal information, and services and more

## Technologies Used

- Laravel 10
- MySQL
- Laravel Sanctum

## Requirements

Before cloning this repository, ensure you have the following installed:

- [PHP](https://www.php.net/downloads.php) (>= 7.4)
- [XAMPP](https://www.apachefriends.org/download.html) or any other AMP (Apache, MySQL, PHP) stack
- [Composer](https://getcomposer.org/download/)

## Setup

1. Clone the repository.
2. Install dependencies using `composer install`.
3. Configure your `.env` file with appropriate database credentials.
4. Generate an application key `php artisan key:generate`.
5. Run migrations and seed the database with `php artisan migrate`.
6. Start the development server with `php artisan serve`.

## API Endpoints

Below are the RESTful endpoints provided by this backend. Screenshots using Insomnia are provided for testing purposes.

### Projects

- `GET /api/projects`: Get all projects.
- `GET /api/projects/{id}`: Get a specific project by ID.
- `POST /api/projects`: Create a new project.
- `PUT /api/projects/{id}`: Update an existing project.
- `DELETE /api/projects/{id}`: Delete a project.

### Skills

- `GET /api/skills`: Get all skills.
- `GET /api/skills/{id}`: Get a specific skill by ID.
- `POST /api/skills`: Create a new skill.
- `PUT /api/skills/{id}`: Update an existing skill.
- `DELETE /api/skills/{id}`: Delete a skill.

### Blogs

- `GET /api/blogs`: Get all blogs.
- `GET /api/blogs/{id}`: Get a specific blog by ID.
- `POST /api/blogs`: Create a new blog.
- `PUT /api/blogs/{id}`: Update an existing blog.
- `DELETE /api/blogs/{id}`: Delete a blog.

### Personal Information

- `GET /api/personal-info`: Get personal information.
- `PUT /api/personal-info`: Update personal information.

### Services

- `GET /api/services`: Get all services.
- `GET /api/services/{id}`: Get a specific service by ID.
- `POST /api/services`: Create a new service.
- `PUT /api/services/{id}`: Update an existing service.
- `DELETE /api/services/{id}`: Delete a service.

## Testing

Screenshots of testing the API endpoints using Insomnia are provided in the `screenshots` directory.

## Contributing

Contributions are welcome! Feel free to open issues or submit pull requests.
