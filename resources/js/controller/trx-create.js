const TrxCreateController = function($scope, $cookies, $window, Http){
    var token = $cookies.get('token');

    $scope.transactions = {
        data: {},
        services: [],
        types:['topup', 'transactions']
    }

    $scope.form = {
        transactions: {
            amount: null,
            title: null,
            type: null,
            service_id: null,
            remarks: null
        }
    }

    $scope.success = {
        transactions: {
            alert: null,
        }
    }

    $scope.error = {
        transactions: {
            alert: null,
            amount: null,
            title: null,
            type: null,
            service_id: null,
            remarks: null
        }
    }

    $scope.init = () => {
        Http.sendGet('/api/v1/services').then(
            (response) => {
                let data = response.data;
                $scope.transactions.services = data;
            }
        );
    }

    $scope.submit = () => {
        $scope.success = {
            transactions: {
                alert: null,
            }
        }
    
        $scope.error = {
            transactions: {
                alert: null,
                amount: null,
                title: null,
                type: null,
                service_id: null,
                remarks: null
            }
        }
        
        Http.sendAsJson('POST', '/api/v1/transactions', {data: $scope.form.transactions, authentication: token}).then(
            (response) => {
                let data = response.data;
                $scope.success.transactions.alert = 'Transactions has been created! You\'ll be redirected shortly';

                setTimeout(() => {
                    $window.location.href = '/transactions/detail/' + data.id;
                }, 2500);
            },
            (response) => {
                let data = response.data;
                $scope.error.transactions.alert = data.message;

                if(data.errors)
                    Object.keys(data.errors).forEach(i => { $scope.error.transactions[i] = data.errors[i][0] });                
            }
        )
    }
}

export {TrxCreateController}