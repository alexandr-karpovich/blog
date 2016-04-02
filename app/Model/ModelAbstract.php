<?php

namespace Model;

use Core\Db;

abstract class ModelAbstract implements ActiveRecordInterface
{
    protected $id;

    protected $create_date;

    protected $update_date;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * @param $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->create_date = $createDate;
    }

    /**
     * @return
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * @param $updateDate
     */
    public function setUpdateDate($updateDate)
    {
        $this->update_date = $updateDate;
    }

    /**
     * Get an object by id
     *
     * @param $id
     * @return ModelAbstract object
     */
    public static function get($id)
    {
        $db = Db::getInstance();

        $req = $db->prepare(sprintf('SELECT * FROM %s WHERE id = %s',
            static::getTableName(),
            intval($id)
        ));

        $req->execute();

        $data = $req->fetch();

        return static::hydrateObject($data);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $orderField
     * @param string $orderType
     * @return array
     */
    public static function getAll($limit = 10, $offset = 0, $orderField = 'create_date', $orderType = 'DESC')
    {
        $objectList = [];

        $db = Db::getInstance();

        $query = sprintf('SELECT * FROM %s', static::getTableName());

        if( $orderField )
        {
            if( !property_exists(static::class, $orderField) )
                throw new \InvalidArgumentException('There is no property '.$orderField.' in class '.static::class);

            $query = sprintf('%s ORDER BY %s %s',
                $query,
                $orderField,
                $orderType
            );
        }

        if( $limit !== null )
            $query = sprintf('%s LIMIT %s', $query, intval($limit));

        if( $offset !== null )
            $query = sprintf('%s OFFSET %s', $query, intval($limit) * intval($offset));

        $req = $db->query($query);

        // hydrate objects
        foreach($req->fetchAll() as $data)
        {
            $objectList[] = static::hydrateObject($data);
        }

        return $objectList;
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function update()
    {
        $db = Db::getInstance();

        $this->setUpdateDate(date('Y-m-d H:i:s'));

        $properties = get_object_vars($this);

        $setArray = [];
        foreach($properties as $property => $value)
        {
            $setArray[] = sprintf("`%s`='%s'", $property, strip_tags($value));
        }

        if( count($setArray) == 0 )
            throw new \Exception('No data to save');

        $setString = implode(', ', $setArray);

        // update query
        $query = sprintf('UPDATE %s SET %s WHERE id = %s',
            static::getTableName(),
            $setString,
            intval($this->getId())
        );

        // prepare query for execution
        $stmt = $db->prepare($query);

        // return updated record id or 0
        return ($stmt->execute()) ? $this->getId() : 0;
    }

    /**
     * Hydrate an object from array
     *
     * @param $data
     * @return object
     */
    protected static function hydrateObject($data)
    {
        $class = static::class;
        $object = new $class;

        foreach($data as $field => $value)
        {
            if( property_exists(static::class, $field) )
                $object->{$field} = $value;
        }

        return $object;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function delete()
    {
        if( !$this->id )
            throw new \Exception('Can not delete an object without Id');

        $db = Db::getInstance();

        $req = $db->prepare(sprintf('DELETE FROM %s WHERE id = %s',
            static::getTableName(),
            intval($this->id)
        ));
        return $req->execute();
    }

    /**
     * @return string
     */
    public function create()
    {
        $db = Db::getInstance();

        $date = new \DateTime();
        $dateStr = $date->format('Y-m-d H:i:s');

        $this->setUpdateDate($dateStr);
        $this->setCreateDate($dateStr);

        $properties = get_object_vars($this);
        unset($properties['id']);

        $dataArray = [];
        foreach($properties as $field => $value)
        {
            $dataArray["`".$field."`"] = "'".strip_tags($value)."'";
        }

        // insert query
        $query = sprintf('INSERT INTO %s (%s) VALUES (%s)',
            static::getTableName(),
            implode(', ', array_keys($dataArray)),
            implode(', ', array_values($dataArray))
        );

        // prepare query for execution
        $stmt = $db->prepare($query);

        $stmt->execute();

        return $db->lastInsertId();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function save()
    {
        return $this->id ? $this->update() : $this->create();
    }
}