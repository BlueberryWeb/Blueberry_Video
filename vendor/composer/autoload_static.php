<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc4b0bac061a7b290730ec3531d123907
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc4b0bac061a7b290730ec3531d123907::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc4b0bac061a7b290730ec3531d123907::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc4b0bac061a7b290730ec3531d123907::$classMap;

        }, null, ClassLoader::class);
    }
}
