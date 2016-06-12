<?php

namespace Stefanius\MySqlHelper\Constant;

class QueryConstant
{
    const CREATE_DATABASE = 'CREATE DATABASE %s;';

    const CREATE_USER = "CREATE USER %s@localhost IDENTIFIED BY '%s';";

    const GRANT_ALL_PRIVILEGES = "GRANT ALL PRIVILEGES ON %s.* TO %s@localhost;";

    const FLUSH_PRIVILEGES = "FLUSH PRIVILEGES;";
}
