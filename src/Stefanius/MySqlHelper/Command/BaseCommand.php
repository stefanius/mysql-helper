<?php

namespace Stefanius\MySqlHelper\Command;

use Stefanius\MySqlHelper\Constant\QueryConstant;
use Stefanius\Slugifier\Manipulators\SlugManipulator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Process\Process;

abstract class BaseCommand extends Command
{
    /**
     * @param int $length
     *
     * @return string
     */
    protected function generatePassword($length = 10)
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * @return SlugManipulator
     */
    protected function getSlugifier()
    {
        return new SlugManipulator();
    }

    /**
     * @param $string
     *
     * @return string
     */
    protected function slugify($string)
    {
        return $this->getSlugifier()->manipulate($string);
    }

    /**
     * @param $string
     *
     * @return string
     */
    protected function generateMySqlSafeSlug($string)
    {
        return str_replace('-', '_', $this->slugify($string));
    }

    protected function askQuestion($input, $output, $question)
    {
        $helper = $this->getHelper('question');

        return $helper->ask($input, $output, $question);
    }

    protected function getCreateDatabaseQuery($databaseName)
    {
        return sprintf(QueryConstant::CREATE_DATABASE, $databaseName);
    }

    protected function getCreateUserQuery($userName, $password)
    {
        return sprintf(QueryConstant::CREATE_USER, $userName, $password);
    }

    protected function getGrantAllQuery($databaseName, $userName)
    {
        return sprintf(QueryConstant::GRANT_ALL_PRIVILEGES, $databaseName, $userName);
    }

    protected function getFlushQuery()
    {
        return QueryConstant::FLUSH_PRIVILEGES;
    }

    protected function getMysqlCliCommand($user, $password)
    {
        return sprintf('mysql -u%s -p%s -e', $user, $password);
    }

    protected function executeQuery($user, $password, $query)
    {
        $fullCliCommand = sprintf('%s "%s"', $this->getMysqlCliCommand($user, $password), $query);

        $process = new Process($fullCliCommand);
        $process->run();
    }
}
