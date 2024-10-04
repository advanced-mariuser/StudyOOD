<?php
declare(strict_types=1);

require_once __DIR__ . '/ObservableInterface.php';
require_once __DIR__ . '/../observer/ObserverInterface.php';

class Observable implements ObservableInterface
{
    protected array $observersHeap = [];
    protected array $observerMap = [];

    public function registerObserver(ObserverInterface $observer, int $priority = 0): void
    {
        if (isset($this->observerMap[spl_object_hash($observer)]))
        {
            return;
        }

        $observer->setPriority($priority);

        $this->observersHeap[] = ['observer' => $observer, 'priority' => $priority];
        $this->observerMap[spl_object_hash($observer)] = $observer;

        $this->heapifyUp(count($this->observersHeap) - 1);
    }

    public function notifyObservers(): void
    {
        $data = $this->getChangedData();

        foreach ($this->observersHeap as $entry)
        {
            $entry['observer']->update($data);
        }
    }

    public function removeObserver(ObserverInterface $observer): void
    {
        $observerKey = spl_object_hash($observer);
        if (!isset($this->observerMap[$observerKey]))
        {
            return;
        }

        unset($this->observerMap[$observerKey]);

        foreach ($this->observersHeap as $key => $entry)
        {
            if ($entry['observer'] === $observer)
            {
                $this->swap($key, count($this->observersHeap) - 1);
                array_pop($this->observersHeap);
                $this->heapifyDown($key);
                break;
            }
        }
    }

    //добавление элемента в кучу (проверка что потомок меньше чем родитель)
    private function heapifyUp(int $index): void
    {
        while ($index > 0)
        {
            $parentIndex = intdiv($index - 1, 2);
            if ($this->observersHeap[$index]['priority'] <= $this->observersHeap[$parentIndex]['priority'])
            {
                break;
            }
            $this->swap($index, $parentIndex);
            $index = $parentIndex;
        }
    }

    //удаление элемента кучи (перестройка кучи при удалении узла с детьми)
    private function heapifyDown(int $index): void
    {
        $lastIndex = count($this->observersHeap) - 1;
        while ($index < $lastIndex)
        {
            $leftChild = 2 * $index + 1;
            $rightChild = 2 * $index + 2;
            $largest = $index;

            if ($leftChild <= $lastIndex && $this->observersHeap[$leftChild]['priority'] > $this->observersHeap[$largest]['priority'])
            {
                $largest = $leftChild;
            }

            if ($rightChild <= $lastIndex && $this->observersHeap[$rightChild]['priority'] > $this->observersHeap[$largest]['priority'])
            {
                $largest = $rightChild;
            }

            if ($largest === $index)
            {
                break;
            }

            $this->swap($index, $largest);
            $index = $largest;
        }
    }

    private function swap(int $index1, int $index2): void
    {
        $temp = $this->observersHeap[$index1];
        $this->observersHeap[$index1] = $this->observersHeap[$index2];
        $this->observersHeap[$index2] = $temp;
    }

    protected function getChangedData(): ?WeatherDataInfo
    {
        // This method should be overridden in subclasses
        return null;
    }
}
