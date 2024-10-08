<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85f8d5393418435380d9df7e3b5f134b
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Akhil\\Tictactoe\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Akhil\\Tictactoe\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit85f8d5393418435380d9df7e3b5f134b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit85f8d5393418435380d9df7e3b5f134b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit85f8d5393418435380d9df7e3b5f134b::$classMap;

        }, null, ClassLoader::class);
    }
}
