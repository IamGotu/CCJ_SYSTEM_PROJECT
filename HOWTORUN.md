HOW TO RUN THE PROJECT (CCJ_SYSTEM_PROJECT)

1. Download the code from https://github.com/IamGotu/CCJ_SYSTEM_PROJECT

2. If xampp is not installed download it here https://www.apachefriends.org/index.html and install it (skipped if already downloaded/installed)

3. Open the xampp and start the module Apache and MySQL

4. If MySQL module is not starting, open Task Manager

5. End task mysqld, then start the MySQL module again

6. Install NodeJS here: https://nodejs.org/en

7. Open terminal located in folder CCJ_SYSTEM_PROJECT and type "npm install"

8. Enable the zip extension in PHP. Go to xampp find Config(aligned to the module Apache) press it to open PHP (ini.php). Then change ;extension=zip to extension=zip

9. Navigate to your project folder: example, C:\xampp\htdocs\CCJ_SYSTEM_PROJECT.

10. Right-click the folder and choose Properties.

11. Go to the "Security" tab and ensure that your user account has the appropriate permissions (read, write, modify).

12. If necessary, edit the permissions to allow full control for your user account.

13. Click Edit, select your user, and check Full Control. Click Apply and then OK to save the changes.

14. Inside folder CCJ_SYSTEM_PROJECT find the file ".env.example" and change it to ".env"

15. Open the terminal located in folder CCJ_SYSTEM_PROJECT and type "install composer"

16. Open the terminal located in folder CCJ_SYSTEM_PROJECT and type "php artisan migrate" to migrate the database

17. Open the terminal located in folder CCJ_SYSTEM_PROJECT and type "npm run dev"

18. Open the terminal located in folder CCJ_SYSTEM_PROJECT and type "php artisan serve"

19. Open the running server or Ctrl+click the following link