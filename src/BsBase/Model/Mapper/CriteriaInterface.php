<?php
namespace BsBase\Model\Mapper;

/**
 *
 * @author mat_wright
 *
 */
interface CriteriaInterface
{

    /**
     *
     * @param array $data
     */
    public function setData(array $data);

    public function getQuery();
}