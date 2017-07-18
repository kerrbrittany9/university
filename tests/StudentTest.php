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
    }

 ?>
