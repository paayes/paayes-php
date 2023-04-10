<?php

namespace Paayes;

use Symfony\Component\Process\Process;

class PaayesMock
{
    protected static $process = null;
    protected static $port = -1;

    const PATH_SPEC = __DIR__ . '/openapi/spec3.json';
    const PATH_FIXTURES = __DIR__ . '/openapi/fixtures3.json';

    /**
     * Starts a Paayes-mock process with custom OpenAPI spec and fixtures files, if they exist.
     *
     * @return bool true if a Paayes-mock process was started, false otherwise
     */
    public static function start()
    {
        if (!\file_exists(self::PATH_SPEC)) {
            return false;
        }

        if (null !== static::$process && static::$process->isRunning()) {
            echo 'Paayes-mock already running on port ' . static::$port . "\n";

            return true;
        }

        static::$port = static::findAvailablePort();

        echo 'Starting Paayes-mock on port ' . static::$port . "...\n";

        static::$process = new Process(\implode(' ', [
            'Paayes-mock',
            '-http-port',
            static::$port,
            '-spec',
            self::PATH_SPEC,
            '-fixtures',
            self::PATH_FIXTURES,
        ]));
        static::$process->start();
        \sleep(1);

        if (static::$process->isRunning()) {
            echo 'Started Paayes-mock, PID = ' . static::$process->getPid() . "\n";
        } else {
            exit('Paayes-mock terminated early, exit code = ' . static::$process->wait());
        }

        return true;
    }

    /**
     * Stops the Paayes-mock process, if one was started. Otherwise do nothing.
     */
    public static function stop()
    {
        if (null === static::$process || !static::$process->isRunning()) {
            return;
        }

        echo "Stopping Paayes-mock...\n";
        static::$process->stop(0, \SIGTERM);
        static::$process->wait();
        static::$process = null;
        static::$port = -1;
        echo "Stopped Paayes-mock\n";
    }

    /**
     * Returns the port number used by the Paayes-mock process.
     *
     * @return int the port number used by Paayes-mock, or -1 if no Paayes-mock process was started
     */
    public static function getPort()
    {
        return static::$port;
    }

    /**
     * Finds a random available TCP port.
     *
     * @return int the port number
     */
    private static function findAvailablePort()
    {
        $sock = \socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);
        \socket_bind($sock, 'localhost', 0);
        $addr = null;
        $port = -1;
        \socket_getsockname($sock, $addr, $port);
        \socket_close($sock);

        return $port;
    }
}
