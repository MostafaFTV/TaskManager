# ✅ Task Manager - PHP MVC

A simple yet functional **Task Management System** built with **pure PHP** using the **MVC (Model–View–Controller)** architecture.  
The system allows users to **create, update, delete, and manage daily tasks** through a clean and organized interface.

---

## 🚀 Overview
This project was created as a web programming practice to understand PHP backend fundamentals and MVC structure.  
It demonstrates separation of concerns, dynamic routing, and CRUD operations with MySQL integration.

---

## 🧠 Features
- 👤 User Authentication (Login & Register)
- 🗂️ Create, Edit, Delete, and View Tasks
- 📅 Task Status (Pending / Completed)
- 🔄 Dynamic Routing via `Route.php`
- ⚙️ Organized MVC structure
- 💾 MySQL Database Integration

---

## 🧩 Project Structure
```text
project-root/
├── app/
│   ├── controllers/
│   │   ├── TaskController.php
│   │   └── UserController.php
│   ├── models/
│   │   ├── Task.php
│   │   └── User.php
│   └── Route.php
├── views/
│   ├── tasks/
│   ├── users/
│   └── layouts/
├── helper/
│   └── functions.php
├── config/
│   └── database.php
├── public/
│   └── index.php
└── .htaccess
