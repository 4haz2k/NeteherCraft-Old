<?php
session_start();
require "function.php";
$functions = new Functions();
if($_SESSION['nickname'] != "zytia" && isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])):
    header('Location: /');
else:?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/main.css">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="js/admin_panel.js"></script>
        <title>Admin panel</title>
        <style>
            .text-center {
                margin-right: auto;
                margin-left: auto;
            }
        </style>
    </head>
    <body>
    <div id="nether_info_block"></div>
    <div class="container-fluid justify-content-center">
        <div class="row">
            <div class="col-12 text-center text" style="color: black; top: 40px">Загрузка предметов в базу данных</div>
            <div class="col-12"  style="top: 80px">
                <form class="justify-content-center" id="items">
                    <div class="container">
                        <div class="form-group col-md-5 text-center">
                            <label><b>Название</b></label>
                            <input class="form-control" type="text" placeholder="Название предмета" id="title" required><br>

                            <label><b>Цена</b></label>
                            <input class="form-control" type="text" placeholder="Цена предмета" id="price" required><br>

                            <label><b>Категория</b></label>
                            <select class="custom-select" id="inputGroupSelect02">
                                <option selected>Категория</option>
                                <option value="1">Оружие</option>
                                <option value="2">Броня</option>
                                <option value="3">Инструменты</option>
                                <option value="4">Растительность</option>
                                <option value="5">Алхимия</option>
                                <option value="6">Шерсть</option>
                                <option value="7">Красители</option>
                                <option value="8">Книги</option>
                                <option value="9">Ресурсы</option>
                                <option value="10">Блоки</option>
                                <option value="11">Декор</option>
                                <option value="12">Еда</option>
                                <option value="13">Яица призыва</option>
                                <option value="14">Разное</option>
                            </select>

                            <label><b>Изображение предмета</b></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="img" required>
                                <label class="custom-file-label" for="inputGroupFile01">Выбрать изображение</label>
                            </div><br>
                            <label><b>id предмета в игре</b></label>
                            <input class="form-control" type="text" placeholder="id предмета" id="item_meta" required><br>
                        </div>
                        <div class="text-center">
                            <button class="btn-danger" type="submit">Добавить</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 text-center text" style="color: black; top: 80px">Добавление наборов(kits)</div>
            <div class="col-12"  style="top: 80px">
                <form class="justify-content-center" id="kits">
                    <div class="container">
                        <div class="form-group col-md-5 text-center">
                            <label><b>Название</b></label>
                            <input class="form-control" type="text" placeholder="Название набора" id="title1" required><br>

                            <label><b>Подробное описание</b></label>
                            <input class="form-control" type="text" placeholder="Описание" id="description1" required><br>

                            <label><b>Цена</b></label>
                            <input class="form-control" type="text" placeholder="Цена набора" id="price1" required><br>

                            <label><b>Голоса</b></label>
                            <input class="form-control" type="text" placeholder="Макс. голосов" id="votes1" required><br>

                            <label><b>Изображение набора</b></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile011" name="img">
                                <label class="custom-file-label" for="inputGroupFile01">Выбрать изображение</label>
                            </div><br>

                            <label><b>Предметы</b><br> Формат: 1-64/2-10, где 1 = id предмета из бд, 64 - кол-во, / = след предмет </label>
                            <input class="form-control" type="text" placeholder="id предмета" id="items1" required><br>

                            <label><b>Тип набора</b><br> item/command </label>
                            <input class="form-control" type="text" placeholder="item/command" id="type1" required><br>

                            <label><b>Команда</b><br>Если есть</label>
                            <input class="form-control" type="text" placeholder="%player% - заменяется игроком" id="command1" required><br>
                        </div>
                        <div class="text-center">
                            <button class="btn-danger" type="submit">Добавить</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 text-center text" style="color: black; top: 80px">Добавить новость</div>
            <div class="col-12"  style="top: 80px">
                <form class="justify-content-center" id="news">
                    <div class="container">
                        <div class="form-group col-md-5 text-center">
                            <label><b>Название</b></label>
                            <input class="form-control" type="text" placeholder="Название новости" id="title3" required><br>

                            <label><b>Подробное описание</b></label>
                            <input class="form-control" type="text" placeholder="Описание" id="description3" required><br>

                            <label><b>Изображение новости</b></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile012" name="img">
                                <label class="custom-file-label" for="inputGroupFile01">Выбрать изображение</label>
                            </div><br>

                        </div>
                        <div class="text-center">
                            <button class="btn-danger" type="submit">Опубликовать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </body>
    </html>

<?php endif;?>