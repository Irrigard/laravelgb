<?php declare(strict_types=1);


namespace App\Services;
use App\Contracts\Social;
use Laravel\Socialite\Contracts\User;
use App\Models\User as Model;


class SocialService implements Social
{
    public function userInit(User $user):bool
    {
        $userData = Model::where(['email' => $user->getEmail()])->first();
        if ($userData) {
            //auth
            $userData->name = $user->getName();
            $userData->avatar = $user->getAvatar();

            if ($userData->save()) {
                \Auth::loginUsingId($userData->id);

                return true;
            }
        } else {
            //registation
        }

        throw new \Exception('Не удалось хохранить пользователя');
    }
}
