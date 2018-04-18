<?php

/*
 * Copyright 2018 Andreas Prucha, Abexto - Helicon Software Development.
 */

namespace abexto\amylian\yii2\doctrine\base;

/**
 * Description of AbstractDoctrineInstWrapper
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
class AbstractDoctrineInstWrapperComponent extends \abexto\amylian\yii2\base\common\AbstractInstanceWrapperComponent
{
    
    /**
     * @var \yii\base\Component
     */
    public $parent = null;
    
    protected function getInstRelatedPropertyNames()
    {
        return [];
    }
    /**
     * 
     * @param object $inst
     */
    protected function setInstProperites($inst)
    {
        
    }
    /**
     * @inheritDoc
     */
    protected function createNewInst()
    {
        $result = parent::createNewInst();
        $this->setInstParams($result);
        return $result;
    }
}
