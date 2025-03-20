<?php

namespace RohanSakhale\GitDeploy\Tests;

use RohanSakhale\GitDeploy\ServiceProvider;
use Statamic\Testing\AddonTestCase;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
