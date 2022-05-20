<?php
/**
* Класс отображения контента на сайте<br>
 * Author: Alexey Pavlov<br>
 * Contact: vk.com/zytia
*/
class HTML {

    static function get_footer(){

    }

    static function get_header(){
        echo "<div class=\"d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm\">
              <h5 class=\"my-0 mr-md-auto font-weight-normal\">Сервер</h5>
              <nav class=\"my-2 my-md-0 mr-md-3\">
                <a class=\"p-2 text-dark\" href=\"#\">Информация о серверах</a>
                <a class=\"p-2 text-dark\" href=\"#\">Привилегии</a>
                <a class=\"p-2 text-dark\" href=\"#\">Support</a>
                <a class=\"p-2 text-dark\" href=\"#\">Pricing</a>
              </nav>
                <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModal\">
                  Авторизация
                </button>
              </div>
              <div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                  <div class=\"modal-dialog\" role=\"document\">
                    <div class=\"modal-content\">
                      <div class=\"modal-header\">
                        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Авторизация</h5>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Закрыть\">
                          <span aria-hidden=\"true\">&times;</span>
                        </button>
                      </div>
                      <div class=\"modal-body\">                    
                        <form id=\"autorize\">
                                <div class=\"form-group\">
                                    <label for=\"login\">Никнейм</label>
                                    <input autocomplete=\"username\" name=\"login\" type=\"text\" class=\"form-control\" id=\"login\" aria-describedby=\"emailHelp\" placeholder=\"Мыло\">
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"exampleInputPassword1\">Пароль</label>
                                    <input autocomplete=\"current-password\" name=\"password\" type=\"password\" class=\"form-control\" id=\"password\" placeholder=\"Пароль\">
                                </div>
                                <small id=\"message\" class=\"form-text text-muted\">*Для авторизации необходимо сначала зарегистрироваться на сервере</small>                     
                          </div>
                          <div class=\"modal-footer\">
                            <button type='submit' class=\"btn btn-primary\">Войти</button>
                          </div>
                      </form>
                    </div>
                  </div>
              </div>";
        }

    static function get_head(){
        echo '<meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="js/ajax.js"></script>';
    }
}