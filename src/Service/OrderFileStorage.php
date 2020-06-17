<?php

namespace App\Service;

use Cake\ORM\TableRegistry;

final class OrderFileStorage
{
    /**
     * Order files
     * @param  mixed[] $files Files to order
     * @return mixed[] result
     */
    public static function orderFiles(array $files): array
    {
        $result = [
            'success' => false,
            'data' => [],
            'message' => __('There was an error changing file order'),
        ];

        if (empty($files) || ! is_array($files)) {
            return $result;
        }

        $table = TableRegistry::getTableLocator()->get('FileStorage');
        foreach ($files as $order => $fileDetails) {
            $file = $table->get($fileDetails['key']);
            $file->set('order', $order);
            $table->saveOrFail($file);
        }

        $result = [
            'success' => true,
            'data' => [],
            'message' => __('File order has been changed'),
        ];

        return $result;
    }
}
