<?php
declare(strict_types=1);

use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Action\SubscribeAction::class => App\Action\SubscribeAction::class,
        ],
        'factories' => [
            App\Action\IndexAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\MeetupsAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\MeetupsIcsAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\ContactAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\SponsorsAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\VideosAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\CodeOfConductAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\ChatAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\ChatHelpAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\TeamAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\LoginAction::class => App\Action\Account\LoginActionFactory::class,
            App\Action\Account\RegisterAction::class => App\Action\Account\RegisterActionFactory::class,
            App\Action\Account\DashboardAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\SettingsAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Settings\ChangePassword::class => App\Action\Account\Settings\ChangePasswordFactory::class,
            App\Action\Account\Settings\ChangeProfileHandler::class => App\Action\Account\Settings\ChangeProfileHandlerFactory::class,
            App\Action\Account\Settings\DeleteMeHandler::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\UnlinkThirdPartyAuthenticationAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\LogoutAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Meetup\AddMeetupAction::class => App\Action\Account\Meetup\AddMeetupActionFactory::class,
            App\Action\Account\Meetup\EditMeetupAction::class => App\Action\Account\Meetup\EditMeetupActionFactory::class,
            App\Action\Account\Meetup\ViewMeetupAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Meetup\ToggleAttendanceAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Meetup\ListMeetupsAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Meetup\CheckInUserAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Meetup\CancelCheckInAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Location\ListLocationsAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Meetup\ViewMeetupAction::class => App\Action\Account\Meetup\ViewMeetupActionFactory::class,
            App\Action\Account\Meetup\ToggleAttendanceAction::class => App\Action\Account\Meetup\ToggleAttendanceActionFactory::class,
            App\Action\Account\Meetup\ListMeetupsAction::class => App\Action\Account\Meetup\ListMeetupsActionFactory::class,
            App\Action\Account\Meetup\CheckInUserAction::class => App\Action\Account\Meetup\CheckInUserActionFactory::class,
            App\Action\Account\Meetup\CancelCheckInAction::class => App\Action\Account\Meetup\CancelCheckInActionFactory::class,
            App\Action\Account\Meetup\PickWinnerAction::class => App\Action\Account\Meetup\PickWinnerActionFactory::class,
            App\Action\Account\Location\ListLocationsAction::class => App\Action\Account\Location\ListLocationsActionFactory::class,
            App\Action\Account\Location\AddLocationAction::class => App\Action\Account\Location\AddLocationActionFactory::class,
            App\Action\Account\Location\EditLocationAction::class => App\Action\Account\Location\EditLocationActionFactory::class,
            App\Action\Account\Talk\AddTalkAction::class => App\Action\Account\Talk\AddTalkActionFactory::class,
            App\Action\Account\Talk\EditTalkAction::class => App\Action\Account\Talk\EditTalkActionFactory::class,
            App\Action\Account\Talk\DeleteTalkAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Speaker\ListSpeakersAction::class => ReflectionBasedAbstractFactory::class,
            App\Action\Account\Speaker\AddSpeakerAction::class => App\Action\Account\Speaker\AddSpeakerActionFactory::class,
            App\Action\Account\Speaker\EditSpeakerAction::class => App\Action\Account\Speaker\EditSpeakerActionFactory::class,
            App\Service\Twitter\AuthenticateAction::class => ReflectionBasedAbstractFactory::class,
            App\Service\Twitter\CallbackAction::class => ReflectionBasedAbstractFactory::class,
            App\Service\GitHub\AuthenticateAction::class => ReflectionBasedAbstractFactory::class,
            App\Service\GitHub\CallbackAction::class => ReflectionBasedAbstractFactory::class,
            App\Middleware\Authentication::class => App\Middleware\AuthenticationFactory::class,
            App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class => App\Service\Authorization\Middleware\HasAdministratorRoleMiddlewareFactory::class,
            App\Service\Authorization\Middleware\HasAttendeeRoleMiddleware::class => App\Service\Authorization\Middleware\HasAttendeeRoleMiddlewareFactory::class,
        ],
    ],
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\IndexAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'meetups',
            'path' => '/meetups',
            'middleware' => App\Action\MeetupsAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'meetups-ics',
            'path' => '/meetups.ics',
            'middleware' => App\Action\MeetupsIcsAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'contact',
            'path' => '/contact',
            'middleware' => App\Action\ContactAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'sponsors',
            'path' => '/sponsors',
            'middleware' => App\Action\SponsorsAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'videos',
            'path' => '/videos',
            'middleware' => App\Action\VideosAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'code-of-conduct',
            'path' => '/code-of-conduct',
            'middleware' => App\Action\CodeOfConductAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'chat',
            'path' => '/chat',
            'middleware' => App\Action\ChatAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'chat-help',
            'path' => '/chat/help',
            'middleware' => App\Action\ChatHelpAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'team',
            'path' => '/team',
            'middleware' => App\Action\TeamAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'subscribe',
            'path' => '/subscribe',
            'middleware' => App\Action\SubscribeAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-login',
            'path' => '/account/login',
            'middleware' => App\Action\Account\LoginAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-register',
            'path' => '/account/register',
            'middleware' => App\Action\Account\RegisterAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-dashboard',
            'path' => '/account/dashboard',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAttendeeRoleMiddleware::class,
                App\Action\Account\DashboardAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-settings',
            'path' => '/account/settings',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAttendeeRoleMiddleware::class,
                App\Action\Account\SettingsAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-settings-change-password',
            'path' => '/account/settings/change-password',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAttendeeRoleMiddleware::class,
                App\Action\Account\Settings\ChangePassword::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-settings-change-profile',
            'path' => '/account/settings/change-profile',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAttendeeRoleMiddleware::class,
                App\Action\Account\Settings\ChangeProfileHandler::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-settings-delete-me',
            'path' => '/account/settings/delete-me',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAttendeeRoleMiddleware::class,
                App\Action\Account\Settings\DeleteMeHandler::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-unlink-third-party-login',
            'path' => '/account/unlink-social/{loginId}',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAttendeeRoleMiddleware::class,
                App\Action\Account\UnlinkThirdPartyAuthenticationAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-meetups-list',
            'path' => '/account/meetups',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Meetup\ListMeetupsAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-meetup-add',
            'path' => '/account/meetup/add',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Meetup\AddMeetupAction::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-meetup-view',
            'path' => '/account/meetup/{uuid}',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Meetup\ViewMeetupAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-meetup-edit',
            'path' => '/account/meetup/{uuid}/edit',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Meetup\EditMeetupAction::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-meetup-toggle-attendance',
            'path' => '/account/meetup/{uuid}/toggle-attendance',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAttendeeRoleMiddleware::class,
                App\Action\Account\Meetup\ToggleAttendanceAction::class,
            ],
            'allowed_methods' => ['POST'],
        ],
        [
            'name' => 'account-meetup-check-in-user',
            'path' => '/account/meetup/{meetup}/check-in/{user}',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Meetup\CheckInUserAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-meetup-cancel-check-in',
            'path' => '/account/meetup/{meetup}/cancel-check-in/{user}',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Meetup\CancelCheckInAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-meetup-pick-a-winner',
            'path' => '/account/meetup/{meetup}/pick-a-winner',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Meetup\PickWinnerAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-locations-list',
            'path' => '/account/locations',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Location\ListLocationsAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-location-add',
            'path' => '/account/location/add',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Location\AddLocationAction::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-location-edit',
            'path' => '/account/location/{uuid}/edit',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Location\EditLocationAction::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-speakers-list',
            'path' => '/account/speakers',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Speaker\ListSpeakersAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-speaker-add',
            'path' => '/account/speaker/add',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Speaker\AddSpeakerAction::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-speaker-edit',
            'path' => '/account/speaker/{uuid}/edit',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Speaker\EditSpeakerAction::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-logout',
            'path' => '/account/logout',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAttendeeRoleMiddleware::class,
                App\Action\Account\LogoutAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-talk-add',
            'path' => '/account/meetup/{meetup}/add-talk',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Talk\AddTalkAction::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-talk-edit',
            'path' => '/account/meetup/talk/{uuid}/edit',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Talk\EditTalkAction::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'account-talk-delete',
            'path' => '/account/meetup/talk/{uuid}/delete',
            'middleware' => [
                App\Middleware\Authentication::class,
                App\Service\Authorization\Middleware\HasAdministratorRoleMiddleware::class,
                App\Action\Account\Talk\DeleteTalkAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-twitter-authenticate',
            'path' => '/account/twitter/authenticate',
            'middleware' => [
                App\Service\Twitter\AuthenticateAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-twitter-callback',
            'path' => '/account/twitter/callback',
            'middleware' => [
                App\Service\Twitter\CallbackAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-github-authenticate',
            'path' => '/account/github/authenticate',
            'middleware' => [
                App\Service\GitHub\AuthenticateAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account-github-callback',
            'path' => '/account/github/callback',
            'middleware' => [
                App\Service\GitHub\CallbackAction::class,
            ],
            'allowed_methods' => ['GET'],
        ],
    ],
];
