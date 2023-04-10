<?php

namespace Paayes;

/**
 * Class OrderItem.
 *
 * @property string $object
 * @property int $amount
 * @property string $currency
 * @property string $description
 * @property string $parent
 * @property int $quantity
 * @property string $type
 */
class OrderItem extends PaayesObject
{
    const OBJECT_NAME = 'order_item';
}
