# 🎓 College Event Management System (CEMS)

A web-based **College Event Management System** that allows students to register for events and administrators to manage events and participants efficiently.

🌐 **Live Website:**
https://cems.infinityfreeapp.com/


# Features
### 👨‍🎓 Student Features

* Student Registration
* Student Login Authentication
* View Available Events
* Register for Events
* Prevents duplicate event registrations

### 🛠 Admin Features

* Admin Login System
* Create New Events
* Manage Existing Events
* Delete Events
* View Registered Participants
* Dashboard with live statistics

### 🎨 User Interface

* Modern **black & orange themed UI**
* Responsive design using **Bootstrap**
* Interactive buttons and icons
* Popup confirmation for event registration

# 🧑‍💻 Tech Stack

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap

### Backend

* PHP

### Database

* MySQL

### Deployment

* InfinityFree Hosting
* phpMyAdmin

# 📂 Project Structure

```
CEMS
│
├── assets/
│   ├── css/
│   │   └── style.css
│
├── includes/
│   └── db.php
│
├── index.php
├── student_login.php
├── student_register.php
├── student_dashboard.php
├── view_events.php
├── register_event.php
│
├── admin_login.php
├── admin_dashboard.php
├── create_event.php
├── manage_events.php
├── view_participants.php
├── delete_event.php
│
└── README.md
```

# 📊 System Workflow

### Student Side

```
Register
↓
Login
↓
View Events
↓
Register for Event
```

### Admin Side

```
Admin Login
↓
Create Events
↓
Manage Events
↓
View Participants
```

# 🔐 Security Features

* Password hashing using `password_hash()`
* Password verification using `password_verify()`
* Prepared SQL statements to prevent SQL injection
* Session-based authentication


# ⚙️ Installation (Local Setup)

1. Install **XAMPP**
2. Clone this repository

```
git clone https://github.com/yourusername/CEMS.git
```

3. Move the project to:

```
xampp/htdocs/
```

4. Create a MySQL database:

```
college_event_db
```

5. Import the database using **phpMyAdmin**

6. Update database credentials in:

```
includes/db.php
```

7. Run the project:

```
http://localhost/CEMS
```

# 🌐 Live Deployment

The project is deployed using **InfinityFree hosting**.

🔗 **Live Demo:**
https://cems.infinityfreeapp.com/

Developed as a college project for learning **Full Stack Web Development with PHP & MySQL**.

# ⭐ Future Improvements

* Event search and filtering
* Email confirmation for event registration
* Admin analytics dashboard with charts
* QR-based event check-in
* Mobile app integration

# 📜 License

This project is created for educational purposes.
