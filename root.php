<?php


class Item
{
    /** @var mixed */
    public $value;

    /**
     * Содержит пары "название" => подэлемент.
     * @var Item[]
     */
    public $subItems = [];

    public function __construct($value, $subItems = [])
    {
        $this->value = $value;
        $this->subItems = $subItems;
    }

    public function printTree($root, $level = 0)
    {
        echo $level . ' : ' . $root->value . '<br>';
        if (is_array($root->subItems)) {
            $level++;
            foreach ($root->subItems as $key => $val) {
                if (is_object($val) && empty($val->subItems)) {
                    echo $level . ' : ' . $val->value . '<br>';
                } else {
                    $this->printTree($val, $level);
                }
            }
        }
    }
}


$root = new Item(10, array('sub1' => new Item(11), 'sub2' => new Item(12, array('sub3' => new Item(11), 'sub4' => new Item(15))),
    'sub3' => new Item(18),
));

$root->printTree($root);

/*
0: 10
1: 11
1: 12
2: 11
2: 15
1: 18 */