<?php
use Migrations\AbstractMigration;

class AddFileStorageOrderField extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('file_storage');

        $table->addColumn('order', 'integer', [
            'default' => 0,
            'null' => true,
        ]);

        $table->update();
    }
}
