<?php

namespace Model;


interface ActiveRecordInterface
{
    public static function get($id);

    public static function getAll($limit = null, $offset = null, $orderField = null, $orderType = 'DESC');

    public function save();

    public function delete();

    public static function getTableName();
}