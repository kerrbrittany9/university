<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";
    require_once "src/Student.php";

    $server = 'mysql:host=localhost:8889;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
        }
        function testSave()
        {
            $name = "Econ";
            $course_number = 1235;

            $test_course = new Course($name, $course_number);


            $executed = $test_course->save();
            $this->assertTrue($executed, "Course not successfully saved");
        }

        function testGetAll()
        {
            $name = "Psych";
            $course_number = 101;
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name2 = "Math";
            $course_number2 = 1201;
            $test_course2 = new Course($name2, $course_number2);
            $test_course2->save();

            $result = Course::getAll();

            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function testDeleteAll()
        {
            $name = "Calc";
            $course_number = 233;
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name2 = "Art";
            $course_number2 = 123;
            $test_course2 = new Course($name2, $course_number2);
            $test_course2->save();

            Course::deleteAll();

            $result = Course::getAll();

            $this->assertEquals([], $result);
        }

        function testGetName()
        {
            $name = "History";
            $course_number = 405;
            $test_course = new Course($name, $course_number);

            $result = $test_course->getName();

            $this->assertEquals($name, $result);
        }

        function testUpdate()
        {
            $name = "Economics";
            $course_number = 1230;
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $new_name = "Psychology";
            $test_course->update($new_name);

            $this->assertEquals($new_name, $test_course->getName());
        }

        function testFind()
        {
            $name = "Biology";
            $course_number = 3456;
            $test_course = new Course( $name, $course_number);
            $test_course->save();

            $name2 = "Geology";
            $course_number2 = 2323;
            $test_course2 = new Course($name2, $course_number2);
            $test_course2->save();

            $result = Course::find($test_course->getId());

            $this->assertEquals($test_course, $result);
        }

        function testGetStudents()
        {
            $name = "Sociology";
            $course_number = 234;
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name2 = "Billy";
            $start_date = "04-21-4243";
            $test_student = new Student($name2, $start_date);
            $test_student->save();

            $name3 = "Johnny";
            $start_date2 = "24-12-6213";
            $test_student2 = new Student($name3, $start_date2);
            $test_student2->save();

            $test_course->addStudent($test_student);
            $test_course->addStudent($test_student2);

            $result = $test_course->getStudents();
            $this->assertEquals([$test_student, $test_student2], $result);



        }

        function testAddStudent()
        {
            $name = "Math";
            $course_number = 340;
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name = "Donovan";
            $start_date = "04-14-1992";
            $test_student = new Student($name, $start_date);
            $test_student->save();

            $test_course->addStudent($test_student);

            $this->assertEquals($test_course->getStudents(), [$test_student]);
        }
    }







 ?>
