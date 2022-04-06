<?php
namespace Pizzaservice\cli\commands;

use CustomerQuery;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Implementation of a command that gives information about the current contained values of the customer-table.
 *
 * @class ListCustomerCommand
 */
class ListCustomerCommand extends Command
{
    protected static $defaultName = "list:customer";

    /**
     * Configuration of instances.
     *
     * A description about the function of the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Lists up all customer_name values from the customer-table\n");
    }

    /**
     * Lists defined values from the customer-table.
     *
     * Shows the current total number of all contained customer values.
     *
     * Runs through the customer-table to initialise and list up all available customer_FirstName values
     * from the customer-table.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Array of customer-table
        $customers = CustomerQuery::create()->find();

        echo "Currently there is a total of ".count($customers)." customers\n";

        //Runs through the customer-table to initialise and list up all customer_firstName values
        foreach ($customers as $customer)
        {
            echo $customer->getFirstName()."\n";
        }

        return Command::SUCCESS;
    }
}