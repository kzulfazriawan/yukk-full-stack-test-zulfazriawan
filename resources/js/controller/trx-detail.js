const TrxDetailController = function($scope, $cookies, $window, Http){
    var token = $cookies.get('token');

    $scope.transactions = {
        data: {},
    }

    $scope.success = {
        transactions: {
            alert: null,
        }
    }

    $scope.error = {
        transactions: {
            alert: null,
        }
    }

    $scope.init = (id) => {
        Http.sendGet('/api/v1/transactions/' + id, token).then(
            (response) => {
                let data = response.data;
                $scope.transactions.data = data;
            },
            (response) => {
                $window.location.href = '/auth';
            }
        );
    }

    $scope.confirm = (id) => {
        Http.sendAsJson('PATCH', '/api/v1/transactions/' + id, {data: {status: 'paid'}, authentication: token}).then(
            (response) => {
                $scope.success.transactions.alert = 'Payment Success!';
                $scope.init(id);
            },
            (response) => {
                let data = response.data;
                $scope.error.transactions.alert = data.message;
            }
        )
    }
}

export {TrxDetailController}