<?php

namespace Pizzaservice\cli\commands;

use Pizza;
use PizzaQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Implementation of a command that gives information about the current contained values of the pizza-table.
 *
 * @class ListPizzaCommand
 */
class ListPizzaCommand extends Command
{
    protected static $defaultName = "list:pizza";

    /**
     * Configuration of additional instances.
     *
     * A description about the function of the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Lists up all pizza_name values from the order-table\n");
    }

    /**
     * Lists defined values from the pizza-table.
     *
     * Shows the current total number about all contained pizza-values.
     *
     * Runs through the pizza-table to initialise and list up all available pizza_name values
     * from the pizza-table.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Array of pizza-table
        $pizzas = PizzaQuery::create()->find();

        echo "Currently the pizza table contains ".count($pizzas)." pizzas\n";

        //Runs through the pizza-table to initialise and list up all pizza_name values
        foreach ($pizzas as $pizza)
        {
            echo $pizza->getName()."\n";
        }

        return Command::SUCCESS;
    }
}