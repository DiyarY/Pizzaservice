<?php
namespace Pizzaservice\cli\commands;

use PizzaService\Propel\Models\OrderQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Implementation of a command that gives information about the current contained values of the order-table.
 */
class ListOrdersCommand extends Command
{
    protected static $defaultName = "list:orders";

    /**
     * Configuration of additional instances.
     *
     * A description about the function of the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Lists up all order_name values from the order-table");
    }

    /**
     * Lists defined values from the order-table.
     *
     * Shows the current total number about all contained order values.
     *
     * Runs through the order-table to initialise and list up  every order_name value from the order-table.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Array of order-table
        $orders = OrderQuery::create()->find();

        $output->writeln("Currently the order-table contains ".count($orders)." orders\n");

        //Runs through the order-table to initialise and list up every order_name values
        foreach ($orders as $order)
        {
            $output->writeln($order->getName()."\n");
        }


        return Command::SUCCESS;
    }
}