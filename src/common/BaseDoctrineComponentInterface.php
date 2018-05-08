<?php

/*
 * Copyright 2018 Andreas Prucha, Abexto - Helicon Software Development.
 */

namespace abexto\amylian\yii\doctrine\base\common;

/**
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
interface BaseDoctrineComponentInterface
{

    /**
     * Used in {@link ensure()} to specify the default class reference in parameter $reference.
     */
    const USE_DEFAULT_REF = '?';

    /**
     * Ensures a object of this class
     * 
     * Returns an object instance by calling {@link \abexto\amylian\yii\doctrine\base\InstanceManager::ensure()}
     * 
     * If $reference contains an class name, interface name or alias it returns the referred object.
     * If $reference contains an configuration array, a new object based on the configuration is created
     * If no parameter is passed or {@link self::USE_DEFAULT_REF} is passed in $reference, 
     * the method returns the required default object if possible.
     * If $reference is `null`, an exception is thrown
     * 
     * @param true|array|string|object $reference Id or configuration.
     * ̍@param string $type Required class. if not specified, the default class is used
     * @return DoctrineInstWrapperComponentInterface Required object instance
     */
    public static function ensure($reference = self::USE_DEFAULT_REF, $type = null, $container = null): BaseDoctrineComponentInterface;
}
