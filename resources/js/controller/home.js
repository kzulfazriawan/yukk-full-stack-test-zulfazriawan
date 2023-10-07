const Home = function($scope, $rootScope, $window, Http){
    $scope.applications = {};
    $scope.regions      = [];
    $scope.dealership   = [];
    $scope.infoDealer   = null;
    $scope.data = {
        region: null,
        dealership: null
    }

    $scope.get = () => {
        Http.sendGet('/api/v1/applications').then(
            // success function
            function(response){
                let data = response.data;
                data.forEach(i => {
                    $scope.applications[i.key] = i.value;
                });
            }
        );
    }

    $scope.getRegions = () => {
        Http.sendGet('/api/v1/regions').then(
            // success function
            function(response){
                let data = response.data;
                $scope.regions = data;
            }
        );
    }

    $scope.getDealershipRegions = (uuid) => {
        Http.sendGet('/api/v1/regions/' + uuid).then(
            function(response){
                let data = response.data;
                $scope.dealership = data.dealerships;
            }
        )
    }

    $scope.getDealershipChecked = () => {
        let index = $scope.dealership.findIndex((item) => item.id == $scope.data.dealership);
        $scope.infoDealer = $scope.dealership[index];
    }
}

export {Home}