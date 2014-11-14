<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 17.06.14
 * Time: 10:38
 */
class View {
    public $template_view;

    public function generate($content_view, $template_view, $data = null, $other_data = null) {
        require_once "./application/views/layouts/".$template_view;
    }
    public function generateAdmin($content_view, $template_view, $data = null, $other_data = null) {
        require_once "./application/views/admin/layouts/".$template_view;
    }
    public function generateAdminMessage($html_page, $message, $type_error) {
        require_once "./application/views/admin/layouts/".$html_page;
    }

}