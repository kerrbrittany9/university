# _University_

#### _PHP Silex & Database Practice, 7.18.2017_

#### By _**Brittany Kerr and Dylan Lewis**_

## Description

_This PHP database exercise allows the user to be a university registrar. The user enters a course name to add to the list and can also enroll students. The course list will show students  enrolled in the class and each student has a list of courses they are enrolled in.  This is a practice in many to many relationships in PHP Behavior Driven Databases._

## Setup Requirements

* Ensure that the following programs are downloaded to your computer:
  * [MAMP](https://www.mamp.info/en/) for Windows or MacOS
  * [PHP](https://secure.php.net/)
  * [Composer](https://getcomposer.org/)
* Sign into github and copy repository: https://github.com/kerrbrittany9/university
* From your local console:
  * Enter Desktop by typing "cd Desktop"
  * Type "git clone [add above URL]".
  * Type "cd university" to enter directory.
  * Download dependencies by typing "composer install" in console.
* Open preferences>ports on MAMP and verify that Apache Port is 8888.
* Go to preferences>web server and click the file folder next to document root.
  * Click web folder and hit select.
  * Click ok at the bottom of preferences.
  * Click start server.
* In browser type "localhost:8888/phpmyadmin"
  * Click 'import' tab, choose file 'university.sql.zip' and select 'go' to import database.
* In your browser, type 'localhost:8888' to view the webpage.


## Specifications
```
1. Behavior: The user can input a name that will add to course list.
    * Input: Math 101
    * Output : Courses:
            1. Spanish 200
            2. Math 101
```
```
2. Behavior: The user can add a student to the student list:
    * Input: Parker Posey
    * Output: University Students:
            1. Beyonce
            2. Parker Posey
```
```
3. Behavior: The client can update course name.
    * Input: Spanish 101
    * Output: Course renamed to Spanish 101.
```
```
4.Behavior: The program can update a student's name.
    * Input: May
    * Output: Mary is now renamed Mary.
```
## Technologies Used

* _PHP_
* _HTML_
* _Bootstrap CSS_
* _Silex_
* _Twig_
* _Composer_
* _MAMP_

### License

Copyright &copy; 2017 Brittany Kerr and Dylan Lewis

This software is licensed under the MIT license.
