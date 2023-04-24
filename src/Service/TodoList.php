<?php

namespace App\Service;

class TodoList
{
    private array $ToDoList;

    public function __construct()
    {
        $this->ToDoList = [];
    }

    public function addItem(Item $item): string|bool
    {
        // test ToDolist
        if (!$this->isItemNameUnique($item->getName())) {
            return 'Item name is not unique';
        }

        if ($this->TodoListHasTooManyItem()) {
            return 'You have too many items in your list';
        }

        //test item

        if (!$item->isItemContentIsLesserThan1000Characters()) {
            return 'Item content is not lesser than 1000 characters';
        }
        if (!$item->isItemAdded30minutesAgo()) {
            return 'An Item was added in lesser than added 30 minutes ago so you must wait';
        }

        // add item if all the tests are ok
        $this->ToDoList[] = $item;
        return true;
    }

    public function isItemNameUnique(string $name): bool
    {
        foreach ($this->ToDoList as $item) {
            if ($item->getName() === $name) {
                return false;
            }
        }
        return true;
    }

    public function TodoListHasTooManyItem(): bool
    {
        if (count($this->ToDoList) >= 10) {
            return true;
        }
        return false;
    }

}
