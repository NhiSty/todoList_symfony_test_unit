<?php

namespace App\Tests\TodoList;
use App\Service\EmailSender;
use App\Service\Item;
use App\Service\TodoList;
use App\Service\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
class TodoListTest extends TestCase
{
    private User $user;
    private Item $item;
    private MockObject $emailSender;

    public function setUp(): void
    {
        $this->user = new User(
            'user@test.com',
            'John',
            'Doe',
            'Test1234',
            new \DateTime('now' . '- 13 years')
        );
        $this->emailSender = $this->createMock(EmailSender::class);

        $this->item = new Item('test', 'test', new \DateTime('now'));



    }

    public function testisNameUnique(): void
    {
        $todoList = new TodoList([$this->item, new Item('test2', 'test2', new \DateTime('now'))]);
        $this->assertFalse($todoList->isItemNameUnique('test'));

        $this->assertTrue($todoList->isItemNameUnique('test2'));

    }



     public function testTodoListHasTooManyItem(): void
     {
         $items = [
             new Item('test1', 'testContent1', new \DateTime('now')),
             new Item('test2', 'testContent2', new \DateTime('now')),
             new Item('test3', 'testContent3', new \DateTime('now')),
             new Item('test4', 'testContent4', new \DateTime('now')),
             new Item('test5', 'testContent5', new \DateTime('now')),
             new Item('test6', 'testContent6', new \DateTime('now')),
             new Item('test7', 'testContent7', new \DateTime('now')),
             new Item('test8', 'testContent8', new \DateTime('now')),
             new Item('test9', 'testContent9', new \DateTime('now')),
             new Item('test10', 'testContent10', new \DateTime('now')),
             new Item('test11', 'testContent11', new \DateTime('now'))

         ];

         $todoList = new TodoList($items);

         $isListContainToManyElement = $todoList->TodoListHasTooManyItem();
         $this->assertTrue($isListContainToManyElement);
     }


    public function testAddItem(): void
     {

         $this->user->getTodoList()->addItem($this->item);

         $this->assertEquals('test', $this->user->getTodoList()->getItems()[0]->getName());

         $this->item->setName('test2');
         $value = $this->user->getTodoList()->addItem($this->item);
         //var_dump($value, $this->user->getTodoList()->getItems());
         //var_dump($this->user->getTodoList()->getItems());
         $this->assertEquals('test2', $this->user->getTodoList()->getItems()[1]->getName());
     }

     public function testTodoListHasEightItem(): void
     {

         $items = [
             new Item('test1', 'testContent1', new \DateTime('now')),
             new Item('test2', 'testContent2', new \DateTime('now')),
             new Item('test3', 'testContent3', new \DateTime('now')),
             new Item('test4', 'testContent4', new \DateTime('now')),
             new Item('test5', 'testContent5', new \DateTime('now')),
             new Item('test6', 'testContent6', new \DateTime('now')),
             new Item('test7', 'testContent7', new \DateTime('now')),
             new Item('test8', 'testContent8', new \DateTime('now')),
         ];

         $todoList = new TodoList($items);

         $isTodoListHasEightItems = $todoList->TodoListHasEightItem();

         $this->emailSender->expects($this->once())
             ->method('sendEmail')
             ->willReturn(true);

         $this->assertTrue($isTodoListHasEightItems);

         $this->assertTrue($this->emailSender->sendEmail($this->user->getEmail(), "You can now add only 2 more items !"));

     }
}
