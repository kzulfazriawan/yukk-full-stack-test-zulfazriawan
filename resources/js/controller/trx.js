const TrxController = function($scope, $cookies, $window, Http){
    var token = $cookies.get('token');

    $scope.transactions = {
        data: [],
        pagination: [],
        page: 1,
        status: null,
        income: null,
        search: null,
    }

    $scope.filter = {
        status: ['open', 'paid', 'expired', 'cancel'],
        income: ['in', 'out']
    }

    $scope.resetTrx = () => {
        $scope.transactions = {
            pagination: [],
            page: 1,
            status: null,
            income: null,
            search: null,
        }

        $scope.loadTrx();
    }

    $scope.loadTrx = (target = null) => {
        let url = (target == null) ? '/api/v1/transactions?page=' + $scope.transactions.page : target;

        if($scope.transactions.status != null)
            url += '&status=' + $scope.transactions.status;

        if($scope.transactions.income != null)
            url += '&income=' + $scope.transactions.income;

        if($scope.transactions.search != null)
            url += '&search=' + $scope.transactions.search;

        Http.sendGet(url, token).then(
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

    $scope.init = () => {
        $scope.loadTrx();
    }
}

export {TrxController}