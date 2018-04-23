<?php

/*
 * Copyright 2018 Andreas Prucha, Abexto - Helicon Software Development.
 */

namespace abexto\amylian\yii\doctrine\base\common;

/**
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
trait DoctrineComponentTrait
{

    private $_parentDoctrineComponent = null;

    /**
     * 
     * @return Object|
     */
    public function getParentDoctrineComponent()
    {
        return $this->_parentDoctrineComponent;
    }

    public function setParentDoctrineComponent($aParent)
    {
        $this->_parentDoctrineComponent = $aParent;
    }

    protected function createDoctrineObject($type, array $params = [])
    {
        if (is_array($definition)) {
            $className = isset($definition['class']) ? $definition['class'] : null;
        } elseif (is_string($type)) {
            $className = $type;
        } else {
            $className = null;
        }
        if ($className) {
        if (!isset($definition['parentDoctrineComponent'])) {
            $reflect = new \ReflectionClass($className);
            if ($reflect->implementsInterface(DoctrineComponentInterface::class)) {
                if (!is_array($type)) {
                    $type['class'] = $type;
                }
                $type['parentDoctrineComponent'] = $this;
            }
        }
        }
        return \Yii::createObject($type, $params);
    }

    /**
     * Resolves and returns the object 
     * @param object|string|array $reference
     * @param object $type
     */
    public function resolveReference($reference, $type = null, $container = null)
    {
        if (is_object($reference)) {
            return $reference;
        }
        if (is_array($reference)) {
            return $this->createDoctrineObject($reference, $type, $container);
        } else {
            if ($this->getParentDoctrineComponent() instanceof DoctrineComponentInterface) {
                return $this->getParentDoctrineComponent()->resolveReference($reference, $type);
            } else {
                return NULL;
            }
        }
    }

    protected function internalEnsureChild($reference, $type = null, $container = null)
    {
        if (is_array($reference)) {
            $class = isset($reference['class']) ? $reference['class'] : $type;
        }
        return \yii\di\Instance::ensure($reference, $type, $container);
    }

}
