BORDERLESS ANALYSTS — PHP + MySQL blog
======================================

1. Copy the "borderless" folder into your web root (XAMPP: C:\xampp\htdocs\).
2. Start Apache + MySQL.
3. Import database.sql (phpMyAdmin > Import, or: mysql -u root -p < database.sql).
   It creates the database "borderless_blog", the tables and 3 starter posts.
4. If your MySQL user/password differ, edit includes/db.php.
5. Open http://localhost/borderless/index.php

Blog:   http://localhost/borderless/blog.php   (search bar + category filter)
Admin:  http://localhost/borderless/admin-login.php
        username: admin      password: admin123   (change it after first login)

Admin dashboard lets you create, edit and delete posts — every change is stored
in the MySQL "posts" table and appears immediately on blog.php.
