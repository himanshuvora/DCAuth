<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddPostsAndUserstable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('users')
        ->addColumn('username','string')
        ->addColumn('password','string')
        ->addColumn('is_superuser','boolean',['default'=>false])
        ->addColumn('role','string')
        ->addTimestamps('created','modified')
        ->create();

        $this->table('posts')
        ->addColumn('title','string')
        ->addColumn('body','string')
        ->addColumn('user_id','integer')
        ->create();
    }
}
