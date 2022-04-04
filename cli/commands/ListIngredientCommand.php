<?php

namespace Pizzaservice\cli\commands;

use Ingredient;
use IngredientQuery;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class ListIngredientCommand extends Command
{
    protected static $defaultName = "list:ingredient";

    protected function configure()
    {
        $this->setDescription("Lists up all ingredients from the ingredient-table");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ingredients = IngredientQuery::create()->find();

        echo "Currently there is a total of ".count($ingredients)." ingredients inside the ingredient-table";

        foreach ($ingredients as $ingredient)
        {
            echo $ingredient->getName()."\n";
        }

        return Command::SUCCESS;
    }
}