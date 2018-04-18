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

    protected function getInstPropertyMatchings()
    {
        return [];
    }

    /**
     * 
     * @param object $inst
     */
    protected function setInstProperites($inst)
    {
        foreach ($this->getInstRelatedPropertyNames() as $cpn => $ipn) {
            if ($ipn === true) {
                $ipn = $cpn;
            }
            if ($ipn !== false) {
                if (property_exists($inst, $cpn)) {
                    $inst->ipn = $this->$cpn;
                } else {
                    $setter = 'set' . ucfirst($ipn);
                    if (method_exists($inst, $setter)) {
                        $inst->$setter($this->$cpn);
                    }
                }
            }
        }
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
