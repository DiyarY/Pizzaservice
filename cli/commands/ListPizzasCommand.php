<?php

namespace Pizzaservice\cli\commands;

use PizzaService\Propel\Models\PizzaQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Implementation of a command that gives information about the current contained values of the pizza-table.
 */
class ListPizzasCommand extends Command
{
    protected static $defaultName = "list:pizzas";

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
        //Table output which contains each customer in the database
        $table = new Table($output);

        $output->writeln("Currently the pizza table contains ".count($pizzas)." pizzas\n");

        //Sets the header of the table
        $table->setHeaders((["Pizza", "Price in €"]));
        $rows = [];
        foreach ($pizzas as $pizza)
        {
            //Sets a row with the needed information for each pizza
            $row[] = [$pizza->getName(), $pizza->getPrice()];
        }
        //Creates dynamic rows with the respective information for each pizza
        $table->setRows($row);
        $table->render();

        return Command::SUCCESS;
    }
}