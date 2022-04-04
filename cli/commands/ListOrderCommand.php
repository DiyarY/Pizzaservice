<?php
namespace Pizzaservice\cli\commands;

use Order;
use OrderQuery;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Creation of terminal-command with symfony which lists all the available orders of the order-table
 * from the pizzaService database.
 */
class ListOrderCommand extends Command
{
    protected static $defaultName = "list:order";

    /**
     * Configures the instances.
     *
     * Contains configured instances which can be entered over the command-line.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Lists up all orders from the order-table");
    }

    /**
     * Lists the content of the order-table.
     *
     * Searches for every order-name from the order-table to display them through the command-line.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $orders = OrderQuery::create()->find();

        echo "Currently the order-table contains ".count($orders)." orders";

        foreach ($orders as $order)
        {
            echo $order->getName()."\n";
        }

        return Command::SUCCESS;
    }
}