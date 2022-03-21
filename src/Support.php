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
    const PLUGIN_NAME = 'markbaker/ukraine';

    private static $messageShown = false;

    public function activate(Composer $composer, IOInterface $io)
    {
        self::showSupport($io);
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            'post-package-install' => 'postPackageInstall',
            'post-package-update' => 'postPackageUpdate',
        ];
    }

    public static function postPackageInstall(PackageEvent $event)
    {
        $io = $event->getIO();
        $appName = $event->getOperation()->getPackage()->getName();
        $dependencies = $event->getOperation()->getPackage()->getRequires();
        $devDependencies = $event->getOperation()->getPackage()->getDevRequires();

        self::showSupport($io);
        self::packageSupport($io, $appName, $dependencies);
        self::packageSupport($io, $appName, $devDependencies);
    }

    public static function postPackageUpdate(PackageEvent $event)
    {
        $io = $event->getIO();
        $appName = $event->getOperation()->getPackage()->getName();
        $dependencies = $event->getOperation()->getPackage()->getRequires();
        $devDependencies = $event->getOperation()->getPackage()->getDevRequires();

        self::showSupport($io);
        self::packageSupport($io, $appName, $dependencies);
        self::packageSupport($io, $appName, $devDependencies);
    }

    public static function run(Event $event)
    {
        $io = $event->getIO();
        $composer = $event->getComposer();
        $appName = $composer->getPackage()->getName();
        $dependencies = $composer->getPackage()->getRequires();
        $devDependencies = $composer->getPackage()->getDevRequires();

        self::showSupport($io);
        self::packageSupport($io, $appName, $dependencies);
        self::packageSupport($io, $appName, $devDependencies);
    }

    private static function processPackage(IOInterface $io, Composer $composer, string $appName)
    {
        self::showSupport($io);

        $dependencies = $composer->getPackage()->getRequires();
        self::packageSupport($io, $appName, $dependencies);

        $devDependencies = $composer->getPackage()->getDevRequires();
        self::packageSupport($io, $appName, $devDependencies);
    }

    private static function showSupport(IOInterface $io)
    {
        if (self::$messageShown === false) {
            $io->write("\n<bg=blue;fg=yellow;options=bold>\n" .
                "\n  The Truth doesn't drown in water,\n</>" .
                "<bg=yellow;fg=blue;options=bold>\n" .
                "\n     and it doesn't burn in fire.\n</>"
            );

            self::$messageShown = true;
        }
    }


    private static function packageSupport(IOInterface $io, string $appName, $dependencies)
    {
        foreach ($dependencies as $dependency) {
            $dependencyName = $dependency->getTarget();
            if ($dependencyName === self::PLUGIN_NAME) {
                $io->write(
                    "\n<bg=blue;fg=yellow;options=bold> {$appName} </>" .
                    "<bg=yellow;fg=blue;options=bold> stands with Ukraine </>\n"
                );
            }
        }
    }
}
