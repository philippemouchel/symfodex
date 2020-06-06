<?php

namespace App\Helper;


use Gedmo\Sluggable\Util\Urlizer;
use PokePHP\PokeApi;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EntityHelper
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Urlizer
     */
    protected $urlizer;

    /**
     * PokeAPI V2 connector.
     * @var PokeApi
     */
    protected $papi;

    /**
     * CategoryHelper constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->urlizer = new Urlizer();
        $this->papi = new PokeApi();
    }

    /**
     * Return all existing translations for an entity.
     * @param $entity
     * @return mixed
     */
    public function getTranslations($entity)
    {
        $doctrine = $this->container->get('doctrine');
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository('Gedmo\Translatable\Entity\Translation');
        return $repository->findTranslations($entity);
    }

}
