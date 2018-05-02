<?php

/*
 * Copyright 2018 Andreas Prucha, Abexto - Helicon Software Development.
 */

namespace abexto\amylian\yii\doctrine\base;

/**
 * Description of AbstractDoctrineInstWrapper
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
abstract class AbstractDoctrineInstWrapperComponent extends \abexto\amylian\yii\base\common\AbstractInstanceWrapperComponent
        implements common\DoctrineComponentInterface
{

    use common\DoctrineComponentTrait;
    
    /**
     * Ensures a object of this class
     * @param array|string|object $reference
     */
    public static function ensure($reference, $type = null)
    {
        return \abexto\amylian\yii\doctrine\base\InstanceManager::ensure($reference, $type === null ? static::class : $type);
    }

}
