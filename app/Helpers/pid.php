<?php

if (! function_exists('pid')) {
    /**
     * Generate a random PID (Public Identifier).
     * Example: pid() => 'abc-fghi-xyz'
     */
    function pid(): string
    {
        $nanoid = new Hidehalo\Nanoid\Client();
        $pid = $nanoid->formatedId('abcdefghijkmnpqrtwxyz', 10);
        $pid = substr($pid, 0, 3).'-'.substr($pid, 3, 4).'-'.substr($pid, 7, 3);

        return (string) $pid;
    }
}
