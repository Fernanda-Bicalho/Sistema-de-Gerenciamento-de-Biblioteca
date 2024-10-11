# Sistema-de-Gerenciamento-de-Biblioteca

#Linux
----------

Linux is an Operating System, like Windows and Mac OS, that makes it possible to run programs on a computer and other devices. Linux can be freely modified and distributed.

-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
#Visual Studio Code
-------------------

Visual Studio Code (VS Code) is a source code editor developed by Microsoft that combines the simplicity of a text editor with software development features.

--------------------------------------------------------------------------------------------------------------------------------------------------------------------------

#Programming Language: PHP
----------------------------

The PHP language was used to carry out the project.

------------------------------------------------------

#PHP
-------
PHP is a programming language aimed at developing web applications and creating websites.

------------------------------------------------------------------------------------------
#Docker
-----------

The docker platform was used to virtualize containers, where it had access to libraries and configuration files, in this case php and mysql database.

--------------------------------------------------------------------------------------------------------------------------------------------------------

#Comandos Linux
-------------------

1- php -S localhost:8000:  to run the port in the browser and thus access the system.

2- docker exec -it mysql-container bash: docker command to enter the mysql container.


3- docker compose start: docker command to start its execution.


4- vendor/bin/phpunit --testdox: phpunit command for unit testing


5- mkdir tests: command for folder permissions, in this case here tests.

  
6- composer require --dev phpunit/phpunit: command used to install phpunit, 
  to  perform unit tests.


7- mysql -u root -p:  command used to give access to mysql within the terminal.


8- clear:  command to clear the terminal


9- docker ps:  command to list all containers and images that are active.


10- docker run -d -p 3306:3306 --name mysql-container -e MYSQL_ROOT_PASSWORD=root mysql:


11- docker command to create and start a mysql docker container.


12- docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mysql-container:


13- command used to obtain the IP of a specific docker container.

---------------------------------------------------------------------------------------------------------------------------------------

#DBeaver
----------------

DBeaver is a SQL client software application and database administration tool. For  relational databases, it uses the JDBC application programming interface to interact with the databases through a JDBC driver. For the database management function, this software is not mandatory, we will only use this as an example, feel free to download the one you prefer.

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

#The Project
------------------

It constitutes virtual library management. you will find the shortcuts: book, loan, user, which redirect to your pages, when clicking on the book icon you will return to the beginning of the page.

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

# Home screen

# Register Button : 

Click on the new icon, you will be redirected to the page for a new registration. it can be books, loans or users.

-----------------------------------------------------------------------------------------------------------------------

# Button to Edit or Remove : 

Edit or remove the registered information, when removed, a confirmation modal will appear.

---------------------------------------------------------------------------------------------------------------------------------------------------------

# Loan Screen

# Register Button: 

Click on the new icon, you will be redirected to the page for a new registration. it can be books, loans or users.

-----------------------------------------------------------------------------------------------------------------------

# Button to Edit or Remove: 

Edit or remove the registered information, when removed, a confirmation modal will appear.

---------------------------------------------------------------------------------------------------------------------------------------------------------

# User Screen

# Register Button : 

Click on the new icon, you will be redirected to the page for a new registration. it can be books, loans or users.

---------------------------------------------------------------------------------------------------------------------------

# Button to Edit or Remove : 

Edit or remove the registered information, when removed, a confirmation modal will appear.

--------------------------------------------------------------------------------------------------




























