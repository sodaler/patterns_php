<?php

interface NativeWorker
{
    public function countSalary(): int;
}

interface OutSourceWorker
{
    public function countSalaryByHour($hour);
}

class NativeDeveloper implements NativeWorker
{
    public function countSalary(): int
    {
        return 3000 * 20;
    }
}

class OutSourceDeveloper implements OutSourceWorker
{
    public function countSalaryByHour($hour): int
    {
        return $hour * 500;
    }
}

class OutSourceWorkerAdapter implements NativeWorker
{
    private OutSourceWorker $outSourceWorker;

    /**
     * @param OutSourceWorker $outSourceWorker
     */
    public function __construct(OutSourceWorker $outSourceWorker)
    {
        $this->outSourceWorker = $outSourceWorker;
    }

    public function countSalary(): int
    {
        return $this->outSourceWorker->countSalaryByHour(80);
    }
}

$nativeDeveloper = new NativeDeveloper();
$outSourceDeveloper = new OutSourceDeveloper();

$outSourceWorkerAdapter = new OutSourceWorkerAdapter($outSourceDeveloper);

var_dump($outSourceWorkerAdapter->countSalary());