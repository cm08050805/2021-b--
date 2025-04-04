<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <form method="post">
                <div class="card">
                    <div class="card-header">
                        <h4>글 생성하기</h4>
                    </div>

                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="mb-2">
                            <label for="category" class="form-label">카테고리</label>
                            <select class="form-select" id="category" name="category">
                                <option value="일반" <?= $category === "일반" ? "selected" : ""?>>일반</option>
                                <option value="이벤트" <?= $category === "이벤트" ? "selected" : ""?>>이벤트</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="content" class="form-label">공지내용</label>
                            <input id="content" name="content" type="text" class="form-control" placeholder="공지내용" value="<?= $content ?>">
                        </div>
                    </div>

                    <div class="card-footer">
                        <?php if($id === 0): ?>
                            <button type="submit" class="btn btn-primary">생성</button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary">수정</button>
                        <?php endif ?>
                    </div>
                </div>
                
            </form>

        </div>
    </div>
</div>