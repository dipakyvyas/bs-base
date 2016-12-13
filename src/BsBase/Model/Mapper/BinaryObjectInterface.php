<?php
namespace BsBase\Model\Mapper;

interface BinaryObjectInterface
{

    public function getBinary();

    public function setBinary($binary);

    public function getFilename();

    public function setFilename($filename);

    public function getMime();

    public function setMime($mime);
}