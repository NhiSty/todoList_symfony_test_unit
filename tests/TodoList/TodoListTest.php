<?php

namespace App\Tests\TodoList;
use App\Service\Item;
use App\Service\TodoList;
use App\Service\User;
use PHPUnit\Framework\TestCase;
class TodoListTest extends TestCase
{
    private User $user;
    private Item $item;
    public function setUp(): void
    {
        $this->user = new User(
            'user@test.com',
            'John',
            'Doe',
            'Test1234',
            new \DateTime('now' . '- 13 years')
        );

        $this->item = new Item('test', 'test', new \DateTime('now'));



    }
    public function testisNameUnique(): void
    {
        $todoList = new TodoList([$this->item, new Item('test2', 'test2', new \DateTime('now'))]);
        $this->assertFalse($todoList->isItemNameUnique('test'));

        $this->assertTrue($todoList->isItemNameUnique('test2'));


    }

    /* public function testTodoListHasTooManyItem(): void
     {

     }

     public function testAddItem(): void
     {

         $this->user->getTodoList()->addItem($this->item);

         $this->assertEquals('test', $this->user->getTodoList()->getItems()[0]->getName());

         $this->item->setName('test2');
         $value = $this->user->getTodoList()->addItem($this->item);
         var_dump($value, $this->user->getTodoList()->getItems());
         var_dump($this->user->getTodoList()->getItems());
         //$this->assertEquals('test2', $this->user->getTodoList()->getItems()[1]->getName());
     }*/

}
