# Magexo HR Application

Magexo is a web-based HR application with employee management capabilities, allowing you to list, add, edit, and delete employee records. It is built using Vue 3 and Laravel.

## Features

- Employee Listing: View a paginated list of employees with details such as ID, Name, Designation, Email, and Department.
- Add/Edit Employee: Add new employees or modify existing employee information with proper data validation and exception handling.
- Delete Employee: Remove employee records from the application.
- Responsive Frontend: A user-friendly frontend interface that adapts to different screen sizes.
- Pagination Support: Navigate through the employee listing using pagination.

## Technologies

The Magexo HR Application is built using the following technologies:

- Vue 3: A progressive JavaScript framework for building user interfaces.
- Laravel: A PHP web framework for backend development.
- MySQL: A relational database management system for data storage.
- Vite: A build tool for modern web applications.

## Installation

To run the Magexo HR Application on your local machine, follow these steps:

1. Clone the repository: `git clone https://github.com/lukas-vit/magexo.git`
2. Navigate to the project directory: `cd magexo`
3. Install the dependencies for both frontend and backend:
   - Frontend: `npm install`
   - Backend: `composer install`
4. Create a copy of the `.env.example` file and rename it to `.env`. Update the necessary configurations such as the database connection details.
5. Generate the application key: `php artisan key:generate`
6. Run the database migrations: `php artisan migrate`
7. Seed the database (optional): `php artisan db:seed`
8. Start the development server:
   - Frontend: `npm run dev`
   - Backend: `php artisan serve`

The application should now be running locally. You can access it in your browser at `http://localhost:8000`.

## Usage

Once the application is running, you can access the Magexo HR Application in your web browser. The landing page will display the employee listing.

- To add a new employee, click on the "Create new employee" button and fill in the required information in the provided form.
- To edit an existing employee's information, click on the edit icon button next to the respective employee's entry.
- To delete an employee, click on the delete icon button next to the respective employee's entry. A confirmation prompt will appear before the deletion is finalized.

## Tests

Unit tests have been implemented to ensure the correctness and reliability of the application's functionality. To run the tests, use the following command:

```bash
php artisan test
```

This command will execute the test suites and display the test results.

---
