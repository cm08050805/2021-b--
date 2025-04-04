<div class="container">
    <div class="row">
        <div class="col-12">
            <h3><?= user()->get()->username ?>님의 장바구니</h3>
            <p>장바구니에서 빼는건 구현이야기 없음.- 다만 추가과제 대비해서 만들어 볼것, 고의적으로 AJAX 안씀.</p>
        </div>
    </div>

    <div class="row mt-3 d-flex flex-column bucket-list">
        <div class="col-12">
        @foreach($bucketList as $item)
            <div class="card mb-3">
                <h5 class="card-header"><?= $item->title ?></h5>
                <div class="card-body d-flex">
                    <div class="img-container d-flex align-items-start flex-column">
                        <img src="<?= $item->image ?>" alt="product image">
                    </div>
                    <div class="price-info">
                        <div class="counter d-flex align-items-center">
                            <a href="/buckets/minus/<?= $item->bucket_id ?>" class="btn btn-outline-danger btn-sm">-</a>
                            <input type="number" readonly value="<?= $item->count ?>">
                            <a href="/buckets/plus/<?= $item->bucket_id ?>" class="btn btn-outline-primary btn-sm">+</a>
                        </div>
                        <div class="unit-price-info">
                        @if($item->discountOption == "none")
                            <span class="unit-price"><?= number_format($item->price) ?></span>
                        @else
                            <span class="unit-price text-decoration-line-through"><?= number_format($item->price) ?></span>
                            <span class="sale-price"><?= number_format($item->saledPrice) ?></span>
                        @endif
                        </div>
                        <div class="total-price-info">
                            <span><?= number_format($item->saledPrice * $item->count) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        </div>
    </div>

    <div class="row">
        <div class="col-12 sum-price">
            총 합계 : <span class="sum-price"><?= $sumPrice ?></span>
        </div>
    </div>
</div>