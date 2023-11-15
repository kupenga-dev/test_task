<?php


/**
 * Класс для работы с фейковыми данными
 */
class Faker
{
    /**
     * Генерирует рандомные данные для таблицы 'test'
     *
     * @return array
     */
    public function generateRandomData(): array
    {
        $field1 = $this->randomString();
        $field2 = $this->randomString();
        $field3 = rand(0, 1000);
        $field4 = date('Y-m-d', rand(strtotime('2000-01-01'), strtotime('2020-12-31')));
        $result = $this->randomResultValue();

        return [$field1, $field2, $field3, $field4, $result];
    }

    /**
     * Генерирует рандомную строку по указанной длине, стандарт - 10 символов
     *
     * @param int $length
     * @return string
     */
    public function randomString(int $length = 10): string
    {
        $characters = '0123456789#abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Генерирует рандомное наполнение поля 'result', согласно ТЗ
     *
     * @return string
     */
    public function randomResultValue(): string
    {
        $values = ["normal", "success", "test1", "test2"];
        $randomIndex = rand(0, count($values) - 1);
        return $values[$randomIndex];
    }
}