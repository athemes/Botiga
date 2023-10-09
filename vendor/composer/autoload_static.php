<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit38999d373839c547404bdac05dde971a
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 55,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit38999d373839c547404bdac05dde971a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit38999d373839c547404bdac05dde971a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit38999d373839c547404bdac05dde971a::$classMap;

        }, null, ClassLoader::class);
    }
}
