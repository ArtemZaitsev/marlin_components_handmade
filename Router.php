<?php
//Маршрутизатор, который перенаправляет на нужную страницу в завсимости от запроса в URL

class Router{
//    доступные только в этом классе данные
protected $route;

//    метод констракт вызывается каждый раз при создании объекта класса
public function __construct($route){
    $this->route = $_SERVER['REQUEST_URI'];
}

    /**
    getPrettyUrl()
     Parameters: array $routes - массив значения URL и файла куда направлять в виде ассоциативного массива;
           string $pageMistake - название файл,который отобразится при ошибке.
    Description: для создания понятных и безопасных адресов.
         Return: NULL.
     */
   public function getPrettyUrl($routes, $pageMistake404) {
       //    используем готовую функцию php для замены ключей на значения
       if(array_key_exists($this->route, $routes)){
           include $routes[$this->route]; exit;
//        Если ключа нет в списке, то перенаправляем на заанее заготовленную страницу
       } else {
           header("Location: {$pageMistake404}");
       };
   }
};

