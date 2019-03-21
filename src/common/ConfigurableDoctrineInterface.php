<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace amylian\yii\doctrine\base\common;

/**
 * Description of ConfigurableDoctrineInterface
 *
 * @author andreas
 */
interface ConfigurableDoctrineInterface extends \yii\base\Configurable
{
    /**
     * Returns the default configuration array
     */
    public function getDefaultConfigurationArray(): array;

    /**
     * Merges the given configuration with the default configuration
     * 
     * @param type $givenConfiguration
     * @return array Merged array
     */
    public function mergeDefaultConfigurationArray(array $givenConfiguration = []): array;

    /**
     * Assigns configuration attributes
     * 
     * Calls {@see setDoctrineObjectAttribute()} passing ($key, $value) 
     * for each item
     */
    public function assignConfigurationAttributesFromArray(array $config = []);

    /**
     * Sets the value of the attribute
     * 
     * Checks if a function setXxx (where Xxx stands for the passed $attributeName)
     * exists. If the function exists it's called and $value is passed to the
     * function. 
     */
    public function setDoctrineObjectAttribute($attributeName, $value);
}
