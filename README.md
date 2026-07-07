# 📚 Bookipedia - Web-Based Book Store

Bookipedia is a comprehensive online bookstore application developed collaboratively by a team of 6 students as a university project. The platform provides a seamless shopping experience with robust backend architecture.

## 🚀 Key Features & Backend Logic
- **User Authentication:** Secure login, registration, and session management (`auth.php`, `login.php`).
- **Database Design:** A well-structured relational database schema managing inventory, users, and dynamic categories.
- **Cart Management:** Custom-built cart logic (`cart_logic.php`) to handle item additions, quantity updates, and user sessions.
- **Clean UI/UX:** Interfaces initially prototyped in Figma to ensure a modern, user-friendly aesthetic.

## 🛠️ Tech Stack
- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript (Vanilla)
- **Design:** Figma

## ⚙️ How to Run Locally
1. Clone the repository: `git clone https://github.com/YoussefElazrk/Bookipedia.git`
2. Move the project folder to your local server directory (e.g., `htdocs` for XAMPP).
3. Create a new MySQL database named `bookipedia_db` using phpMyAdmin.
4. Import the provided database file (located in the `/database` folder).
5. Update `connect.php` with your local database credentials if necessary.
6. Open your browser and navigate to `http://localhost/Bookipedia/index.php`.
