<div class="container">
    <h4>관리자 페이지 - 공지사항 관리</h4>
    <div class="row create-menu my-3">
        <div class="col-12">
            <a href="/admin/notice/create" class="btn btn-success">생성</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
        @foreach($notices as $notice)
            <div class="notice d-flex justify-content-between mb-2">
                <div class="info-row d-flex justify-content-between">
                    <div class="number"><?= $notice->id ?></div>
                    <div class="category"><?= $notice->category ?></div>
                    <div class="content"><?= $notice->content ?></div>
                    <div class="date"><?= $notice->date ?></div>
                </div>
                <div class="menu-row">
                    <a href="/admin/notice/delete/<?= $notice->id ?>" class="btn btn-outline-danger btn-sm me-2">삭제</a>
                    <a href="/admin/notice/modify/<?= $notice->id ?>" class="btn btn-outline-primary btn-sm me-2">수정</a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>