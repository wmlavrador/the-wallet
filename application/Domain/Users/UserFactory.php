<?php

namespace TheWallet\Users;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use TheWallet\Users\Enum\UserTypeEnum;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $documentType = fake()->randomElement(UserTypeEnum::cases());
        $documentNumber = ($documentType === UserTypeEnum::Customer) ?
            fake()->unique()->numerify('###########') :
            fake()->unique()->numerify('##############');

        return [
            'id' => fake()->uuid(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'document_number' => $documentNumber,
            'user_type' => $documentType,
            'password' => Hash::make('password'),
        ];
    }
}
