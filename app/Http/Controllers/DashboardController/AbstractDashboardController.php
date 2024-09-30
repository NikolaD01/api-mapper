<?php

namespace AM\App\Http\Controllers\DashboardController;

use AM\App\Http\Utility\Helpers\View;

abstract class AbstractDashboardController
{
    protected string $menuSlug;
    protected string $pageTitle;
    protected string $menuTitle;
    protected string $capability;
    protected string $view;

    public function __construct() {
        add_action('admin_menu', [$this, 'addMenu']);

    }

    abstract public function addMenu() : void;
    abstract public function processForm() : void;

    public function render() : void
    {
        if (!current_user_can($this->capability)) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        }
        View::load('dashboard');

    }


}