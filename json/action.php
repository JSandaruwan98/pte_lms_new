<?php
class Action
{
    private $_name = "";
    private $_url = "";
    private $_table_name = "";

    // Getters
    public function getClassId()
    {
        return $this->_class_id;
    }

    public function getClassName()
    {
        return $this->_class_name;
    }

    public function getClassDays()
    {
        return $this->_class_days;
    }

    // Setters
    public function setClassId($class_id)
    {
        $this->_class_id = $class_id;
    }

    public function setClassName($class_name)
    {
        $this->_class_name = $class_name;
    }

    public function setClassDays($class_days)
    {
        $this->_class_days = $class_days;
    }
}
?>