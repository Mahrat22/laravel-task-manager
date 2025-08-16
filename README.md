# Laravel Task Manager

A mini Laravel project for managing tasks and users with search and filter features.

---

## 🚀 Features

### 📌 Tasks
- Create, Edit, Delete, List tasks  
- Search tasks by title  
- Filter by task order (Under 15 / 15 and above)  
- Toggle between **Pending** and **Done** status  
- View task details  

### 👤 Users
- Search users by name  
- Filter users by age (Under 15 / 15 and above)  
- Paginated lists for both Tasks and Users  

---

## 🛣️ Routes Overview

| Route              | Method | Description                      |
|--------------------|--------|----------------------------------|
| `/`                | GET    | Redirects to `/tasks`            |
| `/tasks`           | GET    | List all tasks                   |
| `/tasks/create`    | GET    | Show create task form            |
| `/tasks`           | POST   | Store a new task                 |
| `/tasks/{id}/edit` | GET    | Show edit form for a task        |
| `/tasks/{id}`      | PUT    | Update a task                    |
| `/tasks/{id}`      | DELETE | Delete a task                    |
| `/tasks/{id}`      | GET    | View task details                |
| `/users`           | GET    | List all users (with filters)    |

---

## ⚙️ Setup

1. Clone the repo  
   ```bash
   git clone https://github.com/Mahrat22/laravel-task-manager.git
   cd laravel-task-manager
   ```

2. Install dependencies  
   ```bash
   composer install
   npm install && npm run dev
   ```

3. Configure environment  
   - Copy `.env.example` to `.env`  
   - Update database settings inside `.env`  

   ```bash
   php artisan key:generate
   php artisan migrate
   ```

4. Run the project  
   ```bash
   php artisan serve
   ```
   Project will be available at: **http://127.0.0.1:8000**
