<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\Manager;

class Transformer
{

    private array $include = [];

    private Manager $manager;

    private int $index, $prefix = 0;

    private bool $increment = false;

    public function __construct()
    {
        $this->manager = new Manager();
        $this->index = 0;
    }

    public function parseInclude(array $include)
    {
        $this->include = $include;
        return $this;
    }

    public function setIndex(int $prefix = 0)
    {
        $this->prefix = $prefix;
        $this->increment = true;
        return $this;
    }

    public function buildCollection(object $collection, object $tranformer): array
    {

        if ($this->increment)
            $collection = $this->addIncrement($collection);

        return $this->createData(new Fractal\Resource\Collection($collection, $tranformer));
    }

    public function buildItem(object $items, object $tranformer)
    {
        return $this->createData(new Fractal\Resource\Item($items, $tranformer));
    }

    private function addIncrement($collection)
    {
        $collect = collect($collection);
        $collection = $collect->map(function ($item, $_) {
            $this->index++;

            $index = $this->index;
            if (!empty($this->prefix))
                $index = (int) (((string) $this->prefix) . ((string) $index));

            $item->_index = $index;
            return $item;
        });

        return $collection;
    }

    private function createData($resource)
    {
        if (!empty($this->include))
            $this->manager->parseIncludes($this->include);

        $result = $this->manager->createData($resource)->toArray();
        return $result["data"];
    }
}
