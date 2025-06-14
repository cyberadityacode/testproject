# JWT Auth flow using PHP React MYSQL - Pro

## Step 1

```
/backend/
├── config/
│   └── db.php
├── controllers/
│   ├── AuthController.php
├── middleware/
│   └── verify_token.php
├── utils/
│   ├── jwt_helper.php
├── public/
│   ├── login.php
│   ├── register.php
│   ├── get_user.php


```

## Step 2 - STEP 2: Install Firebase PHP-JWT

Install using Composer:
composer require firebase/php-jwt

## STEP 3: Database Setup with Prepared Statements

```sql
CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 email VARCHAR(100) UNIQUE NOT NULL,
 password VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## STEP 4: Create Reusable DB Connection (config/db.php)

## STEP 5: Create JWT Helper (utils/jwt_helper.php)

It is used to generate and verify JWT token using Firebase

## STEP 6: Build AuthController (controllers/AuthController.php)

Class which contain register and login function

Now Create login.php and register.php

## STEP 7: Verify Token Middleware (middleware/verify_token.php)

It will verify token and Pass user info to next script

## STEP 8: Frontend: React Integration

1. Setup Folder Structure (React)

```
src/
├── components/
│   ├── Login.jsx
│   ├── Register.jsx
│   ├── Dashboard.jsx
├── services/
│   └── authService.js
├── App.jsx
└── main.jsx


```

2. Create authService.js – 📦 Backend Integration

---

# JWT Auth Flow CRUD

```
/backend/
  ├── config/
  │   └── db.php
  ├── public/
  │   ├── login.php
  │   ├── register.php
  │   ├── tasks.php ← Your CRUD API endpoint
  ├── controllers/
  │   └── TaskController.php
  ├── models/
  │   └── TaskModel.php
  ├── services/
  │   └── TaskService.php
  ├── middlewares/
  │   └── verify_token.php
  └── utils/
      └── jwt_helper.php


```

```
| Method | Endpoint          | Description       |
| ------ | ----------------- | ----------------- |
| GET    | `/tasks.php`      | Get all tasks     |
| GET    | `/tasks.php?id=1` | Get a single task |
| POST   | `/tasks.php`      | Create a new task |
| PUT    | `/tasks.php?id=1` | Update a task     |
| DELETE | `/tasks.php?id=1` | Delete a task     |

```

All secured via JWT auth middleware.

> backend CRUD APIs for tasks in PHP (OOP & modular structure), using JWT authentication

```
backend/
├── config/
│   └── db.php
├── controllers/
│   └── TaskController.php
├── models/
│   └── TaskModel.php
├── public/
│   └── tasks.php        ← API endpoint
├── middlewares/
│   └── verify_token.php
├── utils/
│   └── jwt_helper.php   ← Already exists


```

STEP 3: verify_token.php – Middleware to Protect Routes

STEP 4: TaskModel.php – DB Access Layer

STEP 5: TaskController.php – Logic Layer

// controllers/

STEP 6: tasks.php – Public API Endpoint
// public/tasks.php

# Frontend

## API Setup

Create a Re-usable API layer using AXIOS

src/api/axiosInstance.js

2.  Create Task API Calls

src/api/taskApi.js
fetch,create, update,delete

3. React UI to Consume API

Example TaskList Component
src/components/TaskList.jsx
