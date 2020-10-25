<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                      ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ORDER BY `user_menu`.`menu` ASC
                ";
        return $this->db->query($query)->result_array();
    }

    public function getMenuName($id_submenu)
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                      ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                   WHERE `user_sub_menu`.`id` = $id_submenu
                ";
        return $this->db->query($query)->row_array();
    }
}
