<?php

namespace Stefanius\MySqlHelper\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateNewDatabaseCommand extends BaseCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('create:database')
        ;
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $databaseName = $this->askQuestion($input, $output, new Question('Databasename'));
        $rootUser = $this->askQuestion($input, $output, new Question('Root / adminuser'));
        $rootPassword = $this->askQuestion($input, $output, new Question('Password for ' . $rootUser));

        $mysqlSafeDatabaseName = $this->generateMySqlSafeSlug($databaseName);
        $mysqlDbPassword = $this->generatePassword();

        $createDatabaseQuery = $this->getCreateDatabaseQuery($mysqlSafeDatabaseName);
        $createUserQuery = $this->getCreateUserQuery($mysqlSafeDatabaseName, $mysqlDbPassword);
        $grantQuery = $this->getGrantAllQuery($mysqlSafeDatabaseName, $mysqlSafeDatabaseName);

        $this->executeQuery($rootUser, $rootPassword, $createDatabaseQuery);
        $this->executeQuery($rootUser, $rootPassword, $createUserQuery);
        $this->executeQuery($rootUser, $rootPassword, $grantQuery);

        $output->writeln('Database user: "' . $mysqlSafeDatabaseName . '"');
        $output->writeln('Database name: "' . $mysqlSafeDatabaseName . '"');
        $output->writeln('Database password: "' . $mysqlSafeDatabaseName . '"');
    }
}
