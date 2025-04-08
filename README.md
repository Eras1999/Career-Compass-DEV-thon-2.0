setup instructions- Install XAMPP:
                    Download XAMPP from https://www.apachefriends.org/.
                    Install it and start Apache and MySQL from the XAMPP Control Panel.
                    Create Database:
                    Open http://localhost/phpmyadmin in your browser.
                    Create a new database named career_compass.
                    Run these SQL commands to create tables:
                    users: For registered users (id, name, email, password, created_at).
                    course_details: For courses (course_id, course_name, icon, education_level, stream, result, higher_education, field, qualification_level, study_mode).
                    contact: For contact messages (id, first_name, email, message, created_at).
                    feedback: For feedback (id, name, email, message, created_at).
                    admins: For admin login (id, username, password).
                    Add a sample admin: username admin, password admin123 (hash it using PHP's password_hash()).
                    Set Up Files:
                    Go to C:\xampp\htdocs (Windows) or /Applications/XAMPP/htdocs (Mac).
                    Create a folder named career_compass.
                    Inside career_compass, create these folders:
                    assets/img/: For images like about cover.jpg, career-path-image.png, etc.
                    images/: For logo and icons like cclogo.jpg, cs-icon.png.
                    includes/: For navigation.php and footer.php.
                    Add all website files: index.php, about.php, career_path.php, contact_us.php, admin_login.php, admin_panel.php, etc.
                    Add Images:
                    Place all required images in assets/img/ and images/ (e.g., cclogo.jpg, about cover.jpg, course icons).
                    Test the Website: https://sahans.online/
                    Open  in your browser.
                    Check all pages (Home, About Us, Career Path, Contact Us).
                    Test the admin panel: Go to (https://sahans.online/admin), log in with username ssadmin and password SS2025  

tech stack-       Frontend: HTML, CSS, Bootstrap 5.3, Font Awesome 6.4
                  Backend: PHP 7.4+
                  Database: MySQL/MariaDB
                  Libraries: SweetAlert2
                  Server: Apache (via XAMPP/WAMP/MAMP)

team members names-Ruvindu Parakrama 
                   Sethma Gunathilake
                   Sahan Sandaruwan
                   Eranda Madusanka
                   Shehani Siriwardane
