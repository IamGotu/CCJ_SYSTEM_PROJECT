HOW TO RUN THE PROJECT (CCJ_SYSTEM_PROJECT)

1. Download the code from https://github.com/IamGotu/CCJ_SYSTEM_PROJECT

2. If xampp is not installed download it here https://www.apachefriends.org/index.html and install it (skipped if already downloaded/installed)

3. Open the xampp and start the module Apache and MySQL

4. If MySQL module is not starting, open Task Manager

5. End task mysqld, then start the MySQL module again

6. Install NodeJS here: https://nodejs.org/en

7. Open terminal located in folder CCJ_SYSTEM_PROJECT and type "npm install"

8. Check if the list requirements (PHP extension php_zip, php_xml, php_gd, php_iconv, php_simplexml, php_xmlreader, php_zlib) for excel import is enabled. Type in the terminal "php -m".

9. To enable the requirements to import excel in PHP (ini.php). Go to xampp find Config(aligned to the module Apache) press it to open PHP (ini.php). Sample to enable: ;extension=zip to extension=zip.

10. Navigate to your project folder: example, C:\xampp\htdocs\CCJ_SYSTEM_PROJECT.

11. Right-click the folder and choose Properties.

12. Go to the "Security" tab and ensure that your user account has the appropriate permissions (read, write, modify).

13. If necessary, edit the permissions to allow full control for your user account.

14. Click Edit, select your user, and check Full Control. Click Apply and then OK to save the changes.

15. Inside folder CCJ_SYSTEM_PROJECT find the file ".env.example" and change it to ".env"

16. Open the terminal located in folder CCJ_SYSTEM_PROJECT and type "composer install"

17. Open the terminal located in folder CCJ_SYSTEM_PROJECT and type "php artisan migrate" to migrate the database

18. Open the terminal located in folder CCJ_SYSTEM_PROJECT and type "npm run dev"

19. Open the terminal located in folder CCJ_SYSTEM_PROJECT and type "php artisan serve"

20. If it says no application encryption key has been specified

21. In the terminal located in folder social_media_app type "php artisan key:generate"

22. Then try again in the terminal located in folder social_media_app the "php artisan serve"

23. Open the running server or Ctrl+click the following link