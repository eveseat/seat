<?php

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015, 2016, 2017, 2018, 2019  Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AbstractSeatPlugin.
 *
 * @package App\Providers
 */
abstract class AbstractSeatPlugin extends ServiceProvider
{
    /**
     * Return an URI to a CHANGELOG.md file or an API path which will be providing changelog history.
     *
     * @example https://raw.githubusercontent.com/eveseat/seat/master/LICENSE
     * @exemple https://api.github.com/repos/eveseat/web/releases
     *
     * @return string|null
     */
    public function getChangelogUri(): ?string
    {
        return null;
    }

    /**
     * In case the changelog is provided from an API, this will help to determine which attribute is containing the
     * changelog body.
     *
     * @exemple body
     *
     * @return string|null
     */
    public function getChangelogBodyAttribute(): ?string
    {
        return null;
    }

    /**
     * In case the changelog is provided from an API, this will help to determine which attribute is containing the
     * version name.
     *
     * @example tag_name
     *
     * @return string|null
     */
    public function getChangelogTagAttribute(): ?string
    {
        return null;
    }

    /**
     * Determine if the changelog is provided by an API.
     *
     * @return bool
     */
    final public function isChangelogApi(): bool
    {
        return ! is_null($this->getChangelogBodyAttribute()) && ! is_null($this->getChangelogTagAttribute());
    }

    /**
     * Return the plugin description.
     *
     * @example The SeAT Web Interface
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return null;
    }

    /**
     * Return the plugin public name as it should be displayed into settings.
     *
     * @example SeAT Web
     *
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Return the plugin repository address.
     *
     * @example https://github.com/eveseat/web
     *
     * @return string
     */
    abstract public function getPackageRepositoryUrl(): string;

    /**
     * Return the packagist alias.
     *
     * @return string
     */
    final public function getPackagistAlias(): string
    {
        return sprintf('%s/%s',
            $this->getPackagistVendorName(),
            $this->getPackagistPackageName());
    }

    /**
     * Return the plugin technical name as published on package manager.
     *
     * @example web
     *
     * @return string
     */
    abstract public function getPackagistPackageName(): string;

    /**
     * Return the plugin vendor tag as published on package manager.
     *
     * @example eveseat
     *
     * @return string
     */
    abstract public function getPackagistVendorName(): string;

    /**
     * Return the plugin installed version.
     *
     * @return string
     */
    abstract public function getVersion(): string;

    /**
     * Return the package version badge for UI display.
     *
     * @return string
     */
    final public function getVersionBadge(): string
    {
        return sprintf('//img.shields.io/packagist/v/%s/%s.svg?style=flat-square',
            $this->getPackagistVendorName(),
            $this->getPackagistPackageName());
    }

    /**
     * Register new permissions into the core to the specified scope.
     *
     * A valid permission must be structured as followed :
     *  $permission_name => [
     *      'label' => $permission_label_translation_key,
     *      'description' => $permission_description_translation_key,
     *  ]
     *
     * @param string $permissions_path A path to permissions elements.
     * @param string $scope An optional scope into which register permissions (global will be used if not specified).
     */
    final public function registerPermissions(string $permissions_path, string $scope = 'global')
    {
        $key = sprintf('seat.permissions.%s', $scope);

        $this->mergeConfigFrom($permissions_path, $key);
    }

    /**
     * Register new path to annotations dictionary used by Swagger API Documentation.
     *
     * @param string|string[] $paths
     */
    final public function registerApiAnnotationsPath($paths)
    {
        // ensure current annotation setting is an array of path or transform into it
        $current_annotations = config('l5-swagger.paths.annotations', []);

        if (! is_array($current_annotations))
            $current_annotations = [$current_annotations];

        if (! is_array($paths))
            $paths = [$paths];

        // merge paths together and update config
        config([
            'l5-swagger.paths.annotations' => array_unique(array_merge($current_annotations, $paths)),
        ]);
    }
}
