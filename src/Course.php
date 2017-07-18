<?php
    class Course
    {
        private $name;
        private $course_number;
        private $id;

        function __construct($name, $course_number, $id = null)
        {
            $this->name = $name;
            $this->course_number = $course_number;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getCourseNumber()
        {
            return $this->course_number;
        }

        function setCourseNumber($new_number)
        {
            $this->course_number = $new_number;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO courses (name, course_number) VALUES ('{$this->getName()}', {$this->getCourseNumber()});");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }
        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses");
            $courses = array();
            foreach($returned_courses as $course) {
                $name = $course['name'];
                $course_number = $course['course_number'];
                $id = $course['id'];
                $new_course = new Course($name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM courses;");
            if ($executed) {
                return true;
            } else {
                return false;
            }

        }

        function update($new_name)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE courses SET name = '{$new_name}' WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setName($new_name);
                return true;
            } else {
                return false;
            }
        }
        static function find($search_id)
        {
            $returned_courses = $GLOBALS['DB']->prepare("SELECT * FROM courses WHERE id = :id");
            $returned_courses->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_courses->execute();
            foreach ($returned_courses as $course) {
                $course_name = $course['name'];
                $course_number = $course['course_number'];
                $course_id = $course['id'];
                if ($course_id == $search_id) {
                    $found_course = new Course($course_name, $course_number, $course_id);
                }
            }
            return $found_course;
        }

        function getStudents()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses JOIN courses_students ON (courses_students.course_id = courses.id) JOIN students ON (students.id = courses_students.student_id) WHERE courses.id = {$this->getId()};");

            $students = array();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $start_date = $student['start_date'];
                $id = $student['id'];
                $new_student = new Student($name, $start_date, $id);
                array_push($students, $new_student);
            }
        return $students;
        }

        function addStudent($student)
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$this->getId()}, {$student->getId()});");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
            if (!$executed) {
                return false;
            }
            $executed = $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE course_id = {$this->getId()};");
            if (!$executed) {
                return false;
            } else {
                return true;
            }
        }
    }
 ?>
