<?php

namespace EMS\FormBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class EMSFormExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('emsf.hashcash.difficulty', $config['hashcash_difficulty']);
        $container->setParameter('emsf.endpoints', $config['endpoints']);
        $container->setParameter('emsf.ems_config', [
            'type' => $config['instance']['type'],
            'type-form-field' => $config['instance']['type-form-field'],
            'type-form-markup' => $config['instance']['type-form-markup'],
            'type-form-subform' => $config['instance']['type-form-subform'],
            'form-field' => $config['instance']['form-field'],
            'form-template-field' => $config['instance']['form-template-field'],
            'theme-field' => $config['instance']['theme-field'],
            'submission-field' => $config['instance']['submission-field'],
        ]);
    }
}
