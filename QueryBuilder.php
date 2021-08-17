<?php
//Построитель запросов
class QueryBuilder {

//    доступный только в этом классе pdo
    protected $pdo;

//    метод констракт вызывается каждый раз при создании объекта класса
    public function __construct($pdo)
    {
        $this->pdo = $pdo;

    }

    /**
       getAll()
       Parameters: string $table - название таблицы в БД.
      Description: возвращает все данные из таблицы БД.
           Return: array.
     */
    public function getAll($table){
        $sql = "SELECT * FROM {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    create()
    Parameters: string $table - название таблицы в БД;
                  array $data - массив ключ-значение (в нашем примере берем из формы).
    Description: для создания записи в таблице.
    Return: NULL.
     */
    public function create($table, $data) {
        $keys = implode(',',array_keys($data));
        $tags = ":" . implode(',:', array_keys($data));
        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$tags})";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    /**
    getOne()
     Parameters: string $table - название таблицы в БД;
                 string $id - идентификатор записи в таблице.
    Description: для получения записи из таблице.
         Return: array.
     */
    public function getOne($table, $id) {
        $sql = "SELECT * FROM posts WHERE id=:id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    /**
    update()
     Parameters: string $table - название таблицы в БД;
                   array $data - данные для записи в таблицу в виде ключ-значение;
                    string $id - идентификатор записи в таблице.
    Description: для обновлеия данных в таблице.
         Return: NULL.
     */
    public function update($table, $data, $id) {
        $keys = array_keys($data);
        $string ='';
        foreach($keys as $key) {
            $string .=$key. '=:'.$key. ',';
        }
        $keys = rtrim($string, ',');
        $data['id'] = $id;

        $sql = "UPDATE {$table} SET {$keys} WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);

    }

    /**
    delete()
     Parameters: string $table - название таблицы в БД;
                    string $id - идентификатор записи в таблице.
    Description: для удаления записи в таблице.
         Return: NULL.
     */
    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id=:id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
    }
}