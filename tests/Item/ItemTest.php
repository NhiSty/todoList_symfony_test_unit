<?php

namespace App\Tests\Item;

use App\Service\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    private Item $item;

    public function setUp(): void
    {
        $this->item = new Item('test', 'test', new \DateTime('now'));
    }

    public function testisItemContentIsLesserThan1000Characters(): void
    {
        $this->assertTrue($this->item->isItemContentIsLesserThan1000Characters());
        // set content to more than 1000 characters
        $this->item->setContent('Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
        molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
        numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
        optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
        obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
        nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
        tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
        quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos 
        sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam
        recusandae alias error harum maxime adipisci amet laborum. Perspiciatis 
        minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
        molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
        numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
        optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis');

        // false because content is more than 1000 characters
        $this->assertFalse($this->item->isItemContentIsLesserThan1000Characters($this->item->getContent()));
    }

    public function testWasTheLastItemAdded30minutesAgo(): void
    {
        // create an item
        $this->item->setCreatedAt(new \DateTime('now'));

        // true because there is no item in the array
        $this->assertTrue($this->item->wasTheLastItemAdded30minutesAgo($this->item));

        // create an item
        $item2 = new Item('test2', 'test', new \DateTime('now'));


        // false because an item was added previously, and it was not 30 minutes ago
        $this->assertFalse($item2->wasTheLastItemAdded30minutesAgo($this->item, $item2));
    }
}
