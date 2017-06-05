<?php

namespace App\Models;

use Peak\Bedrock\Application;
use Peak\Providers\Laravel\Database;

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

class Migration extends AbstractMigration 
{
    /**
     * Prepare migration script stuff
     */
    public function init()
    {
        $this->db = new Database(Application::get('Config')->get(PHINX_ENV.'.db'));
        $this->schema = $this->db->schema();
    }
}
