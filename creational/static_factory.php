<?php

interface Worker
{
    public function work();
}

class Developer implements Worker
{
    public function work()
    {
        printf('im developing');
    }
}

class Designer implements Worker
{
    public function work()
    {
        printf('Im designing');
    }
}

class WorkerFactory
{
    public static function make($workerTitle): ?Worker
    {
        $className = strtoupper($workerTitle);

        if (class_exists($className)) {
            return new $className();
        }

        return null;
    }
}

$developer = WorkerFactory::make('designer');
$developer->work();
