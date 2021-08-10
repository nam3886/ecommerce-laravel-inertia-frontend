<?php

namespace App\Contracts;

/**
 * Interface BaseContract
 * @package App\Contracts
 */
interface BaseContract
{
    /**
     * Create a model instance
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a model instance
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id);

    /**
     * Delete one by Id
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

    /**
     * Return all model rows
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all($columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc');

    /**
     * @param array $sorts
     * @param array $filters
     * @param int $paginate
     * @param array $columns
     * @param string $order
     * @return mixed
     */
    public function queryParams(array $sorts, array $filters, int $paginate = 15, array $columns = ['*'], string $order = 'id');

    /**
     * Find one by ID
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Find one by ID or throw exception
     * @param int $id
     * @return mixed
     */
    public function findOneOrFail(int $id);

    /**
     * Find based on a different column
     * @param array $data
     * @return mixed
     */
    public function findBy(array $data);

    /**
     * Find one based on a different column
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data);

    /**
     * Find one based on a different column or through exception
     * @param array $data
     * @return mixed
     */
    public function findOneByOrFail(array $data);
}
