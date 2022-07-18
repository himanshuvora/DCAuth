<?php

declare(strict_types=1);

use Authentication\PasswordHasher\DefaultPasswordHasher;
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
            ->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addColumn('is_superuser', 'boolean', ['default' => false])
            ->addColumn('role', 'string')
            ->addTimestamps('created', 'modified')
            ->create();

        $this->table('posts')
            ->addColumn('title', 'string')
            ->addColumn('body', 'string')
            ->addColumn('user_id', 'integer')
            ->create();


        $this->table('users')->insert([
            // passwords are user = pwu and admin = pwa
            ['username' => 'user', 'password' => (new DefaultPasswordHasher())->hash('pwu'), 'role' => 'user'],
            ['username' => 'admin', 'password' => (new DefaultPasswordHasher())->hash('pwa'), 'role' => 'admin', 'is_superuser' => true],
        ])->update();
    }
}
