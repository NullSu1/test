<?php
namespace test\hellow;


class Price
{
    const PRICE_BUTTER  = 1.00;
    const PRICE_MILK    = 3.00;
    const PRICE_EGGS    = 6.00;
    const PRICE_BOOKS    = 8.00;

    protected   $products = array();

    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }

    public function getQuantity($product)
    {
        return isset($this->products[$product]) ? $this->products[$product] : 0;
    }

    public function getTotal($tex = 0)
    {
        $total = 0.00;

        $callback =
            function ($quantity, $product) use ($tex, &$total)
            {
                $pricePerItem = constant(__CLASS__ . "::PRICE_" .
                    strtoupper($product));
                $total += ($pricePerItem * $quantity)*($tex + 1);
            };

        array_walk($this->products, $callback);
        return round($total, 2);
    }
}