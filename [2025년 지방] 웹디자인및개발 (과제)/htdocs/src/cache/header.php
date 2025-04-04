<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/app.js"></script>
</head>
<body>
<div class="container-fluid" id="container">
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a href="/" class="navbar-brand">Todo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">메인</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/products">전체 상품</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/hit">인기 상품</a>
                        </li>

                        <?php if(user()->checkLogin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/buckets">장바구니</a>
                        </li>
                        <?php endif ?>

                        <?php if(user()->isAdmin()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                관리자
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/admin/notice">공지사항 관리</a></li>
                                <li><a class="dropdown-item" href="/admin/product">판매상품 관리</a></li>
                            </ul>
                        </li>
                        <?php endif ?>
                    </ul>

                    <?php if(user()->checkLogin()): ?>
                    <div>
                        <button class="btn btn-outline-success"><?=  user()->get()->username  ?></button>
                        <a href="/user/logout" class="btn btn-outline-danger">로그아웃</a>
                    </div>
                    <?php else: ?>
                    <div>
                        <a href="/user/register" class="btn btn-outline-success">회원가입</a>
                        <a href="/user/login" class="btn btn-outline-primary">로그인</a>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </nav>

        <?php if(session()->has("msg")): ?>
            <div class="alert alert-success out" role="alert">
                <?= session()->get("msg") ?>
            </div>
        <?php endif; ?>
    </header>