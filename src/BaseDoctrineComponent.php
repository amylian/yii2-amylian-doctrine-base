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
abstract class BaseDoctrineComponent extends \abexto\amylian\yii\base\common\BasetInstanceWrapperComponent
        implements common\BaseDoctrineComponentInterface
{

    const DEFAULT_REF = null;
    const DEFAULT_CLASS = null;
    
    
    /**
     * @inheritDoc
     * @return BaseDoctrineComponent
     */
    public static function ensure($reference = self::USE_DEFAULT_REF, $type = null, $container = null): common\BaseDoctrineComponentInterface
    {
        if ($reference === null) {
            throw new exceptions\InvalidArgumentException(
                    'null passed as $reference to '.static::class.'::ensure(), but a valid reference or configuration array is required');
        };
        $reference = (($reference === self::USE_DEFAULT_REF) ? null : $reference) ?? static::DEFAULT_REF ?? null;
        $type = $type ?? static::DEFAULT_CLASS ?? static::class;
        if ($reference === null) {
            throw new \yii\base\InvalidArgumentException(static::class.'::ensure() called with paramter $reference not set, '.
                    'but component does not define a default reference');
        }
        return \abexto\amylian\yii\doctrine\base\InstanceManager::ensure($reference, $type);
    }

}
