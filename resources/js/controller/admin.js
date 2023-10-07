const Auth = function($scope, $rootScope, $window, Http){
    $scope.data = {
        email: null,
        password: null
    }

    $scope.post = () => {
        Http.sendAsJson("POST", "/api/v1/login", $scope.data).then(

        );
    }
}

export {Auth}