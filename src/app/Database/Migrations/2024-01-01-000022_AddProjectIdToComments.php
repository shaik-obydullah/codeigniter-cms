<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProjectIdToComments extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE comments ADD COLUMN project_id INT(11) NULL AFTER article_id");
        $this->db->query("ALTER TABLE comments MODIFY COLUMN article_id INT(11) NULL");
        $this->db->query("ALTER TABLE comments ADD CONSTRAINT fk_comments_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE comments DROP FOREIGN KEY fk_comments_project");
        $this->db->query("ALTER TABLE comments DROP COLUMN project_id");
    }
}
