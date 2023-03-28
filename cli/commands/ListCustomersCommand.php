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
        //Table output which contains each customer in the database
        $table = new Table($output);

        $output->writeln("Currently there is a total of ".count($customers)." customers\n");

        //Sets the header of the table
        $table->setHeaders(["Firstname", "Lastname", "ZIP", "City", "Country"]);
        $rows = [];
        foreach ($customers as $customer)
        {
            //Sets a row with the needed information for each customer
            $row[] = [$customer->getFirstName(), $customer->getLastName(), $customer->getZip(), $customer->getCity(), $customer->getCountry()];
        }
        //Creates dynamic rows with the respective information for each customer
        $table->setRows($row);
        $table->render();

        return Command::SUCCESS;
    }
}