<?php
    class Student
    {
        private $name;
        private $start_date;
        private $id;

        function __construct($name, $start_date, $id = null)
        {
            $this->name = $name;
            $this->start_date = $start_date;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setStartDate($new_date)
        {
            $this->start_date = $new_date;
        }

        function getStartDate()
        {
            return $this->start_date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO students (name, start_date) VALUES ('{$this->getName()}', '{$this->getStartDate()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $date = $student['start_date'];
                $id = $student['id'];
                $new_student = new Student($name, $date, $id);
                array_push($students, $new_student);
            }
        return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }

        static function find($search_id)
        {
            $returned_students = $GLOBALS['DB']->prepare("SELECT * FROM students WHERE id = :id;");
            $returned_students->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_students->execute();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $date = $student['start_date'];
                $id = $student['id'];
                if ($id == $search_id) {
                    $found_student = new Student($name, $date, $id);
                }
            }
        return $found_student;
        }

        function update($new_name)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setName($new_name);
                return true;
            } else {
                return false;
            }
        }
    }
 ?>
