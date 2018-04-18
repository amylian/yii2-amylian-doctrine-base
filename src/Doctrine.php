<?php

/*
 * Copyright 2018 Andreas Prucha, Abexto - Helicon Software Development.
 */

namespace abexto\amylian\yii2\doctrine\base;

/**
 * Description of Doctrine
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
class Doctrine extends \yii\di\ServiceLocator
{
    public function get($id, $throwException = true)
    {
        if (isset($this->_components[$id])) {
            return $this->_components[$id];
        }
        $result = parent::get($id, $throwException);
        if (($result instanceof AbstractDoctrineInstWrapperComponent) && ($result->parent === null)) {
            $result->parent = $this;
        }
        return $result;
    }
}
