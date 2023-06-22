<?php

interface WorkerVisitor
{
    public function visitDeveloper(Worker $worker);

    public function visitDesigner(Worker $worker);
}

class RecorderVisitor implements WorkerVisitor
{
    private array $visited = [];

    /**
     * @return array
     */
    public function getVisited(): array
    {
        return $this->visited;
    }

    public function visitDeveloper(Worker $developer)
    {
        $this->visited[] = $developer;
    }

    public function visitDesigner(Worker $designer)
    {
        $this->visited[] = $designer;
    }
}

interface Worker
{
    public function work();

    public function accept(WorkerVisitor $visitor);
}

class Developer implements Worker
{
    public function work()
    {
        printf('developer is working' . PHP_EOL);
    }

    public function accept(WorkerVisitor $visitor)
    {
        $visitor->visitDeveloper($this);
    }
}

class Designer implements Worker
{
    public function work()
    {
        printf('designer is working' . PHP_EOL);
    }

    public function accept(WorkerVisitor $visitor)
    {
        $visitor->visitDesigner($this);
    }
}

$visitor = new RecorderVisitor();

$developer = new Developer();
$developer2 = new Developer();
$designer = new Designer();

$developer->accept($visitor);
$developer2->accept($visitor);
$designer->accept($visitor);

var_dump($visitor->getVisited());

foreach ($visitor->getVisited() as $worker) {
    $worker->work();
}
