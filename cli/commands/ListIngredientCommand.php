<?php

namespace Pizzaservice\cli\commands;

use IngredientQuery;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Implementation of a command that gives information about the current contained values of the ingredient-table.
 *
 * @class ListIngredientCommand
 */
class ListIngredientCommand extends Command
{
    protected static $defaultName = "list:ingredient";

    /**
     * Configuration of instances.
     *
     * A description about the function of the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Lists up all ingredient_name values from the ingredient-table\n");
    }

    /**
     * Lists defined values from the ingredient-table.
     *
     * Shows the current total number of all contained ingredient values.
     *
     * Runs through the ingredient-table to initialise and list up every ingredient_name value
     * from the ingredient-table.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Array of ingredient-table
        $ingredients = IngredientQuery::create()->find();

        echo "Currently there is a total of ".count($ingredients)." ingredients inside the ingredient-table\n";

        //Runs through the ingredient-table to initialise and list up every ingredient_name value
        foreach ($ingredients as $ingredient)
        {
            echo $ingredient->getName()."\n";
        }

        return Command::SUCCESS;
    }
}