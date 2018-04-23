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
     * @var Arrays Addition arguments 
     */
    public $addArguments = [];

    protected function getInstPropertyMappings()
    {
        return [];
    }

    /**
     * @param object $inst
     */
    protected function setInstProperites($inst, $mappings)
    {
        foreach ($mappings as $cpn => $ipn) {
            if ($ipn === true) {
                $ipn = $cpn;
            }
            if ($ipn !== false) {
                $v = ($this->$cpn instanceof AbstractDoctrineInstWrapperComponent) ? $this->$cpn->getInst() : $this->$cpn;
                if (property_exists($inst, $ipn)) {
                    $inst->$ipn = $v;
                } else {
                    $setter = 'set' . ucfirst($ipn);
                    if (method_exists($inst, $setter)) {
                        $inst->$setter($v);
                    }
                }
            }
        }
        foreach ($this->addArguments as $ipn => $v) {
            if (property_exists($inst, $ipn)) {
                $inst->ipn = $v;
            } else {
                $setter = 'set' . ucfirst($ipn);
                if (method_exists($inst, $setter)) {
                    $inst->$setter($v);
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
        $this->setInstProperites($result, $this->getInstPropertyMappings());
        return $result;
    }

}
