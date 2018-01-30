<?php

/*
 * This file is part of the hyn/multi-tenant package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://laravel-tenancy.com
 * @see https://github.com/hyn/multi-tenant
 */

namespace Hyn\Tenancy\Providers\Tenants;

use Hyn\Tenancy\Contracts\CurrentHostname;
use Hyn\Tenancy\Jobs\HostnameIdentification;
use Hyn\Tenancy\Traits\DispatchesJobs;
use Illuminate\Support\ServiceProvider;

class HostnameProvider extends ServiceProvider
{
    use DispatchesJobs;

    public function provides()
    {
        return [CurrentHostname::class];
    }

    public function register()
    {
        $this->app->singleton(CurrentHostname::class, function () {
            $hostname = $this->dispatch(new HostnameIdentification);

            return $hostname;
        });
    }
}
