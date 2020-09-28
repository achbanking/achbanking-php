<?php

class OAAPIBase implements IteratorAggregate
{
    protected $data = [];
    protected $records = [];

    public function __set($name, $value)
    {
        if (is_array($this->data)) {
            $this->data[$name] = $value;
        } elseif ($this->data instanceof stdClass) {
            $this->data->{$name} = $value;
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        if (!empty($this->data)) {
            if (is_array($this->data) && !empty($this->data[$name])) {
                return $this->data[$name];
            }

            if ($this->data instanceof stdClass && property_exists($this->data, $name)) {
                return $this->data->{$name};
            }
        }

        return null;
    }

    public function __isset($name)
    {
        if (!empty($this->data)) {
            if (is_array($this->data) && isset($this->data[$name])) {
                return true;
            }

            if ($this->data instanceof stdClass && property_exists($this->data, $name)) {
                return true;
            }
        }

        return false;
    }

    public function __unset($name)
    {
        if (!empty($this->data)) {
            if (is_array($this->data) && isset($this->data[$name])) {
                unset($this->data[$name]);
            } elseif ($this->data instanceof stdClass && property_exists($this->data, $name)) {
                unset($this->data->{$name});
            }
        }
    }

    public function merge($object)
    {
        foreach ($object as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function addRecord($record)
    {
        $this->records[] = $record;
    }

    public function addRecords(OAAPIBase $records)
    {
        foreach ($records as $record) {
            $this->records[] = $record;
        }
    }

    public function setRecords($records)
    {
        $this->records = $records;
    }

    public function getIterator()
    {
        return count($this->records)
            ? new ArrayIterator($this->records)
            : new ArrayIterator($this->data);
    }
}
