<?php

namespace Gondr\Controller;

use Gondr\App\DB;
use Gondr\App\Lib;

class BucketController extends MasterController
{
    public function indexPage()
    {
        $user = user()->get();
        $sql = "SELECT b.id as bucket_id, b.count, p.* FROM buckets AS b, products AS p WHERE b.product_id = p.id AND b.user_id = ?";

        $bucketList = DB::fetchAll($sql, [$user->id]);
        $sumPrice = 0;
        foreach($bucketList as $item)
        {
            $item->saledPrice = $item->price;
            if($item->discountOption !== "none")
            {
                if($item->discountOption === "minus")
                    $item->saledPrice -= $item->discountValue;
                else
                    $item->saledPrice *= (1- $item->discountValue);
            }
            $sumPrice += $item->saledPrice * $item->count;
        }

        $this->render("bucket/index", ['bucketList' => $bucketList, 'sumPrice' => $sumPrice]);
    }

    public function purchase($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $product = DB::fetch($sql, [$id]);
        if(!$product)
            Lib::redirect("/products", "상품이 존재 하지 않습니다.");

        $user = user()->get();

        $sql = "INSERT INTO buckets (user_id, product_id, count) VALUES (?, ?, 1)";
        DB::execute($sql, [$user->id, $product->id]);

        Lib::redirect("/products", "장바구니에 담겼습니다.");
    }

    public function adjustCount($option, $id)
    {
        $sql = "SELECT * FROM buckets WHERE id = ?";
        $bucket = DB::fetch($sql, [$id]);
        if(!$bucket)
            Lib::redirect("/buckets", "상품이 존재 하지 않습니다.");

        if($bucket->count == 1 && $option === "minus")
            Lib::redirect("/buckets", "더 이상 뺄 수 없습니다.");

        if($option === "minus")
        {
            $sql = "UPDATE buckets SET count = count - 1 WHERE id = ?";
        }else
        {
            $sql = "UPDATE buckets SET count = count + 1 WHERE id = ?";
        }
        DB::execute($sql, [$id]);
        Lib::back();
    }
}