<?php

namespace Geekbrains\Homework\Domain\Controllers;

use Exception;
use Geekbrains\Homework\Application\Application;
use Geekbrains\Homework\Application\Render;
use Geekbrains\Homework\Domain\Models\User;
use Geekbrains\Homework\Application\Auth;
use Geekbrains\Homework\Domain\Controllers\PageController;


class UserController extends AbstractController {


    protected array $actionsPermissions = [
        'actionIndex' => ['admin', 'guest'],
        'actionCreate' => ['admin'],
        'actionEdit' => ['admin'],
        'actionDelete' => ['admin'],
        'actionSave' => ['admin'],
        'actionUpdate' => ['admin']
    ];

    protected array $alwaysEnabledMethods = ['actionAuth', 'actionLogin', 'actionLogout'];

    public function actionIndex() {
        $users = User::getAllUsersFromStorage();
        $render = new Render();
        return $render->renderPage(
            'user-index.twig', 
            Auth::addSessionData(
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users,
                ]));
    }
