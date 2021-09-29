<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Permission;
use App\PermissionUser;
use App\Channel;
use App\Classes;
use App\ArmAgahi;
use App\Box_Type;
use App\Box_Prog_Group;
use App\Cast;
use App\Product;
use App\Title;
use App\Owner;
use App\Adver_Type;
use App\Adver_Type_Coef;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $access = [];
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 10)->create();
        factory(PermissionUser::class,10)->create();
        factory(Channel::class,10)->create();
        factory(Classes::class,10)->create();

        
        factory(Box_Type::class,10)->create();
        factory(Box_Prog_Group::class,10)->create();
        factory(Cast::class , 10)->create();
        factory(Product::class, 10)->create();
        factory(Title::class,10)->create();
        factory(Owner::class,10)->create();
        factory(Adver_Type::class, 10)->create();

        
        $access[] = Permission::create(['permission_name' =>'Get_Permission_To_Other_User']);

        $access[] = Permission::create(['permission_name' => 'Visit_User']);
        $access[] = Permission::create(['permission_name' => 'Insert_User']);
        $access[] = Permission::create(['permission_name' => 'Edit_User']);
        $access[] = Permission::create(['permission_name' => 'Delete_User']);

        $access[] = Permission::create(['permission_name' => 'Visit_Channel']);
        $access[] = Permission::create(['permission_name' => 'Insert_Channel']);
        $access[] = Permission::create(['permission_name' => 'Edit_Channel']);
        $access[] = Permission::create(['permission_name' => 'Delete_Channel']);

        $access[] = Permission::create(['permission_name' => 'Visit_Classes']);
        $access[] = Permission::create(['permission_name' => 'Insert_Classes']);
        $access[] = Permission::create(['permission_name' => 'Edit_Classes']);
        $access[] = Permission::create(['permission_name' => 'Delete_Classes']);

        $access[] = Permission::create(['permission_name' => 'Visit_ArmAgahi']);
        $access[] = Permission::create(['permission_name' => 'Insert_ArmAgahi']);
        $access[] = Permission::create(['permission_name' => 'Edit_ArmAgahi']);
        $access[] = Permission::create(['permission_name' => 'Delete_ArmAgahi']);

        $access[] = Permission::create(['permission_name' => 'Visit_Box_Type']);
        $access[] = Permission::create(['permission_name' => 'Insert_Box_Type']);
        $access[] = Permission::create(['permission_name' => 'Edit_Box_Type']);
        $access[] = Permission::create(['permission_name' => 'Delete_Box_Type']);

        $access[] = Permission::create(['permission_name' => 'Visit_Box_Prog_Group']);
        $access[] = Permission::create(['permission_name' => 'Insert_Box_Prog_Group']);
        $access[] = Permission::create(['permission_name' => 'Edit_Box_Prog_Group']);
        $access[] = Permission::create(['permission_name' => 'Delete_Box_Prog_Group']);

        $access[] = Permission::create(['permission_name' => 'Visit_Cast']);
        $access[] = Permission::create(['permission_name' => 'Insert_Cast']);
        $access[] = Permission::create(['permission_name' => 'Edit_Cast']);
        $access[] = Permission::create(['permission_name' => 'Delete_Cast']);

        $access[] = Permission::create(['permission_name' => 'Visit_Product']);
        $access[] = Permission::create(['permission_name' => 'Insert_Product']);
        $access[] = Permission::create(['permission_name' => 'Edit_Product']);
        $access[] = Permission::create(['permission_name' => 'Delete_Product']);

        $access[] = Permission::create(['permission_name' => 'Visit_Title']);
        $access[] = Permission::create(['permission_name' => 'Insert_Title']);
        $access[] = Permission::create(['permission_name' => 'Edit_Title']);
        $access[] = Permission::create(['permission_name' => 'Delete_Title']);

        $access[] = Permission::create(['permission_name' => 'Visit_Owner']);
        $access[] = Permission::create(['permission_name' => 'Insert_Owner']);
        $access[] = Permission::create(['permission_name' => 'Edit_Owner']);
        $access[] = Permission::create(['permission_name' => 'Delete_Owner']);

        $access[] = Permission::create(['permission_name' => 'Visit_Adver_Type']);
        $access[] = Permission::create(['permission_name' => 'Insert_Adver_Type']);
        $access[] = Permission::create(['permission_name' => 'Edit_Adver_Type']);
        $access[] = Permission::create(['permission_name' => 'Delete_Adver_Type']);
        
        $access[] = Permission::create(['permission_name' => 'Visit_Adver_Type_Coef']);
        $access[] = Permission::create(['permission_name' => 'Insert_Adver_Type_Coef']);
        $access[] = Permission::create(['permission_name' => 'Edit_Adver_Type_Coef']);
        $access[] = Permission::create(['permission_name' => 'Delete_Adver_Type_Coef']);


        // Create User For Login Auto Full Access
        $user = User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'status' => '1' ,
            'tell' => '09122365478' ,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'TokenTesti' ,
        ]);

        $tempAccess = [];

        foreach($access as $a)
        {
            $tempAccess[]= $a->id;
        }
        $user->roles()->sync($tempAccess);

        // ST DOC 1400-06-21For Migrate In Date Error 
        factory(ArmAgahi::class,10)->create();
        factory(Adver_Type_Coef::class,10)->create();

    }
}




