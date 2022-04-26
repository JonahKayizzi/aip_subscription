<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1072249d777e49c399f10ddd3d0e75dd
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1072249d777e49c399f10ddd3d0e75dd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1072249d777e49c399f10ddd3d0e75dd::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
