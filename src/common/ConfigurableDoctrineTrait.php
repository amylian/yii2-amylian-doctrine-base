<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace amylian\yii\doctrine\base\common;

/**
 *
 * @author andreas
 */
trait ConfigurableDoctrineTrait
{
    /**
     * Assigns configuration attributes
     * 
     * Calls {@see setDoctrineObjectAttribute()} passing ($key, $value) 
     * for each item
     */
    public function assignConfigurationAttributesFromArray(array $config = [])
    {
        foreach ($config as $k => $v) {
            $this->setDoctrineObjectAttribute($k, $v);
        }
    }
    
    /**
     * Sets the value of the attribute
     * 
     * Checks if a function setXxx (where Xxx stands for the passed $attributeName)
     * exists. If the function exists it's called and $value is passed to the
     * function. 
     */
    public function setDoctrineObjectAttribute($attributeName, $value) 
    {
        if ($value instanceof \yii\di\Instance) {
            $value = $value->get();
        }
        $setter = 'set'.$attributeName;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } else {
            if (property_exists($this, $attributeName)) {
                $attributeName = $value;
            } else {
                throw new \yii\base\UnknownPropertyException('Property '.get_class($this).'::'.$attributeName.' does not exist');
            }
        }
    }
    
    
    
    /**
     * Returns the default configuration array
     */
    abstract public function getDefaultConfigurationArray(): array;

    /**
     * Merges the given configuration with the default configuration
     * 
     * @param type $givenConfiguration
     * @return array Merged array
     */
    public function mergeDefaultConfigurationArray(array $givenConfiguration = []): array
    {
        return \yii\helpers\ArrayHelper::merge($this->getDefaultConfigurationArray(), $givenConfiguration);
    }
    
}
