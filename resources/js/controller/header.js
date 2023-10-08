const HeaderController = function($scope, $cookies, $window, Http){
    var token = $cookies.get('token');

    $scope.user = {
        balance: 0,
        profile: {}
    }
    $scope.init = () => {
        Http.sendGet('/api/v1/user/profile', token).then(
            (response) => {
                let data = response.data;
                $scope.user.profile = data;
            },
            (response) => {
                $window.location.href = '/auth';
            }
        );

        Http.sendGet('/api/v1/user/balance', token).then(
            (response) => {
                let data = response.data;
                $scope.user.balance = data.amount;
            },
            (response) => {
                $window.location.href = '/auth';
            }
        );
    }
}

export {HeaderController}