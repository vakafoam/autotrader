<?php

namespace AppBundle\Menu;

// Third party bundles
use Knp\Menu\MenuFactory;

class Builder
{
  public function mainMenu(MenuFactory $factory, array $options)
  {
    // Menu bundle (external)
    $menu = $factory->createItem('root');
    $menu->addChild('Home', ['route' => 'homepage']);
    $menu->addChild('Offer', ['route' => 'offer']);
    $menu->addChild('Manage Cars', ['route' => 'car_index']);

    // Add bootstrap class for menu items
    $menu->setChildrenAttribute('class', 'nav navnar-nav');


    return $menu;
  }
}
