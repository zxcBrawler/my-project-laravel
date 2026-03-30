@extends('layouts.app')

@section('title', 'О нас')

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="mb-4">О нас</h1>
            <p class="lead">Сайт, который я сделал, потому что это было в задании</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Кто я</h3>
                    <p>
                        Я есть я. Пью чай с печеньками, пока пишу код. 
                        Иногда он даже работает с первого раза. Мой новостной сайт — это 
                        проект, который должен был быть сдан вчера, но я ничего не делал 
                        и теперь пишу текст прямо сейчас.
                    </p>
                    <p>
                        Новости я беру из интернета. Если что-то не так — сорян, я просто 
                        верстальщик, а не журналист.
                    </p>
                    <div class="alert alert-light border">
                        Важно: мой главный редактор — кот. Он лежит на клавиатуре и 
                        иногда набирает "ААААААААААААААААААААААААА", я считаю это одобрением материала.
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Моя миссия</h3>
                    <ul>
                        <li>Выжить до конца семестра</li>
                        <li>Не сломать сервер (пока не сломал, уже достижение)</li>
                        <li>Сделать вид, что я профессионал</li>
                        <li>Научить кота писать новости</li>
                        <li>Получить зачет</li>
                    </ul>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Мои принципы</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <h5>Достоверность</h5>
                            <small class="text-muted">Я верю всему, что пишут в интернете. Даже если там написано про летающие сосиски.</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5>Оперативность</h5>
                            <small class="text-muted">Новости появляются, когда у меня заканчивается чай и я иду на кухню.</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5>Объективность</h5>
                            <small class="text-muted">Я объективно ничего не понимаю, но делаю вид, что понимаю.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Моя команда</h3>
                    <div class="row">
                        <div class="col-md-6 text-center mb-3">
                            <h5>Я</h5>
                            <small class="text-muted">Разработчик, верстальщик, дизайнер, копирайтер</small>
                            <p class="mt-2"><small>Люблю чай, печеньки и когда код работает с первого раза</small></p>
                        </div>
                        <div class="col-md-6 text-center mb-3">
                            <h5>Барсик</h5>
                            <small class="text-muted">Кот-редактор и главный тестировщик</small>
                            <p class="mt-2"><small>Любит спать на клавиатуре и игнорировать дедлайны</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3>Мои достижения</h3>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h4>1</h4>
                            <p>Раз сервер не упал</p>
                        </div>
                        <div class="col-md-4">
                            <h4>∞</h4>
                            <p>Выпито чашек чая</p>
                        </div>
                        <div class="col-md-4">
                            <h4>0</h4>
                            <p>Жалоб от кота</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning mt-4">
                Внимание: данный сайт создан в учебных целях одним человеком и его котом. 
                Не воспринимайте всерьез то, что здесь написано. Я тоже не воспринимаю.
            </div>
        </div>
    </div>
</div>
@endsection