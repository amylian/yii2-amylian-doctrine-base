<?php

/*
 * Copyright 2018 Andreas Prucha, Abexto - Helicon Software Development.
 */

namespace abexto\amylian\yii\doctrine\base\common;

/**
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
interface DoctrineComponentInterface
{
    /**
     * Resolves and returns the object 
     * @param object|string|array $reference
     * @param object $type
     */
    public function resolveReference($reference, $type = null, $container = null);

    /**
     * @return DoctrineComponentInterface|Object
     */
    public function getParentDoctrineComponent();

    public function setParentDoctrineComponent($aParent);
}
