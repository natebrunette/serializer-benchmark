<?php

namespace TSantos\Benchmark\Bench;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use TSantos\Benchmark\AbstractBench;
use TSantos\Benchmark\Person;

/**
 * Class SymfonyBench
 *
 * @author Tales Santos <tales.augusto.santos@gmail.com>
 */
class SymfonyBench extends AbstractBench
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function init()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer(), new ArrayDenormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    protected function doBenchSerialize(array $objects)
    {
        $this->serializer->serialize($objects, 'json');
    }

    protected function doBenchDeserialize(string $content)
    {
        $this->serializer->deserialize($content, Person::class . '[]', 'json');
    }
}