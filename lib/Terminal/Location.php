<?php

// File generated from our OpenAPI spec

namespace Paayes\Terminal;

/**
 * A Location represents a grouping of readers.
 *
 * Related guide: <a
 * href="https://docs.paayes.com/docs/terminal/creating-locations">Fleet Management</a>.
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property \Paayes\PaayesObject $address
 * @property string $display_name The display name of the location.
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property \Paayes\PaayesObject $metadata Set of <a href="https://docs.paayes.com/api/metadata">key-value pairs</a> that you can attach to an object. This can be useful for storing additional information about the object in a structured format.
 */
class Location extends \Paayes\ApiResource
{
    const OBJECT_NAME = 'terminal.location';

    use \Paayes\ApiOperations\All;
    use \Paayes\ApiOperations\Create;
    use \Paayes\ApiOperations\Delete;
    use \Paayes\ApiOperations\Retrieve;
    use \Paayes\ApiOperations\Update;
}
