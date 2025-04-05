<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitab9fffc0c3f284af17eece538d0ab160
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\PhpOffice\\Math\\' => 21,
        ),
        'P' => 
        array (
            'PhpOffice\\PhpWord\\' => 18,
            'PhpOffice\\Math\\' => 15,
        ),
        'D' => 
        array (
            'Danila\\MySite\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\PhpOffice\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/math/tests/Math',
        ),
        'PhpOffice\\PhpWord\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpword/src/PhpWord',
        ),
        'PhpOffice\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/math/src/Math',
        ),
        'Danila\\MySite\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitab9fffc0c3f284af17eece538d0ab160::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitab9fffc0c3f284af17eece538d0ab160::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitab9fffc0c3f284af17eece538d0ab160::$classMap;

        }, null, ClassLoader::class);
    }
}
