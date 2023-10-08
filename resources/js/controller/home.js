const HomeController = ($scope, $cookies, $window, Http) => {
    var token = $cookies.get('token');

    $scope.user = {
        balance: 0,
        profile: {}
    }

    $scope.transactions = {
        data: [],
        pagination: [],
        page: 1,
        status: null,
        income: null
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

        Http.sendGet('/api/v1/transactions?page=1', token).then(
            (response) => {
                let data = response.data;
                $scope.transactions.pagination = data.links;
                $scope.transactions.page = data.current_page;
                $scope.transactions.data = data.data;
            },
            (response) => {
                console.log(response);
            }
        );
    }
}

export {HomeController}