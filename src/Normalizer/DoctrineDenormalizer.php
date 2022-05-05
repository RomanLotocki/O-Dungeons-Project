<?php

namespace App\Normalizer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Entity normalizer
 */
class DoctrineDenormalizer implements DenormalizerInterface
{
    /** @var EntityManagerInterface **/
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        // Exemple pour Movie::genres
        // "genres" : [1,2]
        // $data = 1 puis 2 (foreach)
        // $type = App\Entity\Genre (FQCN)
        return strpos($type, 'App\\Entity\\') === 0 && (is_numeric($data));
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->em->find($class, $data);
    }
}