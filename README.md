# rate-my-dorm
Rate My Dorm was my final project for CSCI 284 (Database Design with Web Applications). It was a website that allowed students to rate dorms at the University of the South (Sewanee). Users could create an account to rate dorms, ask and answer questions about dorms, and provide comments about their ratings.

This project uses MySQL, PHP, JavaScript, HTML, and CSS.

# Security & Redacted Information
It is a very bad idea to make your PHP code and SQL scripts public. I am only making this public because the school removed our databases and access priveleges after this course. Even though the site is no longer up, I have still opted to redact the database username, password, and host address out of caution. I've also removed all of the contact information we made for this project.

# Installation
Note: Luckily, our IT department installed and configured MySQL and Apache for each computer in our classroom. Unfortunately, I don't know every step they took, so additional steps may be needed and the process may vary depending on your setup.

1. Install and configure [MySQL](https://www.mysql.com/)

2. Modify the `databaseBuild.sql` script to use whatever username and password you'd like

3. Run MySQL and execute the `databaseBuild.sql` script

4. Install and setup a web server to serve the `RateMyDorm` folder and access the MySQL database

5. Modify the `functions.php` file to use your database username, password, and host address
