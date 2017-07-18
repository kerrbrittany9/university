<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";

    $server = 'mysql:host=localhost:8889;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }
        function testSave()
        {
            $name = "Roger";
            $start_date = "04-24-1241";

            $test_student = new Student($name, $start_date);

            $executed = $test_student->save();

            $this->assertTrue($executed, "Student was not saved to database");

        }

        function testGetName()
        {
            $name = "billy";
            $start_date = "04-23-1352";

            $test_student = new Student($name, $start_date);

            $result = $test_student->getName();
            $this->assertEquals($name, $result);
        }

        function testGetAll()
        {
            $name = "Roger";
            $start_date = "04-24-1252";

            $name2 = "Tami";
            $start_date2 = "02-14-9234";

            $test_student = new Student($name, $start_date);
            $test_student->save();
            $test_student2 = new Student($name2, $start_date2);
            $test_student2->save();

            $result = Student::getAll();

            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function testDeleteAll()
        {
            $name = "John";
            $start_date = "04-24-1252";

            $name2 = "Cindy";
            $start_date2 = "02-14-9234";

            $test_student = new Student($name, $start_date);
            $test_student->save();
            $test_student2 = new Student($name2, $start_date2);
            $test_student2->save();

            Student::deleteAll();

            $result = Student::getAll();

            $this->assertEquals([], $result);
        }

        function testGetId()
        {
            $name = "Donovan";
            $start_date = "04-13-2521";
            $new_student = new Student($name, $start_date);
            $new_student->save();

            $result = $new_student->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function testFind()
        {
            $name = "Margery";
            $start_date = "04-15-6361";
            $new_student = new Student($name, $start_date);
            $new_student->save();

            $name2 = "Stacy";
            $start_date2 = "02-15-1713";
            $new_student2 = new Student($name2, $start_date2);

            $result = Student::find($new_student->getId());

            $this->assertEquals($new_student, $result);
        }

        function testUpdate()
        {
            $name = "Kevin";
            $start_date = "04-14-1513";

            $test_student = new Student($name, $start_date);
            $test_student->save();
            $new_name = "Richard";
            $test_student->update($new_name);

            $this->assertEquals($new_name, $test_student->getName());
        }

        function testGetCourses()
        {
            $name = "Ecology";
            $course_number = 345;
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name2= "Science";
            $course_number2 = 123;
            $test_course2 = new Course($name2, $course_number2);
            $test_course2->save();


            $name3 = "Sally";
            $start_date = "09-09-1212";
            $test_student = new Student($name3, $start_date);
            $test_student->save();

            $test_student->addCourse($test_course);
            $test_student->addCourse($test_course2);

            $this->assertEquals($test_student->getCourses(), [$test_course, $test_course2]);
        }

        function testAddCourse()
        {
            $name = "Computer Science";
            $course_number = 234;
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name2 = "Ryan";
            $start_date = "12-23-1234";
            $test_student = new Student($name, $start_date);
            $test_student->save();

            $test_student->addCourse($test_course);

            $this->assertEquals($test_student->getCourses(), [$test_course]);

        }
        function testDelete()
        {
            $name = "Biology";
            $course_number = 100;
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name2 = "Timothy";
            $start_date = "06-06-0666";
            $test_student = new Student($name, $start_date);
            $test_student->save();

            $test_course->addStudent($test_student);
            $test_student->delete();

            $this->assertEquals([], $test_course->getStudents());
        }


    }

 ?>
