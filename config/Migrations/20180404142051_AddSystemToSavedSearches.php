<?php
use Migrations\AbstractMigration;

class AddSystemToSavedSearches extends AbstractMigration
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
        $table = $this->table('saved_searches');

        if (! $table->hasColumn('system')) {
            $table->addColumn('system', 'boolean', [
                'default' => false,
                'null' => false,
            ]);
        }

        $table->update();
    }
}
