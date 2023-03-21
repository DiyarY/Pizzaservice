<?php
namespace Pizzaservice\cli\commands;

use PizzaService\Propel\Models\Customer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Implementation of a command where the user is going to be asked to create new customer values to include them into the
 * customer-table of the pizzaService-database.
 *
 */
class CreateCustomerCommand extends Command
{
    protected static $defaultName = "create:customer";

    /**
     * Configuration of additional instances.
     *
     * A description about the function of the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Allows to add a new customer into the customer-table.\n");
    }

    /**
     * Creates and includes new customer values into the customer-table.
     *
     * The user is going to be asked about new values for the customer which are going to be included inside
     * customer-table after the confirmation question was confirmed.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws \PropelException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper("question");

        //Input for new customer values
        $inputCustomerFirstName = $helper->ask($input, $output, new Question("Please enter the first name of the new customer: \n"));

        $inputCustomerLastName = $helper->ask($input, $output, new Question("Please enter the last name of the new customer: \n"));

        $inputCustomerZip = $helper->ask($input, $output, new Question("Please enter the zip of the new customer: \n"));

        $inputCustomerCity = $helper->ask($input, $output, new Question("Where does the new customer live: \n"));

        $inputCustomerCountry = $helper->ask($input, $output, new Question("In which country does the new customer live: \n"));

        $output->writeln("Following new customer verifications were detected: $inputCustomerFirstName, $inputCustomerLastName, $inputCustomerZip, $inputCustomerCity, $inputCustomerCountry\n");

        //Confirms the new customer values
        $question = new ConfirmationQuestion("Do you want to save the new customer?", false, "/^(y|j)/i");

        if (!$helper->ask($input, $output, $question))
        {
            $output->writeln("Ok, no changes are made to the database.\n");
            return command::SUCCESS;
        }

        //Sets the new customer values
        $customer = new Customer();
        $customer->setFirstname($inputCustomerFirstName);
        $customer->setLastname($inputCustomerLastName);
        $customer->setZip($inputCustomerZip);
        $customer->setCity($inputCustomerCity);
        $customer->setCountry($inputCustomerCountry);

        //Includes the new customer values into the customer-table
        $customer->save();

        $output->writeln("The customer was added to the database successfully.\n");

        return Command::SUCCESS;
    }
}