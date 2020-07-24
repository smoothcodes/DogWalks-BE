<?php

namespace App\DataFixtures;

use App\Entity\Attribute;
use App\Entity\AttributeCategory;
use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    }

    private function createItems()
    {
    }
}
