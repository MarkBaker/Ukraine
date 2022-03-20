<?php

namespace MarkBaker\Ukraine;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\EventDispatcher\Event;

class Support implements PluginInterface, EventSubscriberInterface
{
    private static $messageShown = false;

    public function activate(Composer $composer, IOInterface $io)
    {
        $appName = $composer->getPackage()->getName();
        self::showSupport($io, $appName);
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }

    public static function getSubscribedEvents()
    {
        return [];
    }

    public static function postPackageInstall(PackageEvent $event)
    {
        $io = $event->getIO();
        $appName = $event->getOperation()->getPackage()->getName();

        self::showSupport($io, $appName);
    }

    public static function postPackageUpdate(PackageEvent $event)
    {
        $io = $event->getIO();
        $appName = $event->getOperation()->getPackage()->getName();

        self::showSupport($io, $appName);
    }

    public static function run(Event $event)
    {
        $io = $event->getIO();
        $composer = $event->getComposer();
        $appName = $composer->getPackage()->getName();

        self::showSupport($io, $appName);
    }

    public static function showSupport(IOInterface $io, string $appName)
    {
        if (self::$messageShown === false) {
            $io->write("\n<bg=blue;fg=yellow;options=bold>\n" .
                "\n  The Truth doesn't drown in water,\n</>" .
                "<bg=yellow;fg=blue;options=bold>\n" .
                "\n     and it doesn't burn in fire.\n</>"
            );

            self::$messageShown = true;
        }

        $io->write(
            "\n<bg=blue;fg=yellow;options=bold> {$appName} </>".
                "<bg=yellow;fg=blue;options=bold> stands with Ukraine </>\n"
        );
    }
}
