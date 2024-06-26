<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0000c232d144fb7e5736215a4c4a69b5
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0000c232d144fb7e5736215a4c4a69b5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0000c232d144fb7e5736215a4c4a69b5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0000c232d144fb7e5736215a4c4a69b5::$classMap;

        }, null, ClassLoader::class);
    }
}
