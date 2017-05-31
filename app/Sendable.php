<?php


namespace App;

interface Sendable
{
    public function isExistOnGdGood($product);
    public function saveProcutOnGdGood($product);
}