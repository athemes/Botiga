<?php

/**
 * Tabs Nav Items
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-row">
    <div class="botiga-dashboard-column botiga-dashboard-column-9">
        <div class="botiga-dashboard-card botiga-dashboard-card-top-spacing">
            <div class="botiga-dashboard-card-body">

                <nav class="botiga-dashboard-tabs-nav" data-tab-wrapper-id="settings-tab">
                    <ul>
                        <li class="botiga-dashboard-tabs-nav-item aaa">
                            <a href="#" class="botiga-dashboard-tabs-nav-link" data-tab-to="test1">aaa</a>
                        </li>
                        <li class="botiga-dashboard-tabs-nav-item aaa">
                            <a href="#" class="botiga-dashboard-tabs-nav-link" data-tab-to="test2">aaa</a>
                        </li>
                        <li class="botiga-dashboard-tabs-nav-item aaa">
                            <a href="#" class="botiga-dashboard-tabs-nav-link" data-tab-to="test3">aaa</a>
                        </li>
                    </ul>
                </nav>
                
                <div class="botiga-dashboard-tab-content-wrapper" data-tab-wrapper-id="settings-tab">					
                    <div class="botiga-dashboard-tab-content" data-tab-content-id="test1">
                        test1
                    </div>
                    <div class="botiga-dashboard-tab-content" data-tab-content-id="test2">
                        test2
                    </div>
                    <div class="botiga-dashboard-tab-content" data-tab-content-id="test3">
                        test3
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="botiga-dashboard-column botiga-dashboard-column-3">

    </div>
</div>
