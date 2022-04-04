<?php
namespace Pizzaservice\cli\commands;

use Customer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Creation of a command where the user is going to be asked for values about a new customer and included inside the
 * customer-table of the pizzaService-database.
 */
class CreateCustomerCommand extends Command
{
    protected static $defaultName = "create:customer";

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Creates a new customer with its associated values");
    }

    /**
     * Includes new customer-verification.
     *
     * The user is going to be asked to create the respective new customer-values to verify, confirm, and include them
     * inside the customer-table of the pizzaService-database.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws \PropelException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper("question");

        //Input for new customer-verification
        $question = new Question("Please enter the first name of the new customer: \n");
        $inputCustomerFirstName = $helper->ask($input, $output, $question);

        $question = new Question("Please enter the last name of of the new customer: \n");
        $inputCustomerLastName = $helper->ask($input, $output, $question);

        $question = new Question("Please enter the zip of the new Customer: \n");
        $inputCustomerZip = $helper->ask($input , $output, $question);

        $question = new Question("Where does the new customer live\n");
        $inputCustomerCity = $helper->ask($input, $output, $question);

        $question = new Question("In which country does the new customer live\n");
        $inputCustomerCountry = $helper->ask($input, $output, $question);

        //Lists up the new customer-values
        echo "Following new customer verifications were detected: $inputCustomerFirstName, $inputCustomerLastName, $inputCustomerZip, $inputCustomerCity, $inputCustomerCountry";

        //Confirms the new customer-values
        $question = new ConfirmationQuestion("Do you want to save the new detected customer verifications", false, "/^(y|j)/i");

        if (!$helper->ask($input, $output, $question))
        {
            echo "The specified data of the customer will be deleted now\n";
            return command::SUCCESS;
        }

        //Set the new customer-verification inside the customer-table
        $customer = new Customer();
        $customer->setFirstname($inputCustomerFirstName);
        $customer->setLastname($inputCustomerLastName);
        $customer->setZip($inputCustomerZip);
        $customer->setCity($inputCustomerCity);
        $customer->setCountry($inputCustomerCountry);

        //Include the new customer-verification inside the customer-table
        $customer->save();

        echo "The new customer-verification is included inside the customer-table";
    }
}