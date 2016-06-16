var app = angular.module(
    'main',
    [
        'ui.router'
        , 'ui.bootstrap'
        , 'ngSanitize'
        , 'ngCookies'
        , '720kb.socialshare'
    ]
)
.config(['socialshareConfProvider', function configApp(socialshareConfProvider) {
    socialshareConfProvider.configure([{
        'provider': 'twitter',
        'conf': {
            'url': 'http://720kb.net',
            'text': '720kb is enough',
            'via': 'npm',
            'hashtags': 'angularjs,socialshare,angular-socialshare',
            'trigger': 'click',
            'popupHeight': 800,
            'popupWidth' : 400
        }
    }]);
}]);
