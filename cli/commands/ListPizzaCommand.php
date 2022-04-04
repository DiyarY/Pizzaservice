<?php

namespace Pizzaservice\cli\commands;

use Pizza;
use PizzaQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Creation of terminal-command with symfony which lists all the available pizza sorts of the pizza table
 * from the pizzaService database.
 */
class ListPizzaCommand extends Command
{
    protected static $defaultName = "list:pizza";

    protected function configure()
    {
        $this->setDescription("Lists up all pizzas");
    }

    /**
     * Lists the content of the pizza-table from the pizzaService-database.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pizzas = PizzaQuery::create()->find();

        echo "Currently the pizza table contains ".count($pizzas)." pizzas\n";

        foreach ($pizzas as $pizza)
        {
            echo $pizza->getName()."\n";
        }

        return Command::SUCCESS;
    }
}