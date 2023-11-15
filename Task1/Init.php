<?php

require_once 'Faker.php';
require_once 'DatabaseConnector.php';

/**
 * Класс для работы с таблицей 'test'
 *
 * Создаёт таблицу 'test', заполняет данные таблицы и делает выборку
 */
final class Init
{
    /**
     * Объект подключения к БД
     *
     * @var PDO
     */
    private PDO $connector;
    /**
     * Объект для работы с рандомными данными
     *
     * @var Faker
     */
    private Faker $faker;

    /**
     * Создание таблицы 'test'
     *
     * @return void
     * @throws PDOException если не удалось создать таблицу
     */
    private function create(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS test (
                id SERIAL PRIMARY KEY,
                field1 VARCHAR(255),
                field2 VARCHAR(255),
                field3 INT,
                field4 DATE,
                result VARCHAR(255) NOT NULL
        )";
        try {
            $this->connector->exec($sql);
        } catch (PDOException $e) {
            throw new PDOException("Error creating table: " . $e->getMessage(), 0, $e);
        }
    }
    /**
     * Заполняет таблицу 'test' данными
     *
     * @return void
     * @throws PDOException если не удалось добавить в таблицу данные
     */
    private function fill(): void
    {
        $values = [];
        $placeholders = [];
        $this->prepareSqlData($values, $placeholders, 101);
        $sql = "INSERT INTO test (field1, field2, field3, field4, result) VALUES " . implode(',', $placeholders);
        try {
            $stmt = $this->connector->prepare($sql);
            $stmt->execute($values);
        } catch (PDOException $e) {
            throw new PDOException("Error insert in table `test`: " . $e->getMessage(), 0, $e);
        }

    }

    /**
     * Подготовка данных для оптимизированного импорта
     *
     * @param array $values
     * @param array $placeholders
     * @param int $count
     * @return void
     */
    private function prepareSqlData(array &$values, array &$placeholders, int $count = 100): void
    {
        for ($i = 0; $i < $count; $i++) {
            $data = $this->faker->generateRandomData();
            $values = array_merge($values, $data);
            $placeholders[] = '(' . implode(',', array_fill(0, count($data), '?')) . ')';
        }
    }

    /**
     * выбирает из таблицы test, данные по критерию: result среди значений 'normal' и 'success'
     *
     * @return array
     */
    public function get(): array
    {
        $sql = "SELECT * FROM test WHERE result IN ('normal', 'success')";
        $stmt = $this->connector->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function __construct()
    {
        $this->faker = new Faker();
        $this->connector = DatabaseConnector::connect();
        $this->create();
        $this->fill();
    }
}