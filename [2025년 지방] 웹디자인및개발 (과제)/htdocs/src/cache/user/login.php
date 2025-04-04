<div class="container">
    <div class="row">
        <h2 class="my-3">로그인 - 문제는 모달인데 귀찮아서 걍 페이지로함. 모달로 처리할 것.</h2>
        <div class="col-10 offset-1">
            <form method="post">
                <div class="form-group">
                    <label for="userid">ID</label>
                    <?php if(isset($errors['userid'])): ?>
                        <input type="text" class="form-control is-invalid" id="userid" name="userid">
                        <div class="invalid-feedback">
                            <?=  $errors['userid']  ?>
                        </div>
                    <?php else: ?>
                        <input type="text" class="form-control" id="userid" name="userid">
                    <?php endif ?>

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <?php if(isset($errors['password'])): ?>
                    <input type="password" class="form-control is-invalid" id="password" name="password" placeholder="비밀번호를 입력하세요">
                    <div class="invalid-feedback">
                        <?=  $errors['password']  ?>
                    </div>
                    <?php else: ?>
                        <input type="password" class="form-control" id="password" name="password" placeholder="비밀번호를 입력하세요">
                    <?php endif ?>
                </div>
                <button type="submit" class="btn btn-primary">로그인</button>
            </form>
        </div>
    </div>
</div>