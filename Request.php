<?php

class Request {
    
    public static function get(): array {
        return [
            'name' => 'my name'
        ];
    }

    public static function create($data): array {
        return [
            'message' => 'object created',
            'object' => $data
        ];
    }

    public static function delete($id): array {
        return [
            'message' => 'object with id ' . $id . ' is deleted'
        ];
    }

}