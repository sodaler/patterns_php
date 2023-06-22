<?php

interface State
{
    public function toNext(Task $task);

    public function getStatus();
}

class Task
{
    private State $state;

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    public static function make(): Task
    {
        $self = new self();
        $self->setState(new Created());

        return $self;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public function proceedToNext()
    {
        $this->state->toNext($this);
    }
}

class Created implements State
{

    public function toNext(Task $task)
    {
        $task->setState(new Process());
    }

    public function getStatus(): string
    {
        return 'created';
    }
}

class Process implements State
{

    public function toNext(Task $task)
    {
        $task->setState(new Test());
    }

    public function getStatus(): string
    {
        return 'process';
    }
}

class Test implements State
{

    public function toNext(Task $task)
    {
        $task->setState(new Done());
    }

    public function getStatus(): string
    {
        return 'test';
    }

}

class Done implements State
{

    public function toNext(Task $task)
    {
    }

    public function getStatus(): string
    {
        return 'done';
    }

}

$task = Task::make();
$task->proceedToNext();
$task->proceedToNext();
var_dump($task->getState()->getStatus());