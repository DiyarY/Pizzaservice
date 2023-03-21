<?php
namespace Pizzaservice\cli\commands;

use PizzaService\Propel\Models\CustomerQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Implementation of a command that gives information about the current contained values of the customer-table.
 */
class ListCustomersCommand extends Command
{
    protected static $defaultName = "list:customers";

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
        $output->writeln("Currently there is a total of ".count($customers)." customers\n");

        $table = new Table($output);
        $table->setHeaders(["Firstname", "Lastname", "ZIP", "City", "Country"]);
        foreach ($customers as $customer)
        {
                //The values of the customer-table will be viewed in table format
                $table->setRows([
                    [$customer->getFirstName(), $customer->getLastName(), $customer->getZip(), $customer->getCity(), $customer->getCountry()],
                ]);
            $table->render();
        }
        return Command::SUCCESS;
    }
}