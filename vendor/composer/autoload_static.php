<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit901e843af12275dc0bc1e67b39fd8c83
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit901e843af12275dc0bc1e67b39fd8c83::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit901e843af12275dc0bc1e67b39fd8c83::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit901e843af12275dc0bc1e67b39fd8c83::$classMap;

        }, null, ClassLoader::class);
    }
}
