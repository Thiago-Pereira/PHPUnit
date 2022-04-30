<?php

namespace OrderBundle\Test\Entity;

use OrderBundle\Entity\Item;
use OrderBundle\Entity\Restaurant;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase {
    /**
     * @dataProvider itemAvailableDataProvider
     */
    public function testIsAvailable($isAvailable, $isOpen, $expectedAvailable) {
        $item = new Item(
            'X-Burger',
            $isAvailable,
            '20',
            $isOpen
        );

        $this->assertEquals($expectedAvailable, $item->isAvailable());
    }

    public function itemAvailableDataProvider() {
        return [
            'shouldBeAvailableWhenRestaurantIsOpenAndItemIsAvailable' => [
                'isAvailable' => true,
                'isOpen' => new Restaurant('Bar', true),
                'expectedAvailable' => true
            ],
            'shouldBeAvailableWhenRestaurantIsCloseAndItemIsAvailable' => [
                'isAvailable' => true,
                'isOpen' => new Restaurant('Bar', false),
                'expectedAvailable' => false
            ],
            'shouldBeAvailableWhenRestaurantIsOpenAndItemIsNotAvailable' => [
                'isAvailable' => false,
                'isOpen' => new Restaurant('Bar', true),
                'expectedAvailable' => false
            ]
        ];
    }
}