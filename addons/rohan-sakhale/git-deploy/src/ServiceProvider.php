<?php

namespace RohanSakhale\GitDeploy;

use Statamic\Providers\AddonServiceProvider;
use Illuminate\Support\Facades\Route;
use Statamic\Facades\CP\Nav;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => [
            'git-deploy' => 'RohanSakhale\GitDeploy\Http\Controllers\DeployController@index',
            'git-deploy/push' => 'RohanSakhale\GitDeploy\Http\Controllers\DeployController@commitAndPush',
        ],
    ];

    public function bootAddon()
    {
        parent::bootAddon();

        // Correct way to add a menu item in Statamic v4
        $this->booted(function () {
            Nav::extend(function ($nav) {
                $nav->create('Deploy')
                    ->section('Tools') // Place it under "Tools" in CP
                    ->route('git-deploy')
                    ->icon('upload');
            });
        });
    }
}
