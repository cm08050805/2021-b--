<div class="container mt-3">
    <h1>전체 상품</h1>

    <div class="row mt-2">
        <div class="col-12">
            <video id="video" src="/mp4/AD.mp4" width="400" muted></video>
        </div>
    </div>
    <div class="row control mt-2">
        <div class="col-12 d-flex justify-content-between">
            <div class="control-panel">
                <button class="btn btn-primary btn-sm me-2" onclick="playVideo()">재생</button>
                <button class="btn btn-primary btn-sm me-2" onclick="pauseVideo()">일시정지</button>
                <button class="btn btn-primary btn-sm me-2" onclick="stopVideo()">정지</button>
                <button class="btn btn-primary btn-sm me-2" onclick="rewindVideo()">되감기(10)</button>
                <button class="btn btn-primary btn-sm me-2" onclick="fastForward()">빨리감기(10)</button>
                <button class="btn btn-primary btn-sm me-2" onclick="reduceSpeed()">감속하기(0.1)</button>
                <button class="btn btn-primary btn-sm me-2" onclick="increaseSpeed()">배속하기(0.1)</button>
                <button class="btn btn-primary btn-sm me-2" onclick="originalSpeed()">배속원래대로</button>
            </div>
            <div class="menu-panel">
                <button class="btn btn-primary btn-sm me-2">보이기/숨기기</button>
                <button class="btn btn-primary btn-sm me-2" id="btnRepeat" onclick="repeatToggle()">반복꺼짐</button>
                <button class="btn btn-primary btn-sm me-2" id="btnAuto" onclick="toggleAutoplay()">자동재생 꺼짐</button>
            </div>

        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-success btn-sm" id="nonMemberOrder">비회원주문</button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
        @foreach($list as $cat)
            <h4 class="mt-3 mb-2"><?= $cat->name ?></h4>
            <div class="product-list">
                @foreach($cat->products as $pro)
                <div class="card">
                    <img src="<?= $pro->image ?>" alt="" class="card-img-top">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $pro->title ?></h5>
                        <p class="card-text flex-grow-1"><?= $pro->description ?></p>

                        <a href="/purchase/<?=$pro->id ?>" class="btn btn-outline-primary btn-sm flex-shrink-0">장바구니 담기</a>
                    </div>
                </div>
                @endforeach
            </div>
        @endforeach
        </div>
    </div>
</div>

<div class="modal-background">
    <div class="modal-inner p-3 d-flex flex-column">
        <div class="border-1 flex-grow-1 d-flex flex-column">
            <div class="header-title">
                <h5>비회원 주문</h5>
            </div>

            <div class="d-flex flex-column flex-grow-1">
                <!--                회원정보영역-->
                <div class="info bg-secondary text-white d-flex align-items-center px-2">
                    비회원 : a23123(니네 알아서 랜덤시켜)
                </div>

                <!-- 전시영역과 주문영역 -->
                <div class="product-order-container d-flex flex-grow-1">
                    <div id="productSection">

                    </div>

                    <div class="order d-flex flex-column" id="orderSection">

                    </div>
                </div>

                <!-- 결제 영역 -->
                <div class="payment-container d-flex mt-2 d-flex justify-content-between">
                    <div id="priceInfo">

                    </div>
                    <div>
                        결제하기 누르면 3초 뜨는건 알잘딱 만드셔.
                        <button class="btn btn-outline-primary">결제하기</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/videoApp.js"></script>
<script src="/js/product.js"></script>
<script src="/js/ProductApp.js" type="module"></script>