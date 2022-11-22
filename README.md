Create a very simple Laravel web application for task management:

Create task (info to save: task name, priority, timestamps)
Edit task
Delete task
Reorder tasks with drag and drop in the browser. Priority should automatically be updated based on this. #1 priority goes at top, #2 next down and so on.
Tasks should be saved to a mysql table.
BONUS POINT: add project functionality to the tasks. User should be able to select a project from a dropdown and only view tasks associated with that project.

Install Instructions: 
1. Composer install
2. Create new db: task_manager
3. Run migrations
4. Run project on command: php artisan serve
5. Register new user: http://127.0.0.1:8000/Register
5. Login new user: http://127.0.0.1:8000/Login


Project Functionality:

1. On Navigation Bar There is Projects (Listing all Projects)
2. User should be able to create and store project in DB
3. User should be able to open project, create new project tasks, 
4. User should be able to sort them by drag and drop in the browser.
5. User should be able to edit individual task