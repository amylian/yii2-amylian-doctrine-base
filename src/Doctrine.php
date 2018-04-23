<?php

/*
 * Copyright 2018 Andreas Prucha, Abexto - Helicon Software Development.
 */

namespace abexto\amylian\yii\doctrine\base;

/**
 * Description of Doctrine
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
class Doctrine extends \yii\di\ServiceLocator implements common\DoctrineComponentInterface
{

    use common\DoctrineComponentTrait;

    public function get($id, $throwException = true)
    {
        if ($this->has($id, true)) {
            return parent::get($id, $throwException);
        } elseif ($this->has($id, false)) {
            $definition = $this->getComponents(true)[$id];
            if (!isset($definition['parentDoctrineComponent'])) {
                $reflect = new \ReflectionClass($definition['class']);
                if ($reflect->implementsInterface(common\DoctrineComponentInterface::class)) {
                    $definition['parentDoctrineComponent'] = $this;
                }
                $this->set($id, $definition);
            }
        }
        return parent::get($id, $throwException);
    }

    public function resolveReference($reference, $type = null, $collection = null)
    {
        if ($reference !== null && is_string($reference) && $this->has($reference)) {
            return $this->get($reference);
        }
        return parent::resolveReference($reference, $type, $collection);
    }

}
