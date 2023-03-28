<?php

namespace Pizzaservice\cli\commands;

use PizzaService\Propel\Models\IngredientQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Implementation of a command that gives information about the current contained values of the ingredient-table.
 */
class ListIngredientsCommand extends Command
{
    protected static $defaultName = "list:ingredients";

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
        //Table output which contains each ingredient in the database
        $table = new Table($output);

        $output->writeln("Currently there is a total of ".count($ingredients)." ingredients inside the ingredient-table\n");

        //Sets the header of the table
        $table->setHeaders(["Ingredient"]);
        $row = [];
        foreach ($ingredients as $ingredient)
        {
            //Sets a row with the name of each ingredient
            $row[] = [$ingredient->getName()];
        }
        //Creates dynamic rows with each ingredient
        $table->setRows($row);
        $table->render();

        return Command::SUCCESS;
    }
}