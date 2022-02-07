<?php

class Product
{
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        $identityMap = IdentityMap::getInstance();
        $searchList = [];

        foreach ($ids as $id) {
            $key = $identityMap->getGlobalKey("Prod", $id);

            if (array_key_exists($key, $identityMap->getIdentityMap())) {
                echo "Объект существует ";
                $searchList[] = $identityMap->getIdentityMap()[$key];
            } else {
                $newProduct = $this->getDataFromSource(['id' => [$id]]);
                foreach ($newProduct as $item) {
                    $identityMap->add(new Prod($item['id'], $item['name'], $item['price']));
                    $searchList[] = $identityMap->getIdentityMap()[$key];
                }
            }
        }

        return $searchList;
    }


    public function fetchAll(): array
    {
        $identityMap = IdentityMap::getInstance();
        foreach ($this->getDataFromSource() as $item) {

            $identityMap->add(new Prod($item['id'], $item['name'], $item['price']));

        }

        return $identityMap->getIdentityMap();
    }

    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
