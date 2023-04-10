<?php

namespace Paayes\Exception;

// TODO: remove this check once we drop support for PHP 5
if (\interface_exists(\Throwable::class, false)) {
    /**
     * The base interface for all Paayes exceptions.
     */
    interface ExceptionInterface extends \Throwable
    {
    }
} else {
    /**
     * The base interface for all Paayes exceptions.
     */
    // phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses
    interface ExceptionInterface
    {
    }
    // phpcs:enable
}
