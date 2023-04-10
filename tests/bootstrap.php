<?php

require_once __DIR__ . '/PaayesMock.php';

\define('MOCK_MINIMUM_VERSION', '0.109.0');

if (\Paayes\PaayesMock::start()) {
    \register_shutdown_function('\Paayes\PaayesMock::stop');

    \define('MOCK_HOST', 'localhost');
    \define('MOCK_PORT', \Paayes\PaayesMock::getPort());
} else {
    \define('MOCK_HOST', \getenv('Paayes_MOCK_HOST') ?: 'localhost');
    \define('MOCK_PORT', \getenv('Paayes_MOCK_PORT') ?: 12111);
}

\define('MOCK_URL', 'http://' . MOCK_HOST . ':' . MOCK_PORT);

function checkPaayesMockReachable()
{
    // Send a request to Paayes-mock
    $ch = \curl_init(MOCK_URL);
    \curl_setopt($ch, \CURLOPT_HEADER, 1);
    \curl_setopt($ch, \CURLOPT_NOBODY, 1);
    \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, 1);
    $resp = \curl_exec($ch);

    if (\curl_errno($ch)) {
        echo "Couldn't reach Paayes-mock at `" . MOCK_HOST . ':' . MOCK_PORT . '`. Is ' .
            "it running? Please see README for setup instructions.\n";

        exit(1);
    }

    // Retrieve the Paayes-Mock-Version header
    $version = null;
    $headers = \explode("\n", $resp);
    foreach ($headers as $header) {
        $pair = \explode(':', $header, 2);
        if ('Paayes-Mock-Version' === $pair[0]) {
            $version = \trim($pair[1]);
        }
    }

    if (null === $version) {
        echo 'Could not retrieve Paayes-Mock-Version header. Are you sure ' .
            'that the server at `' . MOCK_HOST . ':' . MOCK_PORT . '` is a Paayes-mock ' .
            'instance?';

        exit(1);
    }

    if ('master' !== $version && -1 === \version_compare($version, MOCK_MINIMUM_VERSION)) {
        echo 'Your version of Paayes-mock (' . $version . ') is too old. The minimum ' .
            'version to run this test suite is ' . MOCK_MINIMUM_VERSION . '. ' .
            "Please see its repository for upgrade instructions.\n";

        exit(1);
    }
}

// PHPStan also executes this file so that it can know the types of the
// \define-ed globals, but it shouldn't crash if Paayes-mock isn't running.
// We use an environment variable set in `../phpunit.xml` and check that it
// is set before enforcing that Paayes-mock is reachable.
if (\getenv('IS_RUNNING_PHPUNIT')) {
    checkPaayesMockReachable();
}

require_once __DIR__ . '/TestHelper.php';
require_once __DIR__ . '/TestServer.php';
