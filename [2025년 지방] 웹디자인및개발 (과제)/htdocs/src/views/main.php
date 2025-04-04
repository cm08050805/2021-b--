<div class="container">
    <div class="row mt-5">
        <div class="col-10 offset-1" id="content">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Skill 2025 Sample page</h1>
                    <p class="lead">2025 기능대회용 샘플 페이지</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 notice-container" >
        <div class="col-12">
            <h4>공지사항</h4>
            <p>만약 새로고침시에도 현재상태 유지하라고 하면 로컬스토리지 쓰거나 백엔드 처리로 변경해</p>
        </div>
        <div class="button-row d-flex justify-content-between">
            <div class="order-container me-4">
                <button class="btn btn-outline-primary me-2" data-order="ASC">ASC</button>
                <button class="btn btn-outline-primary me-2" data-order="DESC">DESC</button>
            </div>

            <div class="filter-container me-4">
                <button class="btn btn-outline-success me-2" data-filter="All">전체</button>
                <button class="btn btn-outline-success me-2" data-filter="Normal">일반만</button>
                <button class="btn btn-outline-success me-2" data-filter="Event">이벤트만</button>
            </div>

        </div>
        <div class="col-12 mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>종류</th><th style="width: 60%;">내용</th> <th>날짜</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                </tbody>
            </table>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <ul class="pagination" id="pagination">
            </ul>
        </div>
    </div>
    <!-- INSERT INTO todos(title, content,owner, date) ( SELECT title, content, owner, date FROM todos ) -->

</div>
<div id="loadingbox" class="df-center">
    <h2><i class="fas fa-spinner fa-spin"></i></h2>
</div>

<script src="/js/NoticeApp.js"></script>
<!--처음시작할때 디버깅 용도임-->
<!--<script src="/js/product.js"></script>-->
<!--<script src="/js/insertItem.js"></script>-->