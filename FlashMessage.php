<?php
//компонент для работы с флеш-собщениями
class FlashMessage{

//    указываем переменные, которые доступны в дочерних классах
    protected $block_style;
    protected $message;

    /**
    set_flash_message

      Parameters: string - name (ключ);
                  string - message.
     Description: записать в сессию значение сообщения по ключу.
    Return value: null.
     */
    public function set_flash_message($block_style,$message) {
    //в глобальный объект SESSION (ассоциативный массив) записываю новые данные "ключ-значение".
        $_SESSION['block_style'] = $this->block_style;
        $_SESSION['message'] = $this->message;
    }

    //    Здесь испоьзуется Bootstrap. Надо через CDN надоподключить или как делается?
    /**
    display_flash_message

      Parameters: string - name.
     Description: вывести сообщение.
    Return value: null.
     */
    public function display_flash_message() {
        // условие, что если в глобальном массиве SESSION существует ключ со значением "name"
        if(isset($this->block_style){
            // вывожу сообщение ввиде HTML с использованием классов Bootstrap
            echo "<div class=\"alert alert-{$this->block_style} text-dark\" role=\"alert\">{$this->message}</div>";
            // удаляю "ключ-значение" в глобально массиве SESSION по ключу "name" с использованием стандарной фукнции "unset"
            unset($this->block_style);
            unset($this->message);
        }
    }

    /**unset_flash_message

      Parameters: string - name (ключ);
                  string - message.
     Description: удалить из сессии сообщения.
    Return value: null.
     */
    public function unset_flash_message() {
    //в глобальный объект SESSION (ассоциативный массив) записываю новые данные "ключ-значение".
            unset($this->block_style);
            unset($this->message);
        }

    }