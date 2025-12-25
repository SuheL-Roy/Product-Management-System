# Product Management System with API Integration

## Setup Instructions

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    cd <project_directory>
    ```

2.  **Install Composer dependencies:**
    ```bash
    composer install
    ```

3.  **Copy the `.env.example` file to `.env` and configure your database:**
    ```bash
    cp .env.example .env
    # Edit the .env file with your database credentials
    ```

4.  **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Run database migrations and seed:**
    ```bash
    php artisan migrate
    ```
9.  **Serve the application:**
    ```bash
    php artisan serve
    ```